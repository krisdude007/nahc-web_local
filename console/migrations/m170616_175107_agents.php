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

        $this->batchInsert('agent',
            [ 'ext_id', 'f_name', 'l_name', 'organization', 'address', 'city', 'state_id', 'zip', 'phone', 'email',  'created_at', 'updated_at'],
            [
                ['136154','Marti','Shelton',"Innovative Benefit Solutions",'16801 Addison Road','ADDISON',43,'75001','8172911461','mshelton@rewardamerica.com', $ts, $ts],
                ['140929','STEVE','MCLAUGHLIN',"AGILITY INSURANCE SERVICES",'16775 ADDISON ROAD, SUITE 605','ADDISON',43,'75001','8665909771','support@aisbenefits.com', $ts, $ts],
                ['140930','MIKE','CROWSTON',"ALL AMERICAN BROKERS",'11070 DELFORD CIRCLE','DALLAS',43,'75228','8004622322','mike@allamericanbrokers.com', $ts, $ts],
                ['140934','MIKE','CROWSTON',"ALL ABOARD BENEFITS",'11070 DELFORD CIRCLE','DALLAS',43,'75228','8004622322','mike@allaboardbenefits.net', $ts, $ts],
                ['140937','NACD','BENEFITS',"NACD BENEFITS",'16801 ADDISON RD. SUITE 247','ADDISON',43,'75001','8888719660','mike@allamericanbrokers.com', $ts, $ts],
                ['140939','JASON','SMITH',"HEARTLAND INSURANCE SOLUTIONS",'PO BOX 850095','YUKON',36,'73085','4053230235','jasonsmith1021@gmail.com', $ts, $ts],
                ['140947','ALICIA','TRANUM',"BEYOND BENEFITS",'4130 FORT HENRY DRIVE','KINGSPORT',42,'37663','4232390015','benefitsx@netzero.net', $ts, $ts],
                ['140952','BRENDA','ROSE',"ALL ABOARD BENEFITS",'6162 E MOCKINGBIRD LN','DALLAS',43,'75214','8004622322','b.rose@allaboardbenefits.com', $ts, $ts],
                ['140954','STEVEN','WENDLANDT',"",'3000 WESLAYAN, SUITE 318','HOUSTON',43,'77027','7136211440','stevew@selectedbenefits.com', $ts, $ts],
                ['140955','BOBBY','YOUNG',"ALL ABOARD BENEFITS",'6504 WICKLIFF TRL','PLANO',43,'75023','2148216677','bobby@allaboardbenefits.net', $ts, $ts],
                ['140972','TODD','MADRID',"",'8105 RANCHO DE LA OSA TR.','MCKINNEY',43,'75070','9727627570','toddmcic@gmail.com', $ts, $ts],
                ['140975','DAVID','HOPKINS JR',"INSURANCE CONSULTANTS GROUP  LLC",'4361 BLOSSOM HILL RD','MORTON',24,'39117','8888280905','jdhopkins@webicg.com', $ts, $ts],
                ['140987','MARK','HARRIS',"",'2715 16TH STREET','GREAT BEND',16,'67530','6207924560','markdharris@cox.net', $ts, $ts],
                ['140989','KEVIN','REESE',"BACH INSURANCE GROUP",'202 W. LOUISIANA STREET #208','MCKINNEY',43,'75069','2148564761','bachinsgroup@bachig.com', $ts, $ts],
                ['141000','KEVIN','REESE',"BACH INSURANCE GROUP",'506 COLORADO ST.','SHERMAN',43,'75090','2148564761','kreese@bachig.com', $ts, $ts],
                ['141002','SUZI','MCALPINE',"",'8033 KRISTINA LN.','NORTH RICHLAND HILLS',43,'76182','8175018732','baseballmoma@sbcglobal.net', $ts, $ts],
                ['141003','GEORGE','MITCHELL',"MITCHELL'S FAMILY INSURANCE",'3056 E. JEROME','MESA',3,'85204','4806649227','pooli777@cox.net', $ts, $ts],
                ['141011','ROBERT','JABOUR II',"",'5068 WEST PLANO PKWY, STE 300','PLANO',43,'75093','9723814232','bob@texashealthnow.com', $ts, $ts],
                ['141060','MICHAEL','BROWNE',"ALTERNET BENEFITS",'4450 ARAPAHOE AVENUE','BOULDER',6,'80303','3036799600','mike@alternetbenefits.com', $ts, $ts],
                ['141072','GRACE','TORNIK',"",'6300 CARRIZO DR.','GRANBURY',43,'76049','8172191901','gracetornik@yahoo.com', $ts, $ts],
                ['141084','THOMAS ','ROTOLE',"ROTOLE & ASSOCIATES, INC. ",'1935 SW ANDREW RD.','TOWANDA',16,'67144','3165412770','tvrassoc@outlook.com', $ts, $ts],
                ['141093','REED','HITCH',"",'3223 S LOOP 289 #240C','LUBBOCK',43,'79423','8067501210','reedhitch@msn.com', $ts, $ts],
                ['141165','CHRISTOPHER','FORD',"FORD INS. SERVICES",'PO BOX 30282','MIDWEST CITY',36,'73140','4052458253','chris.ford1@cox.net', $ts, $ts],
                ['141182','RICHARD','HAMILTON',"HAMILTON GROUP",'2212 MULBERRY LANE','NEWCASTLE',36,'73065','4053141763','rick.health@yahoo.com', $ts, $ts],
                ['141253','STEVE','HERMAN',"",'6142 BRANDEIS LN','DALLAS',43,'75214','2143638771','steveherman68@sbcglobal.net', $ts, $ts],
                ['141295','PHIL','RASKIN',"AO INSURANCE AGENCY INC",'7066 LAKEVIEW HAVEN DR STE108','HOUSTON',43,'77095','2813450805','lisa.aoinsagency@gmail.com', $ts, $ts],
                ['141326','PHIL','RASKIN',"ISURE,LLC",'7066 LAKEVIEW HAVEN DR, #108','HOUSTON',43,'77095','2813450805','lisamcconville2013@gmail.com', $ts, $ts],
                ['141328','WILEY','LONG',"WILEY LONG ENTERPRISES, INC.",'1001-A E. HARMONY RD #519','FORT COLLINS',6,'80525','8667492039','info@hsaforamerica.com', $ts, $ts],
                ['141335','CHARLES','HARRELL',"CHARLES HARRELL",'5920 E. UNIVERSITY BLVD #4116','DALLAS',43,'75206','8004622322','c.harrell@allaboardbenefits.net', $ts, $ts],
                ['141340','RON','CUNNINGHAM',"",'980998 S 3390 RD','MEEKER',36,'74855','4058315270','cunninghamrons@yahoo.com', $ts, $ts],
                ['141369','J','MARSTON',"",'16801 ADDISON ROAD, SUITE 247','ADDISON',43,'75001','8008801276','jmarston4@gmail.com', $ts, $ts],
                ['141370','DAVID','CROCKETT',"",'16775 ADDISON RD.','ADDISON',43,'75001','8665909771','dcrockett@aisbenefits.com', $ts, $ts],
                ['141377','VEL','ROE',"",'3118 SO. CO. RD. 1069','MIDLAND',43,'79706','4322386677','arvella1952@yahoo.com', $ts, $ts],
                ['141382','RICHARD','MAYER',"",'3704 WINDSTONE DR','PLANO',43,'75023','9726187270','richmayer@richardmayerinsurance.com', $ts, $ts],
                ['141386','ROBB','ROTHROCK',"",'1750 N COLLINS BLVD. SUITE 110','RICHARDSON',43,'75080','2144142857','robb@consumershieldagency.com', $ts, $ts],
                ['141391','MICHAEL','MARTIN',"MDM INSURANCE SOLUTIONS",'7001 W PARKER RD. #422','PLANO',43,'75093','9407351515','mike@mdmins.com', $ts, $ts],
                ['141418','MICHAEL','COLE',"",'1025 SOUTHVIEW TR','SOUTHLAKE',43,'76092','8172964560','mcole@exchangeplus.com', $ts, $ts],
                ['141420','GREG','MYERS',"TEXAS MEDICAL PLANS LLC",'PO BOX 1270','WIMBERLEY',43,'78676','8887503164','tracey@health-quotes.com', $ts, $ts],
                ['141483','RYAN','HOWELL',"",'10 HOLMSBY LN','TAYLORS',40,'29687','8649791006','protectiveplanning@hotmail.com', $ts, $ts],
                ['141549','VERN','JUEL',"",'122 PALOMINO CT.','DENTON',43,'76208','9402390598','vjuel@charter.net', $ts, $ts],
                ['141553','TARYN','COLLINS',"STREAMLINE BENEFITS GROUP",'5443 FOX RUN BLVD','FREDERICK',6,'80504','7206758350','taryn@streamlinebg.com', $ts, $ts],
                ['141559','ROBIN','CRUSON',"ROBIN G CRUSON dba Cruson Insurance Agency",'8105 RASOR BLVD','PLANO',43,'75024','9728963851','robin@crusoninsurance.com', $ts, $ts],
                ['141571','HARRY','CAIN III',"HPCAIN CONSULTING, LLC",'3673 FORTINGALE ROAD','ATLANTA',10,'30341','4049139472','hpcain@gmail.com', $ts, $ts],
                ['141610','BRETT','MARTIN',"",'1033 B AVENUE, SUITE 101-125','CORONADO',5,'92118','6194899368','faststartinsurance@gmail.com', $ts, $ts],
                ['141612','JAMES','RIPPEL',"RIPPEL & ASSOCIATES",'8955 BEAR CREEK','SYLVANIA',35,'43560','4193182323','jim@chsmkting.com', $ts, $ts],
                ['141756','DAVID','RUBEY',"",'978 CASSION DR.','LEWISVILLE',43,'75067','9727575337','David@DMRInsuranceServices.com  ', $ts, $ts],
                ['141768','REGINALD','JACKSON',"RJ INSURANCE SERVICES",'10202 ANGELL STREET','DOWNEY',5,'90242','8773601144','reggiej@rjinsures.com', $ts, $ts],
                ['141804','DAVID','MAY',"",'1875 50TH AVE','PAWNEE ROCK',16,'67567','6208040736','david@esick.org', $ts, $ts],
                ['141807','DAVID','CROCKETT',"AGILITY INSURANCE SERVICES",'16775 ADDISON ROAD','ADDISON',43,'75001','8008801276','dcrockett+1@aisbenefits.com', $ts, $ts],
                ['141820','DANIEL','MOEN',"",'5400 CLARK AVE #107','LAKEWOOD',5,'90712','5624728177','danielsinbox@yahoo.com', $ts, $ts],
                ['141862','CHARLES','FRAZIER',"ALLIED INSURANCE ADVISORS, LLC",'3461 - F LAWRENCEVILLE-SUWANEE RD','SUWANEE',10,'30024','6785467890','charles@alliedinsadv.com', $ts, $ts],
                ['141872','MIKE','BROWNE',"ALTERNET BENEFITS",'16801 ADDISON RD., SUITE 247','ADDISON',43,'75001','8446400400','info@nacdbenefits.com', $ts, $ts],
                ['141875','TODD','MADRID',"",'8105 RANCHO DE LA OSA TRAIL','MCKINNEY',43,'75070','9727627570','tmadrid45@gmail.com', $ts, $ts],
                ['141896','CHARITY','BLISS',"CHARITY BLISS INC",'941 NE 19TH AVE','FORT LAUDERDALE',9,'33304','3214325805','charityblissinc@gmail.com', $ts, $ts],
                ['141908','SEAN','COLLINS',"",'1130 CHARLESTON STREET','COSTA MESA',5,'92626','9494224003','collins4s@sbcglobal.net', $ts, $ts],
                ['141916','SCOTT','ECKLEY',"APOLLO INSURANCE GROUP, INC",'200 NE MISSOURI RD #200','LEES SUMMIT',26,'64086','9132790077','seckley@apollo-insurance.com', $ts, $ts],
                ['141924','TOM','ALBERS',"",'3021 YELLOWSTONE DR','LAWRENCE',16,'66047','7855504922','tom.healthcaresolutions@gmail.com', $ts, $ts],
                ['146067','Teresa','Edmonson',"Guidry Group",'550 Club Drive suite 330','Montgomery',43,'77316','9365825800','svbkkp@consolidated.net', $ts, $ts],
                ['146069','Robb ','Rothrock',"American Health Benefits",'908 Audelia Rd # 200-257','Richardson',43,'75081','2144142857','robb@saferetirements.com', $ts, $ts],
                ['146073','Alexander','Groth',"Fusion Box",'2031 Curtis St','Denver',6,'80205','3039527490','agroth@fusionbox.com', $ts, $ts],
                ['146074','JOHN','U-RON',"JJ CRUISERS BAR",'715 Horizon Dr','Grand Junction',6,'81506','9703142554','cruisersbar@yahoo.com', $ts, $ts],
                ['146075','Nichole','Kirkpatrick',"Central City Opera House Assoc Inc.",'400 S. Colorado Blvd. Suite 530','Denver',6,'80246','3032926500','nkirkpatrick@centralcityopera.org', $ts, $ts],
                ['146078','Robert','Duncan',"Midwest Propeller Service",'15650 S Lone Elm Road','Olathe',16,'66061','','bob@midwestpropeller.com', $ts, $ts],
                ['157980','Jerimaya','Grabner',"Global Positioning Service",'1560 6th St Ste 100','Santa Monica',5,'90401','3106561350','jg@globalpositioningservices.net', $ts, $ts],
                ['158000','KELLY','NABB',"5 Star Auto Sales",'712 Atlanta Hwy','Gainesville',10,'30501','7705348020','kelnabb@live.com', $ts, $ts],
                ['158057','Stephanie','Courseau',"Dybou LLC",'4514 Travis St  Suite 124','Dallas',43,'75205','4697302937','lebilboquetdallas@gmail.com', $ts, $ts],
                ['186236','Robert','Norris',"CertaPro Painters",'2525 NW Expressway Ste 209','Oklahoma City',36,'73112','4059908521','norris@certapro.com', $ts, $ts],
                ['186237','Irene','Little',"Access Counseling Group, Inc.",'2600 K Ave Ste 102','Plano',43,'75074','9724238727','irene@accesscounselinggroup.com', $ts, $ts],
                ['186292','Michael','Cole',"National Combined Benefits Association",'307 N Glenwood Blvd','Tyler',43,'75702','','michael.cole@evexias.com', $ts, $ts],
                ['186295','Tara','Crowley',"Arrow Oil & Gas",'PO Box 722588','Norman',36,'73070','4053642601','Tara.Crowley@gibsons.com', $ts, $ts],
                ['186401','Angela','Jost',"Jost Fabrication",'800 Western Heights Cir','Hillsboro',16,'67063','','office@jostfabricating.com', $ts, $ts],
                ['194697','Tracey','White',"Texas Medical Plans",'PO Box 1270','Wimberley',43,'78676','8887503164','tracey@health-quotes.com', $ts, $ts],
                ['260975','Russell','Miller',"Russ Miller Insurance Group",'14052 Wrangler Way','Haslet',43,'76052','8174001084','russ@russmillerinsurancegroup.com', $ts, $ts],
                ['264303','Test','Agent',"Test Agent",'1 Blue','DECATUR',43,'76234','6201230069','a@a.com', $ts, $ts],
                ['264885','Angela','Hamnes',"Procurement Solutions of Texas",'3917 Mulberry Lane','Bedford',43,'76021','8179174571','angela@ats-dfw.com', $ts, $ts],
            ]
        );





        $this->batchInsert('agent_state_map',
            ['agent_id', 'state_id', 'created_at', 'updated_at'],
            [
//                [1, 1, $ts, $ts],
                [57,14, $ts, $ts],
                [57,22, $ts, $ts],
                [57,31, $ts, $ts],
                [57,40, $ts, $ts],
                [57,43, $ts, $ts],
                [57,9, $ts, $ts],
                [57,16, $ts, $ts],
                [57,20, $ts, $ts],
                [57,28, $ts, $ts],

                [13,43, $ts, $ts],
                [13,9, $ts, $ts],

                [27,1, $ts, $ts],
                [27,4, $ts, $ts],
                [27,10, $ts, $ts],
                [27,15, $ts, $ts],
                [27,36, $ts, $ts],
                [27,40, $ts, $ts],
                [27,42, $ts, $ts],
                [27,43, $ts, $ts],
                [27,16, $ts, $ts],

                [30,43, $ts, $ts],

                [60,1, $ts, $ts],
                [60,3, $ts, $ts],
                [60,5, $ts, $ts],
                [60,10, $ts, $ts],
                [60,15, $ts, $ts],
                [60,18, $ts, $ts],
                [60,26, $ts, $ts],
                [60,33, $ts, $ts],
                [60,27, $ts, $ts],
                [60,35, $ts, $ts],
                [60,36, $ts, $ts],
                [60,38, $ts, $ts],
                [60,40, $ts, $ts],
                [60,42, $ts, $ts],
                [60,43, $ts, $ts],
                [60,9, $ts, $ts],
                [60,13, $ts, $ts],
                [60,16, $ts, $ts],

                [17,3, $ts, $ts],
                [17,6, $ts, $ts],
                [17,25, $ts, $ts],
                [17,27, $ts, $ts],
                [17,31, $ts, $ts],
                [17,36, $ts, $ts],
                [17,43, $ts, $ts],
                [17,46, $ts, $ts],
                [17,16, $ts, $ts],

                [26,31, $ts, $ts],
                [26,36, $ts, $ts],
                [26,43, $ts, $ts],

                [31,43, $ts, $ts],

                [42,43, $ts, $ts],

                [51,5, $ts, $ts],
                [51,22, $ts, $ts],
                [51,33, $ts, $ts],
                [51,31, $ts, $ts],
                [51,35, $ts, $ts],
                [51,40, $ts, $ts],
                [51,43, $ts, $ts],

            ]
        );


        $this->batchInsert('provider_agent_map',
            ['agent_id', 'provider_id', 'created_at', 'updated_at'],
            [
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
                [31, 9, $ts, $ts], [31, 10, $ts, $ts], [31, 11, $ts, $ts],
                [32, 9, $ts, $ts], [32, 10, $ts, $ts], [32, 11, $ts, $ts],
                [33, 9, $ts, $ts], [33, 10, $ts, $ts], [33, 11, $ts, $ts],
                [34, 9, $ts, $ts], [34, 10, $ts, $ts], [34, 11, $ts, $ts],
                [35, 9, $ts, $ts], [35, 10, $ts, $ts], [35, 11, $ts, $ts],
                [36, 9, $ts, $ts], [36, 10, $ts, $ts], [36, 11, $ts, $ts],
                [37, 9, $ts, $ts], [37, 10, $ts, $ts], [37, 11, $ts, $ts],
                [38, 9, $ts, $ts], [38, 10, $ts, $ts], [38, 11, $ts, $ts],
                [39, 9, $ts, $ts], [39, 10, $ts, $ts], [39, 11, $ts, $ts],
                [40, 9, $ts, $ts], [40, 10, $ts, $ts], [40, 11, $ts, $ts],
                [41, 9, $ts, $ts], [41, 10, $ts, $ts], [41, 11, $ts, $ts],
                [42, 9, $ts, $ts], [42, 10, $ts, $ts], [42, 11, $ts, $ts],
                [43, 9, $ts, $ts], [43, 10, $ts, $ts], [43, 11, $ts, $ts],
                [44, 9, $ts, $ts], [44, 10, $ts, $ts], [44, 11, $ts, $ts],
                [45, 9, $ts, $ts], [45, 10, $ts, $ts], [45, 11, $ts, $ts],
                [46, 9, $ts, $ts], [46, 10, $ts, $ts], [46, 11, $ts, $ts],
                [47, 9, $ts, $ts], [47, 10, $ts, $ts], [47, 11, $ts, $ts],
                [48, 9, $ts, $ts], [48, 10, $ts, $ts], [48, 11, $ts, $ts],
                [49, 9, $ts, $ts], [49, 10, $ts, $ts], [49, 11, $ts, $ts],
                [50, 9, $ts, $ts], [50, 10, $ts, $ts], [50, 11, $ts, $ts],
                [51, 9, $ts, $ts], [51, 10, $ts, $ts], [51, 11, $ts, $ts],
                [52, 9, $ts, $ts], [52, 10, $ts, $ts], [52, 11, $ts, $ts],
                [53, 9, $ts, $ts], [53, 10, $ts, $ts], [53, 11, $ts, $ts],
                [54, 9, $ts, $ts], [54, 10, $ts, $ts], [54, 11, $ts, $ts],
                [55, 9, $ts, $ts], [55, 10, $ts, $ts], [55, 11, $ts, $ts],
                [56, 9, $ts, $ts], [56, 10, $ts, $ts], [56, 11, $ts, $ts],
                [57, 9, $ts, $ts], [57, 10, $ts, $ts], [57, 11, $ts, $ts],
                [58, 9, $ts, $ts], [58, 10, $ts, $ts], [58, 11, $ts, $ts],
                [59, 9, $ts, $ts], [59, 10, $ts, $ts], [59, 11, $ts, $ts],
                [60, 9, $ts, $ts], [60, 10, $ts, $ts], [60, 11, $ts, $ts],
                [61, 9, $ts, $ts], [61, 10, $ts, $ts], [61, 11, $ts, $ts],
                [62, 9, $ts, $ts], [62, 10, $ts, $ts], [62, 11, $ts, $ts],
                [63, 9, $ts, $ts], [63, 10, $ts, $ts], [63, 11, $ts, $ts],
                [64, 9, $ts, $ts], [64, 10, $ts, $ts], [64, 11, $ts, $ts],
                [65, 9, $ts, $ts], [65, 10, $ts, $ts], [65, 11, $ts, $ts],
                [66, 9, $ts, $ts], [66, 10, $ts, $ts], [66, 11, $ts, $ts],
                [67, 9, $ts, $ts], [67, 10, $ts, $ts], [67, 11, $ts, $ts],
                [68, 9, $ts, $ts], [68, 10, $ts, $ts], [68, 11, $ts, $ts],
                [69, 9, $ts, $ts], [69, 10, $ts, $ts], [69, 11, $ts, $ts],
                [70, 9, $ts, $ts], [70, 10, $ts, $ts], [70, 11, $ts, $ts],
                [71, 9, $ts, $ts], [71, 10, $ts, $ts], [71, 11, $ts, $ts],
                [72, 9, $ts, $ts], [72, 10, $ts, $ts], [72, 11, $ts, $ts],
                [73, 9, $ts, $ts], [73, 10, $ts, $ts], [73, 11, $ts, $ts],
                [74, 9, $ts, $ts], [74, 10, $ts, $ts], [74, 11, $ts, $ts],
                [75, 9, $ts, $ts], [75, 10, $ts, $ts], [75, 11, $ts, $ts],
                [76, 9, $ts, $ts], [76, 10, $ts, $ts], [76, 11, $ts, $ts],
                [77, 9, $ts, $ts], [77, 10, $ts, $ts], [77, 11, $ts, $ts],
                [78, 9, $ts, $ts], [78, 10, $ts, $ts], [78, 11, $ts, $ts],
                [79, 9, $ts, $ts], [79, 10, $ts, $ts], [79, 11, $ts, $ts],
            ]
        );
    }

    public function down()
    {
        echo "m170614_174107_users cannot be reverted.\n";

        return false;
    }

}
