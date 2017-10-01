<?php

use yii\db\Migration;

class m170824_152201_live_data extends Migration
{
    public function safeUp()
    {
        $ts = time();

//        $this->batchInsert('user',
//            [/*"id",*/"username","auth_key","password_hash","password_reset_token","email","admin","has_member","has_agent","has_provider","status", "created_at","updated_at"],
//            [
//                [/*37,    */"mikem",        "StcjN9CsZgZ6Een-hjGjo9cC5GGl7zjW", '$2y$13$aCwNfsOTYdVpNRrVJP4xtusF/t6xetquRTqnSgEnqMF.bUO/GKNoi', Yii::$app->security->generateRandomString() . '_' .$ts, "mikem@mnetwork.org",                   false,    true, false,    false,    10,     1503507795,   1503507795],
//                [/*38,    */"test",         "2Hk4eIKH95Rn_atDquM6nBjCTMEmVATh", '$2y$13$aebr5eTQnNEiwbcpe/vKz.D.lb0NOSrvjv6eh5tmeeJTfo/SmMCBu', null, "test@kristest.com",                    false,    true, false,    false,    10,     1503513663,   1503513663],
//                [/*39,    */"mrsgp101310",  "f6KVc5vP2biirtQGRWGg7MoiNYkcdDmM", '$2y$13$FZ6oQgXKfoWazPLJYZL0Veyxw1fiz1juxDOvTD5DmBXJzMVWcWFRS', null, "mrsgp101310@gmail.com",                false,    true, false,    false,    10,     1503514089,   1503514089],
//            ]
//        );

        $this->batchInsert('member',
            [/*"id",*/"user_id","agent_id","group_id","ext_id","init_user_hash","f_name","l_name","m_name","dob","gender","ssn","address","address2","city","state_id","zip","email","phone","status","created_at","updated_at","sync_at"],
            [
                [/*6,*/37,1,null,672306591,null,'Michael','Menefee','C','1901-01-01','M','123123123','123 Test St',null,'Test',43,'12345','mikem@mnetwork.org','1231231234',10,1503507795,1503507795,1505419846],
                [/*7,*/34,1,null,672306592,null,'Russell','Miller','Dean','1967-12-05','M','331566324','14052 Wrangler Way',null,'Haslet',43,'76052','russ@russmillerinsurancegroup.com','8179957854',10,1503508867,1503508867,1505419846],
                [/*8,*/38,1,null,672306593,null,'Kris','Naladi',null,'1969-04-12','M','342312312','test123 testse',null,'testcity',42,'34253','test@kristest.com','3123123121',10,1503513663,1503513663,1505419846],
                [/*9,*/39,1,null,672306594,null,'Cyndi','Pierson',null,'1966-07-31','F','463515489','1402 Parker Rd',null,'St Paul',43,'75098','mrsgp101310@gmail.com','9723380058',10,1503514089,1503514089,1505419846],
                [/*10,*/null,21,null,672306595,'FNVkthE5f-TV1JgcND7GArQxX-RHKv4S','Damian','Sanchez','A','1999-01-19','M','633664923','Room 317  Talkington  Texas Tech University',null,'Lubbock',43,'79406','damian.sanchez@ttu.edu','8306370145',10,1504739406,1504739406,1505419846],
                [/*11,*/null,21,null,672335746,'ATR6mSOpW0-lxjtauN7GL_mxOKH2IvAf','Felicia','Davis','A','1966-03-25','F','435490588','115 Birchwood Dr',null,'Monroe',18,'91203','feleciadavis006@gmail.com','9797937186',10,1506012334,1506602499,1506602503],
                [/*12,*/null,17,null,672335747,'6viYxnWwkMNQ_YufVF00Z5CFJ6O9KH_I','Scott','Temple',null,'1973-09-06','M','244639241','108 Turner Forrest Ln',null,'Simpsonville',40,'29681','5temples@templar-inc.com','9192910813',10,1506097999,1506602500,1506602503],
                [/*13,*/null,17,null,672335748,'2hP79enFuGxqiY8rG8hnzQe5GUtI5nuh','Jerry','Cox','Dean','1961-07-21','M','247254658','11 Farringdon Dr',null,'greenville',40,'29615','coxgrp1234@aol.com','8644491947',10,1506357752,1506602501,1506602503],
                [/*14,*/null,17,null,672335749,'QSh-4KZU5herzugbyL938AyjJzi1E11E','Brian','Cox',null,'1986-05-10','M','247654370','407 Two Gait Ln',null,'Simpsonville',40,'29680','chestnut.oaks@yahoo.com','8644491945',10,1506359239,1506602502,1506602503],
                [/*15,*/null,17,null,672335750,'-jw06j_5VEpyZO5ud6gWWHQqeolyZtTY','Michael','Haynes','L','1980-05-25','M','21708708','6217 Eagle Claw Ct',null,'Mint Hill',33,'28227','theresa.haynes@cbcarolinas.com','7042992057',10,1506457232,1506602503,1506602503],
                [/*16,*/null,28,null,672379506,'4Q2mZ_-6XgScWBmWgG7zodvyxEHdHQ--','Marti','Shelton','A','1960-02-28','M','459337390','POP Box560446',null,'The Colony',43,'75056','mshelton@rewardamerica.com','8172911461',10,1506640556,1506885590,1506885590],
            ]
        );

        $this->batchInsert('payment_method',
            [/*"id",*/"member_id","name","pay_type","f_name","l_name","routing","account","account_type","exp","pan","cvv","status","created_at","updated_at","sync_at"],
            [
                [/*6,*/6,'Primary',1,'INNOVATIVE','BENEFIT SOLUTIONS','111901014','4670198051',1,null,null,null,50,1503507795,1503507795,1505419846],
                [/*7,*/7,'Primary',1,'INNOVATIVE','BENEFIT SOLUTIONS','111901014','4670198051',1,null,null,null,50,1503508867,1503508867,1505419846],
                [/*8,*/8,'Primary',2,'INNOVATIVE','BENEFIT SOLUTIONS','111901014','4670198051',1,null,null,null,50,1503513663,1503513663,1505419846],
                [/*9,*/9,'Primary',1,'INNOVATIVE','BENEFIT SOLUTIONS','111901014','4670198051',1,null,null,null,50,1503514089,1503514089,1505419846],
                [/*10,*/10,null,1,'Damian','Sanchez','111900659','1636873935',1,null,null,null,50,1504739406,1504739406,1505419846],
                [/*11,*/11,null,1,'Felicia','Davis','111193550','344162',1,null,null,null,50,1506012334,1506012334,1506602503],
                [/*12,*/12,null,1,'Templar','Investments LLC','53100300','3842020814',1,null,null,null,50,1506097999,1506097999,1506602503],
                [/*13,*/13,null,1,'The','Loom LLC','53200983','60075340',1,null,null,null,50,1506357752,1506357752,1506602503],
                [/*14,*/14,null,1,'The','Loom LLC','53200983','60075340',1,null,null,null,50,1506359239,1506359239,1506602503],
                [/*15,*/15,null,1,'Michael','Haynes','253177049','8615709581',1,null,null,null,50,1506457232,1506457232,1506602503],
                [/*16,*/16,null,2,'Marti','Shelton',null,null,null,'43221','5480133100119410','846',50,1506640556,1506640556,1506885590],
            ]
        );

        $this->batchInsert('purchase',
            [/*"id",*/"member_id","payment_id","type","product_option_id","membership_id","purchase_date","active_date","recurring_bill_day","initial_bill_day","status","created_at","updated_at","sync_at"],
            [
                [/*11,*/6,6,1,null,4,1504656000,1504915200,15,15,10,1504739406,1504739406,1505419846],
                [/*12,*/7,7,1,null,4,1504656000,1504915200,15,15,10,1504739406,1504739406,1505419846],
                [/*13,*/8,8,1,null,4,1504656000,1504915200,15,15,10,1504739406,1504739406,1505419846],
                [/*14,*/9,9,1,null,4,1504656000,1504915200,15,15,10,1504739406,1504739406,1505419846],
                [/*15,*/10,10,1,null,1,1504656000,1504915200,15,15,10,1504739406,1504739406,1505419846],
                [/*16,*/10,10,2,14,null,1504656000,1504915200,15,15,10,1504739406,1504739406,1505337760],
                [/*17,*/11,11,1,null,1,1505952000,1506211200,25,25,10,1506012334,1506012334,1506602503],
                [/*18,*/12,12,1,null,1,1506038400,1506297600,5,5,10,1506097999,1506097999,1506602503],
                [/*19,*/13,13,1,null,1,1506297600,1506556800,5,5,10,1506357752,1506357752,1506602503],
                [/*20,*/14,14,1,null,1,1506297600,1506556800,5,5,10,1506359239,1506359239,1506602503],
                [/*21,*/15,15,1,null,1,1506384000,1506643200,5,5,10,1506457232,1506457232,1506602503],
                [/*22,*/9,9,2,19,null,1506556800,1506816000,15,5,10,1506636398,1506636398,1506639456],
                [/*23,*/16,16,1,null,4,1506556800,1506816000,5,5,10,1506640556,1506640556,1506885590],
            ]
        );
    }

    public function safeDown()
    {
        echo "m170824_152201_live_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170824_152201_live_data cannot be reverted.\n";

        return false;
    }
    */
}
