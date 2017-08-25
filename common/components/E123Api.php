<?php
namespace common\components;

use common\models\E123Member;
use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;

/**
 * Class E123Api
 * @package common\components
 *
 *
 * For an ADD: https://[username]:[password]@api.1administration.com/v1/[brokerID]/member/0.json
 * For an UPDATE: https://[username]:[password]@api.1administration.com/v1/[brokerID]/member/[memberid].json
 *
 *
 */

class E123Api extends Component {
    const DEFAULT_USERNAME = 'testuser';
    const DEFAULT_PASS = 'Test123uSer';
    const DEFAULT_CORP = 1063;
    const DEFAULT_AGENT = 264934;
    const DEFAULT_PDID = 18240;

    const REST_URL_BASE = 'api.1administration.com/v1/';
    const DO_LOOKUP_URL = 'https://www.enrollment123.com/api/user.cfc';
    const API_SEARCH_URL = 'https://www.enrollment123.com/api/user.getall/';

    public $username;
    public $password;
    public $corpid;
    public $agentid;

    public $testMode = false;

    public function __construct(array $config = [])
    {
        $uname = ArrayHelper::getValue($config, 'username', null);

        if(empty($uname))
            $this->username = self::DEFAULT_USERNAME;

        $pass = ArrayHelper::getValue($config, 'password', null);

        if(empty($pass))
            $this->password = self::DEFAULT_PASS;

        $corp = ArrayHelper::getValue($config, 'corpid', null);

        if(empty($corp))
            $this->corpid = self::DEFAULT_CORP;

        if(empty($uname) && empty($pass) && empty($corp)) {
            $this->testMode = true;
        }

        parent::__construct($config);
    }

    public function callMemberRest(E123Member &$model)
    {
        $client = new Client();

        $url = 'https://'.$this->username.':'.$this->password.'@'.self::REST_URL_BASE;

        $agent = $model->agent;

        if(empty($agent) || $this->testMode) {
            $agent = self::DEFAULT_AGENT;
            $model->agent = $agent;
        }

        if(!empty($model->products) && $this->testMode) {
            foreach($model->products as &$prod) {
                $prod['pdid'] = self::DEFAULT_PDID;
            }
        }

        if($model->mode == E123Member::MODE_ADD) {
            $url .= $agent.'/member/0.json';
        } elseif($model->mode == E123Member::MODE_UPDATE) {
            $url .= $agent.'/member/'.$model->uniqueid.'.json';
        }

        echo 'Calling: '.$url.PHP_EOL;

        $payload = $model->toArray();
        $payload['corpid'] = $this->corpid;

        echo 'Payload Array: '.print_r($payload, true).PHP_EOL;

        $payload_str = json_encode($payload, JSON_UNESCAPED_SLASHES);

        //$payload_str_ascii = iconv('UTF-8', 'ASCII//TRANSLIT', $payload_str);

        echo 'Payload Json: '.print_r($payload_str, true).PHP_EOL;

        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($url)
            ->setData(['member' => $payload_str])
            ->send();

        if ($response->isOk) {
            Yii::info('Response: '.print_r($response, true));

//            $newUserId = $response->data['MEMBER']["ID"];
        }

        return $response->data;
    }

    public function callArrayRest(array $memAr, bool $update = null) {
        $client = new Client();

        $agent = self::DEFAULT_AGENT;
        $corp = self::DEFAULT_CORP;

        $memAr['agent'] = $agent;
        $memAr['corpid'] = $corp;

        if(!$update) {
            $url = 'https://' . $this->username . ':' . $this->password . '@' . self::REST_URL_BASE . $agent . '/member/0.json';
        } else {
            $url = 'https://' . $this->username . ':' . $this->password . '@' . self::REST_URL_BASE . $agent . '/member/'.$memAr['uniqueid'].'.json';
        }

        echo 'Calling: '.$url.PHP_EOL;

        $payload_str = json_encode($memAr, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

        echo 'Payload Json: '.$payload_str.PHP_EOL;

        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($url)
            ->setData(['member' => $payload_str])
            ->send();

        Yii::info('Response: '.print_r($response, true));

        if ($response->isOk && $response->data['SUCCESS'] == 1) {
            $newUserId = ArrayHelper::getValue($response->data, 'MEMBER.ID', null);
        }

        return $response->data;
    }
}