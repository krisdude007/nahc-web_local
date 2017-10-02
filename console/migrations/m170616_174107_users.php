<?php

use common\models\User;
use yii\db\Migration;

class m170616_174107_users extends Migration
{
//    public function safeUp()
//    {
//        // create user
//        $user = new User();
//        $user->username = 'mikem';
//        $user->breeder_id = 1;
//        $user->profile_id = 1;
//        $user->email = 'mikem@mnetwork.org';
//        $user->setPassword('yOshero00');
//        $user->generateAuthKey();
//        $user->admin = true;
//        if($user->save())
//            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;
//    }
//
//    public function safeDown()
//    {
//        echo "m170614_174107_users cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        // create user
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@joinnahc.com';
        $user->setPassword('pT3RN6p9kbn542AN/*3BPfwAvj');
        $user->generateAuthKey();
        $user->has_agent = true;
        //$user->admin = true;
//        $user->admin = true;
        if($user->save())
            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;

        // create user
        $user = new User();
        $user->username = 'user';
        $user->email = 'user@joinnahc.com';
        $user->setPassword('Addison1');
        $user->generateAuthKey();
//        $user->admin = true;
        if($user->save())
            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;

        // create user
        $user = new User();
        $user->username = 'basic';
        $user->email = 'basic@joinnahc.com';
        $user->setPassword('Addison1');
        $user->generateAuthKey();
        $user->has_member = true;
//        $user->admin = true;
        if($user->save())
            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;



        // create user
        $user = new User();
        $user->username = 'bronze';
        $user->email = 'bronze@joinnahc.com';
        $user->setPassword('Addison1');
        $user->generateAuthKey();
        $user->has_member = true;
//        $user->admin = true;
        if($user->save())
            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;

        // create user
        $user = new User();
        $user->username = 'silver';
        $user->email = 'silver@joinnahc.com';
        $user->setPassword('Addison1');
        $user->generateAuthKey();
        $user->has_member = true;
//        $user->admin = true;
        if($user->save())
            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;

        // create user
        $user = new User();
        $user->username = 'gold';
        $user->email = 'gold@joinnahc.com';
        $user->setPassword('Addison1');
        $user->generateAuthKey();
        $user->has_member = true;
//        $user->admin = true;
        if($user->save())
            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;


        // create user
        $user = new User();
        $user->username = 'agent';
        $user->email = 'testagent@joinnahc.com';
        $user->setPassword('Addison1');
        $user->generateAuthKey();
        $user->has_agent = true;
//        $user->admin = true;
        if($user->save())
            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;


        // create user
        $user = new User();
        $user->username = 'provider';
        $user->email = 'testprovider@joinnahc.com';
        $user->setPassword('Addison1');
        $user->generateAuthKey();
        $user->has_provider = true;
//        $user->admin = true;
        if($user->save())
            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;


        // create user
        $user = new User();
        $user->username = 'all';
        $user->email = 'testall@joinnahc.com';
        $user->setPassword('Addison1');
        $user->generateAuthKey();
        $user->has_member = true;
        $user->has_agent = true;
        $user->has_provider = true;
//        $user->admin = true;
        if($user->save())
            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;

//        // create user
//        $user = new User();
//        $user->username = 'rmiller';
//        $user->email = 'russ@joinnahc.com';
//        $user->setPassword('Addison1');
//        $user->generateAuthKey();
//        $user->has_member = true;
//        $user->has_agent = true;
//        $user->has_provider = true;
////        $user->admin = true;
//        if($user->save())
//            echo '    > create User '.$user->id.':'.$user->username.' ... done'.PHP_EOL;


        $ts = time();

        $this->batchInsert('agent',
            ['user_id', 'ext_id', 'has_img', 'f_name', 'm_name', 'l_name', 'organization', 'email', 'phone', 'address', 'address2', 'city', 'state_id', 'zip', 'created_at', 'updated_at'],
            [
                [ 1,    '136154', false,  'NAHC',     '',     'Agent',     'NAHC',     'agent@nahc.com',                   '8446400400', '16801 Addison Road', 'Suite 247',    'Addison', 43, '75001', $ts,    $ts],
                [ 7,    null,     false,  'John',    'A',     'Agent',     'TestOrg',  'agent@nahc.com',                   '8446400400', '16801 Addison Road', 'Suite 247',    'Addison', 43, '75001', $ts,    $ts],
                [ 9,    null,     false,  'John',    'T',     'Agent',     'TestOrg',  'agent@nahc.com',                   '8446400400', '16801 Addison Road', 'Suite 247',    'Addison', 43, '75001', $ts,    $ts],
//                [10,    '1234', true,   'Russ',     '',     'Miller',    'RMIG',     'russ@russmillerinsurancegroup.com','8174001084', '14052 Wrangler Way', '',             'Haslet',  43, '76052', $ts,    $ts],
            ]
        );

        $this->batchInsert('member',
            ['user_id', 'agent_id', 'f_name', 'm_name', 'l_name', 'dob', 'gender', 'address', 'city', 'state_id', 'zip', 'email', 'phone', 'ssn', 'created_at', 'updated_at', 'sync_at'],
            [
                [3, 3, 'John1', 'B',    'Member',   '1/1/1950', 'M',    '123 Test St.', 'Test', 43,   '75123',    'test@test.com',    '1231231234',   '123121234',   $ts,    $ts,   2147385600],
                [4, 3, 'John2', 'Cu',   'Member',   '1/1/1950', 'M',    '123 Test St.', 'Test', 43,   '75123',    'test@test.com',    '1231231234',   '123121234',   $ts,    $ts,   2147385600],
                [5, 3, 'John3', 'Ag',   'Member',   '1/1/1950', 'M',    '123 Test St.', 'Test', 43,   '75123',    'test@test.com',    '1231231234',   '123121234',   $ts,    $ts,   2147385600],
                [6, 3, 'John4', 'Au',   'Member',   '1/1/1950', 'M',    '123 Test St.', 'Test', 43,   '75123',    'test@test.com',    '1231231234',   '123121234',   $ts,    $ts,   2147385600],
                [9, 3, 'John5', 'A',    'Agent',    '1/1/1950', 'M',    '123 Test St.', 'Test', 43,   '75123',    'test@test.com',    '1231231234',   '123121234',   $ts,    $ts,   2147385600],
            ]
        );

        $this->batchInsert('payment_method',
            ['member_id', 'name', 'pay_type', 'f_name', 'l_name', 'routing', 'account_type', 'account',  'status', 'created_at', 'updated_at', 'sync_at'],
            [
                [1, 'Primary',  1,  'John', 'Member', '011000138',    1, '1234', 50, $ts,    $ts, 2147385600],
                [2, 'Primary',  1,  'John', 'Member', '011000138',    1, '1234', 50, $ts,    $ts, 2147385600],
                [3, 'Primary',  1,  'John', 'Member', '011000138',    1, '1234', 50, $ts,    $ts, 2147385600],
                [4, 'Primary',  1,  'John', 'Member', '011000138',    1, '1234', 50, $ts,    $ts, 2147385600],
                [5, 'Primary',  1,  'John', 'Member', '011000138',    1, '1234', 50, $ts,    $ts, 2147385600],
            ]
        );

        // hack to prevent test data from syncing to live systems - sync date of 2038-01-18T00:00:00+00:00
        $this->batchInsert('purchase',
            ['member_id', 'payment_id', 'type', 'membership_id', 'purchase_date', 'active_date', 'initial_bill_day', 'recurring_bill_day', 'created_at', 'updated_at', 'sync_at'],
            [
                [1,  1,  1,  1,  $ts,               ($ts+(86400*3)),      25, 25, $ts, $ts,   2147385600],
                [2,  2,  1,  2,  ($ts+(86400*7)),   ($ts+(86400*10)),      5,  5, $ts, $ts,   2147385600],
                [3,  3,  1,  3,  ($ts+(86400*17)),  ($ts+(86400*20)),     15, 15, $ts, $ts,   2147385600],
                [4,  4,  1,  4,  ($ts+(86400*27)),  ($ts+(86400*30)),     25, 25, $ts, $ts,   2147385600],
                [5,  5,  1,  4,  $ts,               ($ts+(86400*3)),      25, 25, $ts, $ts,   2147385600],
            ]
        );

        $this->batchInsert('purchase',
            ['member_id', 'payment_id', 'type', 'product_option_id', 'purchase_date', 'active_date', 'initial_bill_day', 'recurring_bill_day', 'created_at', 'updated_at', 'sync_at'],
            [
                [1, 1,  2,  1,  ($ts+(86400*7)),    ($ts+(86400*10)),     5, 25, $ts, $ts,    2147385600],
                [2, 2,  2,  2,  ($ts+(86400*27)),   ($ts+(86400*30)),    25,  5, $ts, $ts,    2147385600],
                [3, 3,  2,  3,  ($ts+(86400*29)),   ($ts+(86400*32)),    25, 15, $ts, $ts,    2147385600],
                [4, 4,  2,  4,  ($ts+(86400*37)),   ($ts+(86400*40)),     5, 25, $ts, $ts,    2147385600],
                [5, 5,  2,  5,  $ts,                ($ts+(86400*3)),     25, 25, $ts, $ts,    2147385600],
            ]
        );



        $this->batchInsert('agent_state_map',
            ['agent_id', 'state_id', 'created_at', 'updated_at'],
            [
                [3, 1, $ts, $ts],
                [3, 2, $ts, $ts],
                [3, 3, $ts, $ts],
                [3, 4, $ts, $ts],
                [3, 5, $ts, $ts],
                [3, 6, $ts, $ts],
                [3, 7, $ts, $ts],
                [3, 8, $ts, $ts],
                [3, 9, $ts, $ts],
                [3, 10, $ts, $ts],
                [3, 11, $ts, $ts],
                [3, 12, $ts, $ts],
                [3, 13, $ts, $ts],
                [3, 14, $ts, $ts],
                [3, 15, $ts, $ts],
                [3, 16, $ts, $ts],
                [3, 17, $ts, $ts],
                [3, 18, $ts, $ts],
                [3, 19, $ts, $ts],
                [3, 20, $ts, $ts],
                [3, 21, $ts, $ts],
                [3, 22, $ts, $ts],
                [3, 23, $ts, $ts],
                [3, 24, $ts, $ts],
                [3, 25, $ts, $ts],
                [3, 26, $ts, $ts],
                [3, 27, $ts, $ts],
                [3, 28, $ts, $ts],
                [3, 29, $ts, $ts],
                [3, 30, $ts, $ts],
                [3, 31, $ts, $ts],
                [3, 32, $ts, $ts],
                [3, 33, $ts, $ts],
                [3, 34, $ts, $ts],
                [3, 35, $ts, $ts],
                [3, 36, $ts, $ts],
                [3, 37, $ts, $ts],
                [3, 38, $ts, $ts],
                [3, 39, $ts, $ts],
                [3, 40, $ts, $ts],
                [3, 41, $ts, $ts],
                [3, 42, $ts, $ts],
                [3, 43, $ts, $ts],
                [3, 44, $ts, $ts],
                [3, 45, $ts, $ts],
                [3, 46, $ts, $ts],
                [3, 47, $ts, $ts],
                [3, 48, $ts, $ts],
                [3, 49, $ts, $ts],
                [3, 50, $ts, $ts],
                [3, 51, $ts, $ts],
                [3, 52, $ts, $ts],
                [3, 53, $ts, $ts],
                [3, 54, $ts, $ts],
                [3, 55, $ts, $ts],
                [3, 56, $ts, $ts],

                [2, 36, $ts,    $ts],
                [2, 43, $ts,    $ts],

                [1, 36, $ts,    $ts],

//                [4, 1, $ts, $ts],
//                [4, 2, $ts, $ts],
//                [4, 3, $ts, $ts],
//                [4, 4, $ts, $ts],
//                [4, 5, $ts, $ts],
//                [4, 6, $ts, $ts],
//                [4, 7, $ts, $ts],
//                [4, 8, $ts, $ts],
//                [4, 9, $ts, $ts],
//                [4, 10, $ts, $ts],
//                [4, 11, $ts, $ts],
//                [4, 12, $ts, $ts],
//                [4, 13, $ts, $ts],
//                [4, 14, $ts, $ts],
//                [4, 15, $ts, $ts],
//                [4, 16, $ts, $ts],
//                [4, 17, $ts, $ts],
//                [4, 18, $ts, $ts],
//                [4, 19, $ts, $ts],
//                [4, 20, $ts, $ts],
//                [4, 21, $ts, $ts],
//                [4, 22, $ts, $ts],
//                [4, 23, $ts, $ts],
//                [4, 24, $ts, $ts],
//                [4, 25, $ts, $ts],
//                [4, 26, $ts, $ts],
//                [4, 27, $ts, $ts],
//                [4, 28, $ts, $ts],
//                [4, 29, $ts, $ts],
//                [4, 30, $ts, $ts],
//                [4, 31, $ts, $ts],
//                [4, 32, $ts, $ts],
//                [4, 33, $ts, $ts],
//                [4, 34, $ts, $ts],
//                [4, 35, $ts, $ts],
//                [4, 36, $ts, $ts],
//                [4, 37, $ts, $ts],
//                [4, 38, $ts, $ts],
//                [4, 39, $ts, $ts],
//                [4, 40, $ts, $ts],
//                [4, 41, $ts, $ts],
//                [4, 42, $ts, $ts],
//                [4, 43, $ts, $ts],
//                [4, 44, $ts, $ts],
//                [4, 45, $ts, $ts],
//                [4, 46, $ts, $ts],
//                [4, 47, $ts, $ts],
//                [4, 48, $ts, $ts],
//                [4, 49, $ts, $ts],
//                [4, 50, $ts, $ts],
//                [4, 51, $ts, $ts],
//                [4, 52, $ts, $ts],
//                [4, 53, $ts, $ts],
//                [4, 54, $ts, $ts],
//                [4, 55, $ts, $ts],
//                [4, 56, $ts, $ts],
            ]
        );

        $this->batchInsert('provider_user',
            ['provider_id', 'user_id', 'f_name', 'm_name', 'l_name', 'created_at', 'updated_at'],
            [
                [1, 8,  'John',    'P',    'Agent', $ts,    $ts],
                [9, 9,  'John',    'T',    'Agent', $ts,    $ts],
            ]
        );

        $this->batchInsert('provider_agent_map',
            ['provider_id', 'agent_id', 'created_at', 'updated_at'],
            [
                [9,     1,  $ts,    $ts],
                [9,     2,  $ts,    $ts],
                [9,     3,  $ts,    $ts],

                [10,    1,  $ts,    $ts],
                [10,    2,  $ts,    $ts],

                [11,    1,  $ts,    $ts],
            ]
        );
    }

    public function down()
    {
        echo "m170614_174107_users cannot be reverted.\n";

        return false;
    }

}
