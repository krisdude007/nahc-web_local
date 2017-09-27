<?php

use yii\db\Migration;

class m170927_130353_agent_state_update extends Migration
{
    public function up()
    {
        $ts = time();

        $this->batchInsert('agent_state_map',
            ['agent_id', 'state_id', 'created_at', 'updated_at'],
            [
                [21,1,$ts,$ts],
                [21,9,$ts,$ts],
                [21,10,$ts,$ts],
                [21,18,$ts,$ts],
                [21,35,$ts,$ts],
            ]
        );
        $this->batchInsert('user',
            ['username', 'password_hash', 'auth_key', 'password_reset_token', 'email', 'has_agent', 'created_at', 'updated_at'],
            [
                ['agility_ins',Yii::$app->security->generatePasswordHash('temp_140929'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'support@aisbenefits.com',true,$ts,$ts],
                ['all.american',Yii::$app->security->generatePasswordHash('temp_140930'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'mike@allamericanbrokers.com',true,$ts,$ts],
                ['all.aboard',Yii::$app->security->generatePasswordHash('temp_140934'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'mike@allaboardbenefits.net',true,$ts,$ts],
                ['all.insurance',Yii::$app->security->generatePasswordHash('temp_140937'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'mike2@allamericanbrokers.com',true,$ts,$ts],
                ['jason_smith',Yii::$app->security->generatePasswordHash('temp_140939'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'jasonsmith1021@gmail.com',true,$ts,$ts],
                ['alicia.tranum',Yii::$app->security->generatePasswordHash('temp_140947'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'benefitsx@netzero.net',true,$ts,$ts],
                ['brenda.rose',Yii::$app->security->generatePasswordHash('temp_140952'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'b.rose@allaboardbenefits.com',true,$ts,$ts],
                ['bobby.young',Yii::$app->security->generatePasswordHash('temp_140955'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'bobby@allaboardbenefits.net',true,$ts,$ts],
                ['icg_hopkins',Yii::$app->security->generatePasswordHash('temp_140975'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'jdhopkins@webicg.com',true,$ts,$ts],
                ['kevin.reese',Yii::$app->security->generatePasswordHash('temp_140989'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'bachinsgroup@bachig.com',true,$ts,$ts],
                ['kevin_reese',Yii::$app->security->generatePasswordHash('temp_141000'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'kreese@bachig.com',true,$ts,$ts],
                ['suzi.mcalpine2',Yii::$app->security->generatePasswordHash('temp_141002'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'baseballmoma2@sbcglobal.net',true,$ts,$ts],
                ['george_mitchell',Yii::$app->security->generatePasswordHash('temp_141003'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'george@totalinsurance4u.com',true,$ts,$ts],
                ['alternet.benefits',Yii::$app->security->generatePasswordHash('temp_141060'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'mike@alternetbenefits.com',true,$ts,$ts],
                ['tom.rotole',Yii::$app->security->generatePasswordHash('temp_141084'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'tvrassoc@outlook.com',true,$ts,$ts],
                ['wiley_long',Yii::$app->security->generatePasswordHash('temp_141328'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'info@hsaforamerica.com',true,$ts,$ts],
                ['ron.cunningham',Yii::$app->security->generatePasswordHash('temp_141340'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'cunninghamrons@yahoo.com',true,$ts,$ts],
                ['david.crockett',Yii::$app->security->generatePasswordHash('temp_141370'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'dcrockett@aisbenefits.com',true,$ts,$ts],
                ['richard_mayer',Yii::$app->security->generatePasswordHash('temp_141382'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'richmayer@richardmayerinsurance.com',true,$ts,$ts],
                ['michael_martin',Yii::$app->security->generatePasswordHash('temp_141391'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'mike@mdmins.com',true,$ts,$ts],
                ['vern.juel',Yii::$app->security->generatePasswordHash('temp_141549'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'vjuel@charter.net',true,$ts,$ts],
                ['robin.cruson',Yii::$app->security->generatePasswordHash('temp_141559'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'robin@crusoninsurance.com',true,$ts,$ts],
                ['harry.cain',Yii::$app->security->generatePasswordHash('temp_141571'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'hpcain@gmail.com',true,$ts,$ts],
                ['brett_martin',Yii::$app->security->generatePasswordHash('temp_141610'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'faststartinsurance@gmail.com',true,$ts,$ts],
                ['david_rubey',Yii::$app->security->generatePasswordHash('temp_141756'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'David@DMRInsuranceServices.com  ',true,$ts,$ts],
                ['david_may',Yii::$app->security->generatePasswordHash('temp_141804'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'david@esick.org',true,$ts,$ts],
                ['agility.dc',Yii::$app->security->generatePasswordHash('temp_141807'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'dcrockett+1@aisbenefits.com',true,$ts,$ts],
                ['charles.frazier',Yii::$app->security->generatePasswordHash('temp_141862'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'charles@alliedinsadv.com',true,$ts,$ts],
                ['mike.browne',Yii::$app->security->generatePasswordHash('temp_141872'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'info@nacdbenefits.com',true,$ts,$ts],
                ['robb.rothrock2',Yii::$app->security->generatePasswordHash('temp_146069'),Yii::$app->security->generateRandomString(),Yii::$app->security->generateRandomString() . '_' .$ts,'robb@saferetirements.com',true,$ts,$ts],
            ]);

        $this->batchInsert('agent',
            ['user_id', 'ext_id', 'f_name', 'l_name', 'organization', 'address', 'city', 'state_id', 'zip', 'phone', 'email',  'created_at', 'updated_at'],
            [
                [40,'140929','STEVE','MCLAUGHLIN',"AGILITY INSURANCE SERVICES",'16775 ADDISON ROAD, SUITE 605','ADDISON',43,'75001','8665909771','support@aisbenefits.com', $ts, $ts],
                [41,'140930','MIKE','CROWSTON',"ALL AMERICAN BROKERS",'11070 DELFORD CIRCLE','DALLAS',43,'75228','8004622322','mike@allamericanbrokers.com', $ts, $ts],
                [42,'140934','MIKE','CROWSTON',"ALL ABOARD BENEFITS",'11070 DELFORD CIRCLE','DALLAS',43,'75228','8004622322','mike@allaboardbenefits.net', $ts, $ts],
                [43,'140937','MIKE','CROWSTON',"NACD BENEFITS",'16801 ADDISON RD. SUITE 247','ADDISON',43,'75001','8888719660','mike@allamericanbrokers.com', $ts, $ts],
                [44,'140939','JASON','SMITH',"HEARTLAND INSURANCE SOLUTIONS",'PO BOX 850095','YUKON',36,'73085','4053230235','jasonsmith1021@gmail.com', $ts, $ts],
                [45,'140947','ALICIA','TRANUM',"BEYOND BENEFITS",'4130 FORT HENRY DRIVE','KINGSPORT',42,'37663','4232390015','benefitsx@netzero.net', $ts, $ts],
                [46,'140952','BRENDA','ROSE',"ALL ABOARD BENEFITS",'6162 E MOCKINGBIRD LN','DALLAS',43,'75214','8004622322','b.rose@allaboardbenefits.com', $ts, $ts],
                [47,'140955','BOBBY','YOUNG',"ALL ABOARD BENEFITS",'6504 WICKLIFF TRL','PLANO',43,'75023','2148216677','bobby@allaboardbenefits.net', $ts, $ts],
                [48,'140975','DAVID','HOPKINS JR',"INSURANCE CONSULTANTS GROUP  LLC",'4361 BLOSSOM HILL RD','MORTON',24,'39117','8888280905','jdhopkins@webicg.com', $ts, $ts],
                [49,'140989','KEVIN','REESE',"BACH INSURANCE GROUP",'202 W. LOUISIANA STREET #208','MCKINNEY',43,'75069','2148564761','bachinsgroup@bachig.com', $ts, $ts],
                [50,'141000','KEVIN','REESE',"BACH INSURANCE GROUP",'506 COLORADO ST.','SHERMAN',43,'75090','2148564761','kreese@bachig.com', $ts, $ts],
                [51,'141002','SUZI','MCALPINE',null,'8033 KRISTINA LN.','NORTH RICHLAND HILLS',43,'76182','8175018732','baseballmoma@sbcglobal.net', $ts, $ts],
                [52,'141003','GEORGE','MITCHELL',"MITCHELL'S FAMILY INSURANCE",'3056 E. JEROME','MESA',3,'85204','4806649227','george@totalinsurance4u.com', $ts, $ts],
                [53,'141060','MICHAEL','BROWNE',"ALTERNET BENEFITS",'4450 ARAPAHOE AVENUE','BOULDER',6,'80303','3036799600','mike@alternetbenefits.com', $ts, $ts],
                [54,'141084','THOMAS ','ROTOLE',"ROTOLE & ASSOCIATES, INC. ",'1935 SW ANDREW RD.','TOWANDA',16,'67144','3165412770','tvrassoc@outlook.com', $ts, $ts],
                [55,'141328','WILEY','LONG',"WILEY LONG ENTERPRISES, INC.",'1001-A E. HARMONY RD #519','FORT COLLINS',6,'80525','8667492039','info@hsaforamerica.com', $ts, $ts],
                [56,'141340','RON','CUNNINGHAM',null,'980998 S 3390 RD','MEEKER',36,'74855','4058315270','cunninghamrons@yahoo.com', $ts, $ts],
                [57,'141370','DAVID','CROCKETT',null,'16775 ADDISON RD.','ADDISON',43,'75001','8665909771','dcrockett@aisbenefits.com', $ts, $ts],
                [58,'141382','RICHARD','MAYER',null,'3704 WINDSTONE DR','PLANO',43,'75023','9726187270','richmayer@richardmayerinsurance.com', $ts, $ts],
                [59,'141391','MICHAEL','MARTIN',"MDM INSURANCE SOLUTIONS",'7001 W PARKER RD. #422','PLANO',43,'75093','9407351515','mike@mdmins.com', $ts, $ts],
                [60,'141549','VERN','JUEL',null,'122 PALOMINO CT.','DENTON',43,'76208','9402390598','vjuel@charter.net', $ts, $ts],
                [61,'141559','ROBIN','CRUSON',"ROBIN G CRUSON dba Cruson Insurance Agency",'8105 RASOR BLVD','PLANO',43,'75024','9728963851','robin@crusoninsurance.com', $ts, $ts],
                [62,'141571','HARRY','CAIN III',"HPCAIN CONSULTING, LLC",'3673 FORTINGALE ROAD','ATLANTA',10,'30341','4049139472','hpcain@gmail.com', $ts, $ts],
                [63,'141610','BRETT','MARTIN',null,'1033 B AVENUE, SUITE 101-125','CORONADO',5,'92118','6194899368','faststartinsurance@gmail.com', $ts, $ts],
                [64,'141756','DAVID','RUBEY',null,'978 CASSION DR.','LEWISVILLE',43,'75067','9727575337','David@DMRInsuranceServices.com  ', $ts, $ts],
                [65,'141804','DAVID','MAY',null,'1875 50TH AVE','PAWNEE ROCK',16,'67567','6208040736','david@esick.org', $ts, $ts],
                [66,'141807','DAVID','CROCKETT',"AGILITY INSURANCE SERVICES",'16775 ADDISON ROAD','ADDISON',43,'75001','8008801276','dcrockett+1@aisbenefits.com', $ts, $ts],
                [67,'141862','CHARLES','FRAZIER',"ALLIED INSURANCE ADVISORS, LLC",'3461 - F LAWRENCEVILLE-SUWANEE RD','SUWANEE',10,'30024','6785467890','charles@alliedinsadv.com', $ts, $ts],
                [68,'141872','MIKE','BROWNE',"ALTERNET BENEFITS",'16801 ADDISON RD., SUITE 247','ADDISON',43,'75001','8446400400','info@nacdbenefits.com', $ts, $ts],
                [69,'146069','Robb ','Rothrock',"American Health Benefits",'908 Audelia Rd # 200-257','Richardson',43,'75081','2144142857','robb@saferetirements.com', $ts, $ts],
            ]);

        $this->batchInsert('agent_state_map',
            ['agent_id', 'state_id', 'created_at', 'updated_at'],
            [
                [46,6,$ts,$ts],
                [46,38,$ts,$ts],
                [46,40,$ts,$ts],
                [46,9,$ts,$ts],
                [46,10,$ts,$ts],
                [46,42,$ts,$ts],
                [46,35,$ts,$ts],
                [46,14,$ts,$ts],
                [46,11,$ts,$ts],
                [46,13,$ts,$ts],
                [46,43,$ts,$ts],
                [51,43,$ts,$ts],
                [51,36,$ts,$ts],
                [51,5,$ts,$ts],
                [45,16,$ts,$ts],
                [45,23,$ts,$ts],
                [47,36,$ts,$ts],
                [52,43,$ts,$ts],
                [60,43,$ts,$ts],
                [60,34,$ts,$ts],
                [60,23,$ts,$ts],
                [60,13,$ts,$ts],
                [60,28,$ts,$ts],
                [60,26,$ts,$ts],
                [49,43,$ts,$ts],
                [59,43,$ts,$ts],
                [43,3,$ts,$ts],
                [50,43,$ts,$ts],
                [50,36,$ts,$ts],
                [41,43,$ts,$ts],
                [40,43,$ts,$ts],
                [35,36,$ts,$ts],
                [35,42,$ts,$ts],
                [35,23,$ts,$ts],
                [39,24,$ts,$ts],
                [39,13,$ts,$ts],
                [39,2,$ts,$ts],
                [39,43,$ts,$ts],
                [39,18,$ts,$ts],
                [53,10,$ts,$ts],
                [53,44,$ts,$ts],
                [53,3,$ts,$ts],
                [55,43,$ts,$ts],
                [55,9,$ts,$ts],
                [55,10,$ts,$ts],
                [56,16,$ts,$ts],
                [48,43,$ts,$ts],
                [57,43,$ts,$ts],
                [54,5,$ts,$ts],
                [37,43,$ts,$ts],
                [37,35,$ts,$ts],
                [37,38,$ts,$ts],
                [37,5,$ts,$ts],
                [37,6,$ts,$ts],
                [38,43,$ts,$ts],
                [38,1,$ts,$ts],
                [38,11,$ts,$ts],
                [38,49,$ts,$ts],
                [38,5,$ts,$ts],
                [38,13,$ts,$ts],
                [44,6,$ts,$ts],
                [44,9,$ts,$ts],
                [44,16,$ts,$ts],
                [44,23,$ts,$ts],
                [44,43,$ts,$ts],
                [44,3,$ts,$ts],
                [44,28,$ts,$ts],
                [44,35,$ts,$ts],
                [58,10,$ts,$ts],
                [34,43,$ts,$ts],
                [32,43,$ts,$ts],
                [32,22,$ts,$ts],
                [32,38,$ts,$ts],
                [33,43,$ts,$ts],
                [33,21,$ts,$ts],
                [33,7,$ts,$ts],
                [33,34,$ts,$ts],
                [33,38,$ts,$ts],
                [33,26,$ts,$ts],
                [33,40,$ts,$ts],
                [33,10,$ts,$ts],
                [33,9,$ts,$ts],
                [33,44,$ts,$ts],
                [33,42,$ts,$ts],
                [33,24,$ts,$ts],
                [33,14,$ts,$ts],
                [33,17,$ts,$ts],
                [33,13,$ts,$ts],
                [33,23,$ts,$ts],
                [33,27,$ts,$ts],
                [33,18,$ts,$ts],
                [33,36,$ts,$ts],
                [33,6,$ts,$ts],
                [33,5,$ts,$ts],
                [33,47,$ts,$ts],
                [33,1,$ts,$ts],
                [36,42,$ts,$ts],
                [31,43,$ts,$ts],
                [31,26,$ts,$ts],
                [31,40,$ts,$ts],
            ]
        );
    }

    public function safeDown()
    {
        echo "m170927_130353_agent_state_update cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170927_130353_agent_state_update cannot be reverted.\n";

        return false;
    }
    */
}
