<?php

use yii\db\Migration;

class m170824_152201_live_data extends Migration
{
    public function safeUp()
    {
        $ts = time();

        $this->batchInsert('user',
            [/*"id",*/"username","auth_key","password_hash","password_reset_token","email","admin","has_member","has_agent","has_provider","status", "created_at","updated_at"],
            [
                [/*37,    */"mikem",        "StcjN9CsZgZ6Een-hjGjo9cC5GGl7zjW", '$2y$13$aCwNfsOTYdVpNRrVJP4xtusF/t6xetquRTqnSgEnqMF.bUO/GKNoi', Yii::$app->security->generateRandomString() . '_' .$ts, "mikem@mnetwork.org",                   false,    true, false,    false,    10,     1503507795,   1503507795],
                [/*38,    */"test",         "2Hk4eIKH95Rn_atDquM6nBjCTMEmVATh", '$2y$13$aebr5eTQnNEiwbcpe/vKz.D.lb0NOSrvjv6eh5tmeeJTfo/SmMCBu', null, "test@kristest.com",                    false,    true, false,    false,    10,     1503513663,   1503513663],
                [/*39,    */"mrsgp101310",  "f6KVc5vP2biirtQGRWGg7MoiNYkcdDmM", '$2y$13$FZ6oQgXKfoWazPLJYZL0Veyxw1fiz1juxDOvTD5DmBXJzMVWcWFRS', null, "mrsgp101310@gmail.com",                false,    true, false,    false,    10,     1503514089,   1503514089],
            ]
        );

        $this->batchInsert('member',
            [/*"id",*/"user_id","agent_id","group_id","ext_id","f_name","l_name","m_name","dob","gender","ssn","address","address2","city","state_id","zip","email","phone","status","created_at","updated_at","sync_at"],
            [
                [/*6,*/  37,     1,  null, 672306591,   "Michael",  "Menefee",  "C",     "1901-01-01", "M",    "123123123", "123 Test St",                                  null,   "Test",     43,   "12345",  "mikem@mnetwork.org",                   "1231231234",   10, 1503507795, 1503507795, 1505419846],
                [/*7,*/  34,     1,  null, 672306592,   "Russell",  "Miller",   "Dean",  "1967-12-05", "M",    "331566324", "14052 Wrangler Way",                           null,   "Haslet",   43,   "76052",  "russ@russmillerinsurancegroup.com",    "8179957854",   10, 1503508867, 1503508867, 1505419846],
                [/*8,*/  38,     1,  null, 672306593,   "Kris",     "Naladi",   null,    "1969-04-12", "M",    "342312312", "test123 testse",                               null,   "testcity", 42,   "34253",  "test@kristest.com",                    "3123123121",   10, 1503513663, 1503513663, 1505419846],
                [/*9,*/  39,     1,  null, 672306594,   "Cyndi",    "Pierson",  null,    "1966-07-31", "F",    "463515489", "1402 Parker Rd",                               null,   "St Paul",  43,   "75098",  "mrsgp101310@gmail.com",                "9723380058",   10, 1503514089, 1503514089, 1505419846],
                [/*10*/null,    21,  null, 672306595,   "Damian",   "Sanchez",  "A",     "1999-01-19", "M",    "633664923", "Room 317  Talkington  Texas Tech University",  null,   "Lubbock",  43,   "79406",  "damian.sanchez@ttu.edu",               "8306370145",   10, 1504739406, 1504739406, 1505419846],

            ]
        );

        $this->batchInsert('payment_method',
            [/*"id",*/"member_id","name","pay_type","f_name","l_name","routing","account","account_type","exp","pan","cvv","status","created_at","updated_at","sync_at"],
            [
                [/*6,*/ 6,  "Primary",  1,  "INNOVATIVE",   "BENEFIT SOLUTIONS",    "111901014", "4670198051",   1,       null,       null,               null,     50,   1503507795, 1503507795, 1505419846],
                [/*7,*/ 7,  "Primary",  1,  "INNOVATIVE",   "BENEFIT SOLUTIONS",    "111901014", "4670198051",   1,       null,       null,               null,     50,   1503508867, 1503508867, 1505419846],
                [/*8,*/ 8,  "Primary",  2,  "INNOVATIVE",   "BENEFIT SOLUTIONS",    "111901014", "4670198051",   1,       null,       null,               null,     50,   1503513663, 1503513663, 1505419846],
                [/*9,*/ 9,  "Primary",  1,  "INNOVATIVE",   "BENEFIT SOLUTIONS",    "111901014", "4670198051",   1,       null,       null,               null,     50,   1503514089, 1503514089, 1505419846],
                [/*10*/10,  null,       1,  "Damian",       "Sanchez",              "111900659", "1636873935",   1,       null,       null,               null,     50,   1504739406, 1504739406, 1505419846],
            ]
        );

        $this->batchInsert('purchase',
            [/*"id",*/"member_id","payment_id","type","product_option_id","membership_id","purchase_date","active_date","recurring_bill_day","initial_bill_day","status","created_at","updated_at","sync_at"],
            [
                [/*11,*/    6,  6, 1,  null,       4,  1504656000, 1504915200,  15,  15,  10, 1504739406, 1504739406, 1505419846],
                [/*12,*/    7,  7, 1,  null,       4,  1504656000, 1504915200,  15,  15,  10, 1504739406, 1504739406, 1505419846],
                [/*13,*/    8,  8, 1,  null,       4,  1504656000, 1504915200,  15,  15,  10, 1504739406, 1504739406, 1505419846],
                [/*14,*/    9,  9, 1,  null,       4,  1504656000, 1504915200,  15,  15,  10, 1504739406, 1504739406, 1505419846],
                [/*15,*/   10, 10, 1,  null,       1,  1504656000, 1504915200,  15,  15,  10, 1504739406, 1504739406, 1505419846],
                [/*16,*/   10, 10, 2,    14,    null,  1504656000, 1504915200,  15,  15,  10, 1504739406, 1504739406, 1505337760],

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
