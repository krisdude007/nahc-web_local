<?php
namespace console\controllers;

use common\models\E123Member;
use common\models\Purchase;
use common\models\SyncLog;
use SplFileObject;
use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;

class SyncController extends Controller
{
    public $defaultAction = 'process-changes';

    /**
     * Processes changed records for sync to external
     * @return int
     */
    public function actionProcessChanges()
    {
        return Controller::EXIT_CODE_NORMAL;
    }

    /**
     * Processes updates to the FedACH Database
     *
     * @param $file string Path to ACH text file
     *
     * @return int
     */
    public function actionFedAch($file = null)
    {
        $ts = time();
        $records = [];
        $fields = [
            'name',
            'type',
            'office_code',
            'routing_num',
            'new_routing_num',
            'frb',
            'change_date',
            'address',
            'city',
            'state',
            'zip',
            'zip_ext',
            'phone_area',
            'phone_prefix',
            'phone_suffix',
            'status_code',
            'view_code',
            'filter',
            'created_at',
            'updated_at',
        ];

        if(empty($file))    {
            $path = \Yii::getAlias('@runtime').'/FedACHdir.txt';
        }
        else
        {
            $path = realpath($file);
        }

        echo "Loading FED ACH entries from file: ".$path.PHP_EOL;

        $fo = new \SplFileObject($path, 'r');

        if(empty($fo)) {
            echo 'Failed to open file!'.PHP_EOL;
            return Controller::EXIT_CODE_ERROR;
        }

        $fo->setFlags(SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
        $fo->seek(PHP_INT_MAX);

        $lines = $fo->key();

        Console::startProgress(0, $lines);

        // reset to first line
        $fo->rewind();

        $i = 0;
        while (!$fo->eof()) {
            $line = $fo->fgets();
//            $str = trim($buffer,"\n");

//            echo "-----\n";
//            echo $str."\n--\n";
//            echo 'Routing: '.substr($buffer, 0, 9).PHP_EOL;
//            echo 'Office: '.substr($buffer, 9, 1).PHP_EOL;
//            echo 'FRB: '.substr($buffer, 10, 9).PHP_EOL;
//            echo 'Type: '.substr($buffer, 19, 1).PHP_EOL;
//            echo 'Date: '.substr($buffer, 20, 6).PHP_EOL;
//            echo 'New Routing: '.substr($buffer, 26, 9).PHP_EOL;
//            echo 'Name: '.substr($buffer, 35, 36).PHP_EOL;
//            echo 'Address: '.substr($buffer, 71, 36).PHP_EOL;
//            echo 'City: '.substr($buffer, 107, 20).PHP_EOL;
//            echo 'State: '.substr($buffer, 127, 2).PHP_EOL;
//            echo 'Zip: '.substr($buffer, 129, 5).'-'.substr($buffer, 134, 4).PHP_EOL;
//            echo 'Tel: '.substr($buffer, 138, 3).'-'.substr($buffer, 141, 3).'-'.substr($buffer, 144, 4).PHP_EOL;
//            echo 'Status: '.substr($buffer, 148, 1).PHP_EOL;
//            echo 'Data View: '.substr($buffer, 149, 1).PHP_EOL;
//            echo 'Filter: '.substr($buffer, 150, 5).PHP_EOL;

            $records[] = [
                substr($line, 35, 36),        // name
                substr($line, 19, 1),         // type
                substr($line, 9, 1),          // office_code
                substr($line, 0, 9),          // routing
                substr($line, 26, 9),         // new_routing
                substr($line, 10, 9),         // frb
                substr($line, 20, 6),         // change_date
                substr($line, 71, 36),        // address
                substr($line, 107, 20),       // city
                substr($line, 127, 2),        // state
                substr($line, 129, 5),        // zip
                substr($line, 134, 4),        // zip_ext
                substr($line, 138, 3),        // phone_area
                substr($line, 141, 3),        // phone_prefix
                substr($line, 144, 4),        // phone_suffix
                substr($line, 148, 1),        // status_code
                substr($line, 149, 1),        // view_code
                substr($line, 150, 5),        // filter
                $ts,
                $ts,
            ];

            $i++;
            if($i % 50 == 0) {
                Console::updateProgress($i, $lines);
            }
        }

        Console::updateProgress($i, $lines);
        Console::endProgress();

//        if (!feof($fh)) {
//            echo "Error: unexpected fgets() fail\n";
//        }

        \Yii::$app->db->createCommand()->truncateTable('fed_ach')->execute();
        \Yii::$app->db->createCommand()->resetSequence('fed_ach')->execute();

        $rowCount = \Yii::$app->db->createCommand()->batchInsert('fed_ach', $fields, $records)->execute();

        $end = time();

        echo 'Inserted: '.$rowCount.' rows in '.($end-$ts).' seconds'.PHP_EOL.PHP_EOL;

        //echo "Closing file: ".$path.PHP_EOL;
        $fo = null;

        return Controller::EXIT_CODE_NORMAL;
    }

    /**
     * Downlaod latest FEDACH database file
     *
     */
    public function actionGetAchFile()
    {
        set_time_limit(0); // unlimited max execution time

        $url = 'https://www.frbservices.org/EPaymentsDirectory/FedACHdir.txt';
        $post_url = 'https://www.frbservices.org/EPaymentsDirectory/submitAgreement';
        $post_fields = [ 'agreementValue' => urlencode('Agree'), ];

        $path = \Yii::getAlias('@runtime').'/FedACHdir.txt';

        if(empty($path)) {
            echo 'Error finding path!'.PHP_EOL;
            return Controller::EXIT_CODE_ERROR;
        }

        echo 'Saving file to path: '.$path.PHP_EOL;

        echo 'Obtaining cookie...'.PHP_EOL;
        //open POST connection
        $ph = curl_init();

        curl_setopt($ph,CURLOPT_URL, $post_url);
        curl_setopt($ph,CURLOPT_POST, count($post_fields));
        curl_setopt($ph,CURLOPT_POSTFIELDS, http_build_query($post_fields));
        curl_setopt($ph, CURLOPT_CAINFO, \Yii::getAlias('@runtime').'/cacert.pem');
        curl_setopt($ph, CURLOPT_VERBOSE, true);
        curl_setopt($ph, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ph, CURLOPT_COOKIESESSION, true );
        curl_setopt($ph, CURLOPT_COOKIEJAR, \Yii::getAlias('@runtime').'/cookie.txt');
        curl_setopt($ph, CURLOPT_COOKIEFILE, \Yii::getAlias('@runtime').'/cookie.txt' );

        //execute post
        $result = curl_exec($ph);

        echo 'Error: '.curl_error($ph).PHP_EOL;

//close connection
        curl_close($ph);

        echo 'Result: '.print_r($result, true).PHP_EOL;


        $fh = fopen($path, 'w');
        if(empty($fh))
        {
            echo 'fopen Failed!'.PHP_EOL;
            return Controller::EXIT_CODE_ERROR;
        }

        $options = [
//            CURLOPT_COOKIESESSION => true,
            CURLOPT_FILE    => $fh,
            CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
            CURLOPT_URL     => $url,
            CURLOPT_CAINFO  => \Yii::getAlias('@runtime').'/cacert.pem',
//            CURLOPT_COOKIEJAR => \Yii::getAlias('@runtime').'/cookie.txt',
            CURLOPT_COOKIEFILE => \Yii::getAlias('@runtime').'/cookie.txt',
            CURLOPT_VERBOSE => true,
//            CURLOPT_RETURNTRANSFER => 1,
        ];

        echo 'Download Beginning...'.PHP_EOL;
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $ret = curl_exec($ch);

        echo 'Download finished!'.PHP_EOL;

        echo 'Exec: '.curl_error($ch).' / '.print_r($ret, true).PHP_EOL.PHP_EOL;

        curl_close($ch);

        fclose($fh);

//        $arrContextOptions = [
//            "ssl" => [
//                "cafile" => (\Yii::getAlias('@runtime').'/cacert.pem'),
//                "verify_peer"=> true,
//                "verify_peer_name"=> true,
//            ],
//        ];
//
//        file_put_contents($path, file_get_contents($url, false, stream_context_create($arrContextOptions)));

//        echo 'File closed!'.PHP_EOL;
        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionGetCurlPem()
    {
        $url = 'https://curl.haxx.se/ca/cacert.pem';

        $path = \Yii::getAlias('@runtime').'/cacert.pem';

        file_put_contents($path, file_get_contents($url));

        echo 'PEM File Downloaded!'.PHP_EOL;
        echo '  Path: '.$path.PHP_EOL.PHP_EOL;

        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionSyncPurchases()
    {
        $sync_start = time();

        $last_sync = SyncLog::findLastSync();

        if(!empty($last_sync)) {
            $lastTs = $last_sync->sync_begin;
            $purchases = Purchase::find()->where(['>', 'update_at', $lastTs])->all();
        }
        else
        {
            $purchases = Purchase::find()->where(['<', 'update_at', time()])->all();
        }

        foreach($purchases as $purch) {

            $member = $purch->member;

            $model = E123Member::getModelFromPurchase($purch);

            $api = Yii::$app->e123;

            echo 'Calling...' . PHP_EOL;

            $result = $api->callMemberRest($model);

            echo 'Response...' . print_r($result, true) . PHP_EOL;

            $id = ArrayHelper::getValue($result, 'MEMBER.ID', null);

            if (!empty($id))
                $member->ext_id = $id;

            if (!$member->save()) {
                echo 'Error updating member' . PHP_EOL;
                echo print_r($member->errors, true) . PHP_EOL;
            }

            echo 'Member id ' . $member->id . ' updated: ' . print_r($member->toArray(), true) . PHP_EOL;
        }

        SyncLog::logSync($sync_start);

        return Controller::EXIT_CODE_NORMAL;
    }
}