<?php
namespace console\controllers;

use common\models\E123Member;
use common\models\Member;
use common\models\Membership;
use common\models\Purchase;
use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class TestController extends Controller
{
    public $defaultAction = 'test';

    public function actionTest()
    {
        echo 'All systems nominal...'.PHP_EOL;

        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionEmail()
    {
        $member = new Member(['f_name' => 'Test', 'l_name' => 'Member', 'email' => 'mikem@mnetwork.org']);

        Yii::$app
            ->mailer
            ->compose(
                ['html' => 'memberWelcome-html', 'text' => 'memberWelcome-text'],
                ['member' => $member] )
            ->setFrom([Yii::$app->params['supportEmail'] => 'NAHC Support'])
            ->setTo($member->email)
            ->setSubject('Welcome to NAHC!')
            ->send();
    }

    public function actionE123()
    {
        $member = Member::findOne(1);

        $model = E123Member::getModelFromMember($member);

        $api = Yii::$app->e123;

        echo 'Calling...'.PHP_EOL;

        $result = $api->callMemberRest($model);

        echo 'Response...'.print_r($result, true).PHP_EOL;

        $id = ArrayHelper::getValue($result, 'MEMBER.ID', null);

        if(!empty($id))
            $member->ext_id = $id;

        if(!$member->save()) {
            echo 'Error updating member'.PHP_EOL;
            echo print_r($member->errors, true).PHP_EOL;
        }

        echo 'Member id '.$member->id.' updated: '.print_r($member->toArray(), true).PHP_EOL;

        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionE123Delete()
    {
        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionE123Purchase()
    {
        $purchases = Purchase::find()->where(['>', 'id', 5])->all();

        foreach($purchases as $purch) {

            $member = $purch->member;

            $model = E123Member::getModelFromPurchase($purch);

            $model->products[0]['pdid'] = 18230;

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

        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionE123Sim()
    {
        $api = Yii::$app->e123;

        $members = [
            ['firstname' => 'M1', 'lastname' => 'Test', 'payment' => ["paymenttype" => "ACH","achrouting" => "011000138","achaccount" => "1234","achbank" => "BANK OF AMERICA, N.A."],
                'products' => [[
                    'pdid' => 18240,
                    'dtCreated' =>      '06/22/2017',
                    'dtEffective' =>    '06/25/2017',
                    'dtBilling' =>      '07/05/2017',
                    'dtRecurring' =>    '09/05/2017',
                    'bPaid' => 'Y',
            ]]],

            ['firstname' => 'M2', 'lastname' => 'Test', 'payment' => ["paymenttype" => "ACH","achrouting" => "011000138","achaccount" => "1234","achbank" => "BANK OF AMERICA, N.A."],
                'products' => [[
                    'pdid' => 18240,
                    'dtCreated' =>      '07/02/2017',
                    'dtEffective' =>    '07/05/2017',
                    'dtBilling' =>      '07/15/2017',
                    'dtRecurring' =>    '09/15/2017',
                    'bPaid' => 'Y',
            ]]],

            ['firstname' => 'M3', 'lastname' => 'Test', 'payment' => ["paymenttype" => "ACH","achrouting" => "011000138","achaccount" => "1234","achbank" => "BANK OF AMERICA, N.A."],
                'products' => [[
                    'pdid' => 18240,
                    'dtCreated' =>      '07/12/2017',
                    'dtEffective' =>    '07/15/2017',
                    'dtBilling' =>      '07/25/2017',
                    'dtRecurring' =>    '08/25/2017',
                    'bPaid' => 'Y',
            ]]],

            ['firstname' => 'M4', 'lastname' => 'Test', 'payment' => ["paymenttype" => "ACH","achrouting" => "011000138","achaccount" => "1234","achbank" => "BANK OF AMERICA, N.A."],
                'products' => [[
                    'pdid' => 18240,
                    'dtCreated' =>      '07/01/2017',
                    'dtEffective' =>    '07/04/2017',
                    'dtBilling' =>      '07/05/2017',
                    'dtRecurring' =>    '09/05/2017',
                    'bPaid' => 'Y',
            ]]],

            ['firstname' => 'M5', 'lastname' => 'Test', 'payment' => ["paymenttype" => "ACH","achrouting" => "011000138","achaccount" => "1234","achbank" => "BANK OF AMERICA, N.A."],
                'products' => [[
                    'pdid' => 18240,
                    'dtCreated' =>      '07/11/2017',
                    'dtEffective' =>    '07/14/2017',
                    'dtBilling' =>      '07/15/2017',
                    'dtRecurring' =>    '09/15/2017',
                    'bPaid' => 'Y',
            ]]],

            ['firstname' => 'M6', 'lastname' => 'Test', 'payment' => ["paymenttype" => "ACH","achrouting" => "011000138","achaccount" => "1234","achbank" => "BANK OF AMERICA, N.A."],
                'products' => [[
                    'pdid' => 18240,
                    'dtCreated' =>      '07/21/2017',
                    'dtEffective' =>    '07/24/2017',
                    'dtBilling' =>      '07/25/2017',
                    'dtRecurring' =>    '08/25/2017',
                    'bPaid' => 'Y',
            ]]],

            ['firstname' => 'M7', 'lastname' => 'Test', 'payment' => ["paymenttype" => "ACH","achrouting" => "011000138","achaccount" => "1234","achbank" => "BANK OF AMERICA, N.A."],
                'products' => [[
                    'pdid' => 18240,
                    'dtCreated' =>      '08/18/2017',
                    'dtEffective' =>    '08/21/2017',
                    'dtBilling' =>      '08/25/2017',
                    'dtRecurring' =>    '09/25/2017',
                    'bPaid' => 'Y',
            ]]],

            ['firstname' => 'M8', 'lastname' => 'Test', 'payment' => ["paymenttype" => "ACH","achrouting" => "011000138","achaccount" => "1234","achbank" => "BANK OF AMERICA, N.A."],
                'products' => [[
                    'pdid' => 18240,
                    'dtCreated' =>      '08/22/2017',
                    'dtEffective' =>    '08/25/2017',
                    'dtBilling' =>      '09/05/2017',
                    'dtRecurring' =>    '10/05/2017',
                    'bPaid' => 'Y',
            ]]],

            ['firstname' => 'M9', 'lastname' => 'Test', 'payment' => ["paymenttype" => "ACH","achrouting" => "011000138","achaccount" => "1234","achbank" => "BANK OF AMERICA, N.A."],
                'products' => [[
                    'pdid' => 18240,
                    'dtCreated' =>      '09/11/2017',
                    'dtEffective' =>    '09/14/2017',
                    'dtBilling' =>      '09/15/2017',
                    'dtRecurring' =>    '10/15/2017',
                    'bPaid' => 'Y',
            ]]],
        ];

        $products = [
            ['uniqueid' => '', 'lastname' => 'Test', 'products' => [
                [
                    'pdid' => 18230,
                    'dtCreated' =>      '08/02/2017',
                    'dtEffective' =>    '08/05/2017',
                    'dtBilling' =>      '08/15/2017',
                    'dtRecurring' =>    '09/05/2017',
                    'bPaid' => 'Y',
                ]
            ]],

            ['uniqueid' => '', 'lastname' => 'Test', 'products' => [
                [
                    'pdid' => 18230,
                    'dtCreated' =>      '08/12/2017',
                    'dtEffective' =>    '08/15/2017',
                    'dtBilling' =>      '08/25/2017',
                    'dtRecurring' =>    '09/15/2017',
                    'bPaid' => 'Y',
                ]
            ]],

            ['uniqueid' => '', 'lastname' => 'Test', 'products' => [
                [
                    'pdid' => 18230,
                    'dtCreated' =>      '08/22/2017',
                    'dtEffective' =>    '08/25/2017',
                    'dtBilling' =>      '09/05/2017',
                    'dtRecurring' =>    '09/25/2017',
                    'bPaid' => 'Y',
                ]
            ]],

            ['uniqueid' => '', 'lastname' => 'Test', 'products' => [
                [
                    'pdid' => 18230,
                    'dtCreated' =>      '08/21/2017',
                    'dtEffective' =>    '08/24/2017',
                    'dtBilling' =>      '08/25/2017',
                    'dtRecurring' =>    '09/05/2017',
                    'bPaid' => 'Y',
                ]
            ]],

            ['uniqueid' => '', 'lastname' => 'Test', 'products' => [
                [
                    'pdid' => 18230,
                    'dtCreated' =>      '09/01/2017',
                    'dtEffective' =>    '09/04/2017',
                    'dtBilling' =>      '09/05/2017',
                    'dtRecurring' =>    '09/15/2017',
                    'bPaid' => 'Y',
                ]
            ]],

            ['uniqueid' => '', 'lastname' => 'Test', 'products' => [
                [
                    'pdid' => 18230,
                    'dtCreated' =>      '09/11/2017',
                    'dtEffective' =>    '09/14/2017',
                    'dtBilling' =>      '09/15/2017',
                    'dtRecurring' =>    '09/25/2017',
                    'bPaid' => 'Y',
                ]
            ]],

            ['uniqueid' => '', 'lastname' => 'Test', 'products' => [
                [
                    'pdid' => 18230,
                    'dtCreated' =>      '08/21/2017',
                    'dtEffective' =>    '08/24/2017',
                    'dtBilling' =>      '08/25/2017',
                    'dtRecurring' =>    '09/25/2017',
                    'bPaid' => 'Y',
                ]
            ]],

            ['uniqueid' => '', 'lastname' => 'Test', 'products' => [
                [
                    'pdid' => 18230,
                    'dtCreated' =>      '09/01/2017',
                    'dtEffective' =>    '09/04/2017',
                    'dtBilling' =>      '09/05/2017',
                    'dtRecurring' =>    '10/05/2017',
                    'bPaid' => 'Y',
                ]
            ]],

            ['uniqueid' => '', 'lastname' => 'Test', 'products' => [
                [
                    'pdid' => 18230,
                    'dtCreated' =>      '09/11/2017',
                    'dtEffective' =>    '09/14/2017',
                    'dtBilling' =>      '09/15/2017',
                    'dtRecurring' =>    '10/15/2017',
                    'bPaid' => 'Y',
                ]
            ]],
        ];

        for($i=0; $i < 9; $i++) {
            echo 'Calling add member...'.PHP_EOL;

            $result = $api->callArrayRest($members[$i]);

            echo 'Response...' . print_r($result, true) . PHP_EOL;

            echo 'Adding product...'.PHP_EOL;

            $products[$i]['uniqueid'] = $result['MEMBER']['ID'];

            $result2 = $api->callArrayRest($products[$i], true);

            echo 'Product Response...'.print_r($result2, true).PHP_EOL;
        }

        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionE123AgentLogin()
    {
        $api = Yii::$app->e123;

        $login = ['username' => 'mark_harris', 'password' => 'temp_140987'];

        $result = $api->callV2Rest('agents/login', $login);

        echo 'RESULT: '.PHP_EOL.print_r($result, true);

        return Controller::EXIT_CODE_NORMAL;
    }
}