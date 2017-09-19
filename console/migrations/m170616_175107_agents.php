<?php

use common\models\User;
use yii\db\Migration;

class m170616_175107_agents extends Migration
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
        $ts = time();

        $this->batchInsert('user',
            ['username', 'password_hash', 'auth_key', 'password_reset_token', 'email', 'has_agent', 'has_member', 'created_at', 'updated_at'],
            [
                ['steve.wendlandt',     Yii::$app->security->generatePasswordHash('temp_140954'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'stevew@selectedbenefits.com',          true,   false, $ts,    $ts],
                ['todd.madrid',         Yii::$app->security->generatePasswordHash('temp_140972'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'toddmcic@gmail.com',                   true,   false, $ts,    $ts],
                ['mark_harris',         Yii::$app->security->generatePasswordHash('temp_140987'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'markdharris@cox.net',                  true,   false, $ts,    $ts],
                ['bob.jabour',          Yii::$app->security->generatePasswordHash('temp_141011'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'bob@texashealthnow.com',               true,   false, $ts,    $ts],
                ['grace.tornik',        Yii::$app->security->generatePasswordHash('temp_141072'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'gracetornik@yahoo.com',                true,   false, $ts,    $ts],
                ['reed.hitch',          Yii::$app->security->generatePasswordHash('temp_141093'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'reedhitch@msn.com',                    true,   false, $ts,    $ts],
                ['chris.ford',          Yii::$app->security->generatePasswordHash('temp_141165'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'chris.ford1@cox.net',                  true,   false, $ts,    $ts],
                ['rick.hamilton',       Yii::$app->security->generatePasswordHash('temp_141182'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'rick.health@yahoo.com',                true,   false, $ts,    $ts],
                ['steve.herman',        Yii::$app->security->generatePasswordHash('temp_141253'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'steveherman68@sbcglobal.net',          true,   false, $ts,    $ts],
                ['ao.insurance',        Yii::$app->security->generatePasswordHash('temp_141295'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'lisa.aoinsagency@gmail.com',           true,   false, $ts,    $ts],
                ['phil.raskin',         Yii::$app->security->generatePasswordHash('temp_141326'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'lisamcconville2013@gmail.com',         true,   false, $ts,    $ts],
                ['charles_harrell',     Yii::$app->security->generatePasswordHash('temp_141335'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'c.harrell@allaboardbenefits.net',      true,   false, $ts,    $ts],
                ['greg_myers',          Yii::$app->security->generatePasswordHash('temp_141420'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'greg@health-quotes.com',               true,   false, $ts,    $ts],
                ['ryan.howell',         Yii::$app->security->generatePasswordHash('temp_141483'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'protectiveplanning@hotmail.com',       true,   false, $ts,    $ts],
                ['taryn.collins',       Yii::$app->security->generatePasswordHash('temp_141553'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'taryn@streamlinebg.com',               true,   false, $ts,    $ts],
                ['james.rippel',        Yii::$app->security->generatePasswordHash('temp_141612'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'jim@chsmkting.com',                    true,   false, $ts,    $ts],
                ['reginald.jackson',    Yii::$app->security->generatePasswordHash('temp_141768'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'reggiej@rjinsures.com',                true,   false, $ts,    $ts],
                ['daniel.moen',         Yii::$app->security->generatePasswordHash('temp_141820'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'danielsinbox@yahoo.com',               true,   false, $ts,    $ts],
                ['todd_madrid',         Yii::$app->security->generatePasswordHash('temp_141875'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'tmadrid45@gmail.com',                  true,   false, $ts,    $ts],
                ['charity.bliss',       Yii::$app->security->generatePasswordHash('temp_141896'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'charityblissinc@gmail.com',            true,   false, $ts,    $ts],
                ['sean.collins',        Yii::$app->security->generatePasswordHash('temp_141908'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'collins4s@sbcglobal.net',              true,   false, $ts,    $ts],
                ['scott_eckley',        Yii::$app->security->generatePasswordHash('temp_141916'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'seckley@apollo-insurance.com',         true,   false, $ts,    $ts],
                ['tom_albers',          Yii::$app->security->generatePasswordHash('temp_141924'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'tom.healthcaresolutions@gmail.com',    true,   false, $ts,    $ts],
                ['tracey_white',        Yii::$app->security->generatePasswordHash('temp_194697'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'tracey@health-quotes.com',             true,   false, $ts,    $ts],
                ['rmig',                Yii::$app->security->generatePasswordHash('temp_260975'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'russ@russmillerinsurancegroup.com',    true,   true,  $ts,    $ts],
                ['vel.roe',             Yii::$app->security->generatePasswordHash('temp_141377'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'arvella1952@yahoo.com',                true,   false, $ts,    $ts],
                ['suzi.mcalpine',       Yii::$app->security->generatePasswordHash('temp_141002'),   Yii::$app->security->generateRandomString(),    Yii::$app->security->generateRandomString() . '_' .$ts,     'baseballmoma@sbcglobal.net',           true,   false, $ts,    $ts],
            ]
        );

        $this->batchInsert('agent',
            ['user_id', 'ext_id', 'f_name', 'l_name', 'organization', 'address', 'city', 'state_id', 'zip', 'phone', 'email',  'created_at', 'updated_at'],
            [
                [ 10, '140954',  'STEVEN',      'WENDLANDT',    null,                           '3000 WESLAYAN, SUITE 318',         'HOUSTON',              43, '77027',    '7136211440',   'stevew@selectedbenefits.com',          $ts,    $ts],
                [ 11, '140972',  'TODD',        'MADRID',       null,                           '8105 RANCHO DE LA OSA TR.',        'MCKINNEY',             43, '75070',    '9727627570',   'toddmcic@gmail.com',                   $ts,    $ts],
                [ 12, '140987',  'MARK',        'HARRIS',       null,                           '2715 16TH STREET',                 'GREAT BEND',           16, '67530',    '6207924560',   'markdharris@cox.net',                  $ts,    $ts],
                [ 13, '141011',  'ROBERT',      'JABOUR II',    null,                           '5068 WEST PLANO PKWY, STE 300',    'PLANO',                43, '75093',    '9723814232',   'bob@texashealthnow.com',               $ts,    $ts],
                [ 14, '141072',  'GRACE',       'TORNIK',       null,                           '6300 CARRIZO DR.',                 'GRANBURY',             43, '76049',    '8172191901',   'gracetornik@yahoo.com',                $ts,    $ts],
                [ 15, '141093',  'REED',        'HITCH',        null,                           '3223 S LOOP 289 #240C',            'LUBBOCK',              43, '79423',    '8067501210',   'reedhitch@msn.com',                    $ts,    $ts],
                [ 16, '141165',  'CHRISTOPHER', 'FORD',         "FORD INS. SERVICES",           'PO BOX 30282',                     'MIDWEST CITY',         36, '73140',    '4052458253',   'chris.ford1@cox.net',                  $ts,    $ts],
                [ 17, '141182',  'RICHARD',     'HAMILTON',     "HAMILTON GROUP",               '2212 MULBERRY LANE',               'NEWCASTLE',            36, '73065',    '4053141763',   'rick.health@yahoo.com',                $ts,    $ts],
                [ 18, '141253',  'STEVE',       'HERMAN',       null,                           '6142 BRANDEIS LN',                 'DALLAS',               43, '75214',    '2143638771',   'steveherman68@sbcglobal.net',          $ts,    $ts],
                [ 19, '141295',  'PHIL',        'RASKIN',       "AO INSURANCE AGENCY INC",      '7066 LAKEVIEW HAVEN DR STE108',    'HOUSTON',              43, '77095',    '2813450805',   'lisa.aoinsagency@gmail.com',           $ts,    $ts],
                [ 20, '141326',  'PHIL',        'RASKIN',       "ISURE,LLC",                    '7066 LAKEVIEW HAVEN DR, #108',     'HOUSTON',              43, '77095',    '2813450805',   'lisamcconville2013@gmail.com',         $ts,    $ts],
                [ 21, '141335',  'CHARLES',     'HARRELL',      "CHARLES HARRELL",              '5920 E. UNIVERSITY BLVD #4116',    'DALLAS',               43, '75206',    '8004622322',   'c.harrell@allaboardbenefits.net',      $ts,    $ts],
                [ 22, '141420',  'GREG',        'MYERS',        "TEXAS MEDICAL PLANS LLC",      'PO BOX 1270',                      'WIMBERLEY',            43, '78676',    '8887503164',   'tracey@health-quotes.com',             $ts,    $ts],
                [ 23, '141483',  'RYAN',        'HOWELL',       null,                           '10 HOLMSBY LN',                    'TAYLORS',              40, '29687',    '8649791006',   'protectiveplanning@hotmail.com',       $ts,    $ts],
                [ 24, '141553',  'TARYN',       'COLLINS',      "STREAMLINE BENEFITS GROUP",    '5443 FOX RUN BLVD',                'FREDERICK',             6, '80504',    '7206758350',   'taryn@streamlinebg.com',               $ts,    $ts],
                [ 25, '141612',  'JAMES',       'RIPPEL',       "RIPPEL & ASSOCIATES",          '8955 BEAR CREEK',                  'SYLVANIA',             35, '43560',    '4193182323',   'jim@chsmkting.com',                    $ts,    $ts],
                [ 26, '141768',  'REGINALD',    'JACKSON',      "RJ INSURANCE SERVICES",        '10202 ANGELL STREET',              'DOWNEY',                5, '90242',    '8773601144',   'reggiej@rjinsures.com',                $ts,    $ts],
                [ 27, '141820',  'DANIEL',      'MOEN',         null,                           '5400 CLARK AVE #107',              'LAKEWOOD',              5, '90712',    '5624728177',   'danielsinbox@yahoo.com',               $ts,    $ts],
                [ 28, '141875',  'TODD',        'MADRID',       null,                           '8105 RANCHO DE LA OSA TRAIL',      'MCKINNEY',             43, '75070',    '9727627570',   'tmadrid45@gmail.com',                  $ts,    $ts],
                [ 29, '141896',  'CHARITY',     'BLISS',        "CHARITY BLISS INC",            '941 NE 19TH AVE',                  'FORT LAUDERDALE',       9, '33304',    '3214325805',   'charityblissinc@gmail.com',            $ts,    $ts],
                [ 30, '141908',  'SEAN',        'COLLINS',      null,                           '1130 CHARLESTON STREET',           'COSTA MESA',            5, '92626',    '9494224003',   'collins4s@sbcglobal.net',              $ts,    $ts],
                [ 31, '141916',  'SCOTT',       'ECKLEY',       "APOLLO INSURANCE GROUP, INC",  '200 NE MISSOURI RD #200',          'LEES SUMMIT',          23, '64086',    '9132790077',   'seckley@apollo-insurance.com',         $ts,    $ts],
                [ 32, '141924',  'TOM',         'ALBERS',       null,                           '3021 YELLOWSTONE DR',              'LAWRENCE',             16, '66047',    '7855504922',   'tom.healthcaresolutions@gmail.com',    $ts,    $ts],
                [ 33, '194697',  'Tracey',      'White',        "Texas Medical Plans",          'PO Box 1270',                      'Wimberley',            43, '78676',    '8887503164',   'tracey@health-quotes.com',             $ts,    $ts],
                [ 34, '260975',  'Russell',     'Miller',       "Russ Miller Insurance Group",  '16801 Addison Road',               'Addison',              43, '75001',    '8174001084',   'russ@russmillerinsurancegroup.com',    $ts,    $ts],
                [ 35, '141377',  'VEL',         'ROE',          null,                           '3118 SO. CO. RD. 1069',            'MIDLAND',              43, '79706',    '4322386677',   'arvella1952@yahoo.com',                $ts,    $ts],
                [ 36, '141002',  'SUZI',        'MCALPINE',     null,                           '8033 KRISTINA LN.',                'NORTH RICHLAND HILLS', 43, '76182',    '8175018732',   'baseballmoma@sbcglobal.net',           $ts,    $ts],
            ]
        );

        $this->batchInsert('agent_state_map',
            ['agent_id', 'state_id', 'created_at', 'updated_at'],
            [
                [22,14,$ts,$ts],
                [22,22,$ts,$ts],
                [22,27,$ts,$ts],
                [22,40,$ts,$ts],
                [22,43,$ts,$ts],
                [22,9,$ts,$ts],
                [22,16,$ts,$ts],
                [22,21,$ts,$ts],
                [22,28,$ts,$ts],
                [4,43,$ts,$ts],
                [4,9,$ts,$ts],
                [10,1,$ts,$ts],
                [10,2,$ts,$ts],
                [10,10,$ts,$ts],
                [10,11,$ts,$ts],
                [10,36,$ts,$ts],
                [10,40,$ts,$ts],
                [10,42,$ts,$ts],
                [10,43,$ts,$ts],
                [10,16,$ts,$ts],
                [13,43,$ts,$ts],
                [25,1,$ts,$ts],
                [25,3,$ts,$ts],
                [25,5,$ts,$ts],
                [25,10,$ts,$ts],
                [25,11,$ts,$ts],
                [25,18,$ts,$ts],
                [25,23,$ts,$ts],
                [25,26,$ts,$ts],
                [25,27,$ts,$ts],
                [25,35,$ts,$ts],
                [25,36,$ts,$ts],
                [25,38,$ts,$ts],
                [25,40,$ts,$ts],
                [25,42,$ts,$ts],
                [25,43,$ts,$ts],
                [25,9,$ts,$ts],
                [25,13,$ts,$ts],
                [25,16,$ts,$ts],
                [6,3,$ts,$ts],
                [6,6,$ts,$ts],
                [6,22,$ts,$ts],
                [6,27,$ts,$ts],
                [6,27,$ts,$ts],
                [6,36,$ts,$ts],
                [6,43,$ts,$ts],
                [6,44,$ts,$ts],
                [6,16,$ts,$ts],
                [9,27,$ts,$ts],
                [9,36,$ts,$ts],
                [9,43,$ts,$ts],
                [14,43,$ts,$ts],
                [16,43,$ts,$ts],
                [20,5,$ts,$ts],
                [20,22,$ts,$ts],
                [20,26,$ts,$ts],
                [20,27,$ts,$ts],
                [20,35,$ts,$ts],
                [20,40,$ts,$ts],
                [20,43,$ts,$ts],
                [26,11,$ts,$ts],
                [26,23,$ts,$ts],
                [26,36,$ts,$ts],
                [26,42,$ts,$ts],
                [26,16,$ts,$ts],
                [5,14,$ts,$ts],
                [5,22,$ts,$ts],
                [5,27,$ts,$ts],
                [5,40,$ts,$ts],
                [5,43,$ts,$ts],
                [5,9,$ts,$ts],
                [5,16,$ts,$ts],
                [5,21,$ts,$ts],
                [5,28,$ts,$ts],
                [7,22,$ts,$ts],
                [7,43,$ts,$ts],
                [7,44,$ts,$ts],
                [8,43,$ts,$ts],
                [21,3,$ts,$ts],
                [21,5,$ts,$ts],
                [21,38,$ts,$ts],
                [21,43,$ts,$ts],
                [21,13,$ts,$ts],
                [11,36,$ts,$ts],
                [24,3,$ts,$ts],
                [24,5,$ts,$ts],
                [24,43,$ts,$ts],
                [19,22,$ts,$ts],
                [19,35,$ts,$ts],
                [19,38,$ts,$ts],
                [19,40,$ts,$ts],
                [19,9,$ts,$ts],
                [23,43,$ts,$ts],
                [23,9,$ts,$ts],
                [15,43,$ts,$ts],
                [15,44,$ts,$ts],
                [28,36,$ts,$ts],
                [28,43,$ts,$ts],
                [12,43,$ts,$ts],
                [18,5,$ts,$ts],
                [18,6,$ts,$ts],
                [18,23,$ts,$ts],
                [18,27,$ts,$ts],
                [18,38,$ts,$ts],
                [18,43,$ts,$ts],
                [18,16,$ts,$ts],
                [18,44,$ts,$ts],
                [17,40,$ts,$ts],
                [17,10,$ts,$ts],
                [17,26,$ts,$ts],
                [27,43,$ts,$ts],
                [29,43,$ts,$ts],
                [30,43,$ts,$ts],
                [30,36,$ts,$ts],
                [30,23,$ts,$ts],
                [30,16,$ts,$ts],
                [30,6,$ts,$ts],
                [30,27,$ts,$ts],
                [30,3,$ts,$ts],
                [30,24,$ts,$ts],
                [30,1,$ts,$ts],
                [30,18,$ts,$ts],
                [30,42,$ts,$ts],
                [30,17,$ts,$ts],
                [30,26,$ts,$ts],
                [30,23,$ts,$ts],
                [30,22,$ts,$ts],
                [30,2,$ts,$ts],
                [30,13,$ts,$ts],
                [30,14,$ts,$ts],
            ]
        );


        $this->batchInsert('provider_agent_map',
            ['agent_id', 'provider_id', 'created_at', 'updated_at'],
            [
                [4, 9, $ts, $ts], [4, 10, $ts, $ts], [4, 11, $ts, $ts],
                [5, 9, $ts, $ts], [5, 10, $ts, $ts], [5, 11, $ts, $ts],
                [6, 9, $ts, $ts], [6, 10, $ts, $ts], [6, 11, $ts, $ts],
                [7, 9, $ts, $ts], [7, 10, $ts, $ts], [7, 11, $ts, $ts],
                [8, 9, $ts, $ts], [8, 10, $ts, $ts], [8, 11, $ts, $ts],
                [9, 9, $ts, $ts], [9, 10, $ts, $ts], [9, 11, $ts, $ts],
                [10, 9, $ts, $ts], [10, 10, $ts, $ts], [10, 11, $ts, $ts],
                [11, 9, $ts, $ts], [11, 10, $ts, $ts], [11, 11, $ts, $ts],
                [12, 9, $ts, $ts], [12, 10, $ts, $ts], [12, 11, $ts, $ts],
                [13, 9, $ts, $ts], [13, 10, $ts, $ts], [13, 11, $ts, $ts],
                [14, 9, $ts, $ts], [14, 10, $ts, $ts], [14, 11, $ts, $ts],
                [15, 9, $ts, $ts], [15, 10, $ts, $ts], [15, 11, $ts, $ts],
                [16, 9, $ts, $ts], [16, 10, $ts, $ts], [16, 11, $ts, $ts],
                [17, 9, $ts, $ts], [17, 10, $ts, $ts], [17, 11, $ts, $ts],
                [18, 9, $ts, $ts], [18, 10, $ts, $ts], [18, 11, $ts, $ts],
                [19, 9, $ts, $ts], [19, 10, $ts, $ts], [19, 11, $ts, $ts],
                [20, 9, $ts, $ts], [20, 10, $ts, $ts], [20, 11, $ts, $ts],
                [21, 9, $ts, $ts], [21, 10, $ts, $ts], [21, 11, $ts, $ts],
                [22, 9, $ts, $ts], [22, 10, $ts, $ts], [22, 11, $ts, $ts],
                [23, 9, $ts, $ts], [23, 10, $ts, $ts], [23, 11, $ts, $ts],
                [24, 9, $ts, $ts], [24, 10, $ts, $ts], [24, 11, $ts, $ts],
                [25, 9, $ts, $ts], [25, 10, $ts, $ts], [25, 11, $ts, $ts],
                [26, 9, $ts, $ts], [26, 10, $ts, $ts], [26, 11, $ts, $ts],
                [27, 9, $ts, $ts], [27, 10, $ts, $ts], [27, 11, $ts, $ts],
                [28, 9, $ts, $ts], [28, 10, $ts, $ts], [28, 11, $ts, $ts],
                [29, 9, $ts, $ts], [29, 10, $ts, $ts], [29, 11, $ts, $ts],
                [30, 9, $ts, $ts], [30, 10, $ts, $ts], [30, 11, $ts, $ts],
            ]
        );


    }

    public function down()
    {
        echo "m170614_174107_users cannot be reverted.\n";

        return false;
    }

}
