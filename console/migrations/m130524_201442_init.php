<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sync_log}}', [
            'id' => $this->primaryKey(),
            'instance' => $this->string(),
            'sync_type' => $this->integer()->notNull(),
            'sync_begin' => $this->integer()->notNull(),
            'sync_complete' => $this->integer()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'admin' => $this->boolean()->notNull()->defaultValue(false)->comment('Admin Login Permission'),

            'has_member' => $this->boolean()->defaultValue(false)->comment('Membership Flag'),
            'has_agent'  => $this->boolean()->defaultValue(false)->comment('Agent Flag'),
            'has_provider' => $this->boolean()->defaultValue(false)->comment('Provider Flag'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

//        $this->createTable('{{%page}}', [
//            'id' => $this->primaryKey(),
//            'title' => $this->string()->notNull(),
//            'content' => $this->text(),
//            'html' => $this->text(),
//
//            'status' => $this->smallInteger()->notNull()->defaultValue(10),
//            'created_at' => $this->integer()->notNull(),
//            'updated_at' => $this->integer()->notNull(),
//        ], $tableOptions);

        $this->createTable('{{%membership}}',[
            'id' => $this->primaryKey(),
            'ext_id' => $this->integer()->comment('E123 Product ID'),
            'name' => $this->string()->notNull(),
            'long_name' => $this->string()->comment('Extended Name'),
            'level' => $this->integer()->notNull()->comment('Membership Level'),

            'img' => $this->string()->comment('Image Filename'),
            'price' => $this->integer()->comment('Price'), //number of cents

            'description' => $this->text(),
            'detail' => $this->text(),

            'legal_url' => $this->string()->comment('Legal URL'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%membership_benefit}}',[
            'id' => $this->primaryKey(),
            'provider_id' => $this->integer()->notNull()->comment('Benefit Provider'),
            'name' => $this->string()->notNull()->comment('Benefit Name'),
            'long_name' => $this->string()->notNull()->comment('Benefit Extended Name'),
            'icon' => $this->string()->notNull()->comment('Icon File Name'),

            'page_order' => $this->integer()->comment('Page List Order'),

            'benefit_mem_id' => $this->boolean()->defaultValue(true)->comment('Display Member ID'),
            'group_data' => $this->string()->comment('Provider Group Number'),
            'other_ref' => $this->string()->comment('Provider Secondary Reference'),

            'url' => $this->string()->comment('Benefit Access URL'),
            'email' => $this->string()->comment('Benefit Provider Email'),
            'phone' => $this->string()->comment('Benefit Provider Phone'),
            'description' => $this->text()->comment('Benefit Description'),
            'detail' => $this->text()->comment('Benefit Details'),

            'features' => $this->text(),
            'features2' => $this->text(),

            'legal_url' => $this->string()->comment('Legal Info URL'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%membership_benefit_map}}', [
            'id' => $this->primaryKey()->comment('ID'),
            'membership_id' => $this->integer()->notNull()->comment('Membership'),
            'benefit_id' => $this->integer()->notNull()->comment('Membership Benefit'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%product}}',[
            'id' => $this->primaryKey(),
            'provider_id' => $this->integer()->notNull()->comment('Product Provider'),
            'name' => $this->string()->notNull()->comment('Product Name'),
            'short_name' => $this->string(),

            'page_order' => $this->integer()->comment('Page Display Order'),

            'img' => $this->string()->comment('Image Filename'),
            'icon' => $this->string()->comment('Icon Filename'),

            'url' => $this->string()->comment('URL'),

            'description' => $this->text(),
            'detail' => $this->text(),
            'benefits' => $this->text(),

            'legal_url' => $this->string(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%product_option}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->comment('Product'),
            'ext_id' => $this->integer()->comment('E123 Product Code'),

            'coverage_type' => $this->integer()->notNull()->comment('Coverage Type'), // 1 - member, 2 - spouse, 3 - family
            'coverage_level' => $this->string()->notNull()->comment('Coverage Amount'),

            'price' => $this->integer()->comment('Monthly Price'), //number of cents in USD

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%product_faq}}',[
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull()->comment('Product'),
            'num' => $this->integer()->notNull()->comment('FAQ number'),

            'content' => $this->text(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%member}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'agent_id' => $this->integer(),

            'group_id' => $this->integer(), // group (if member part of an existing group)

            'ext_id' => $this->integer()->comment('Member ID Number'), // E123-furnished

            'f_name' => $this->string()->comment('First Name'),
            'l_name' => $this->string()->comment('Middle Initial / Name'),
            'm_name' => $this->string()->comment('Last Name'),

            'dob' => $this->date()->comment('Date of Birth'),
            'gender' => $this->string(1), // M / F
            'ssn' => $this->string(9)->comment('Social Security Number'), // SHOULD BE ENCRYPTED!

            'address' => $this->string()->comment('Address'),
            'address2' => $this->string()->comment('Address 2'),
            'city' => $this->string()->comment('City'),
//            'state' => $this->string(2)->comment('State'),
            'state_id' => $this->integer()->comment('State'),
            'zip' => $this->char(5)->comment('Zip Code'),

            'email' => $this->string()->comment('Email Address'),
            'phone' => $this->string(10)->comment('Phone Number'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'sync_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%payment_method}}', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->notNull(),
            'name' => $this->string(),

            'pay_type' => $this->integer()->notNull()->comment('Payment Type'),
//            'acct_name' => $this->string()->notNull()->comment('Name on Account'),

            'f_name' => $this->string()->notNull()->comment('First Name on Account'),
            'l_name' => $this->string()->notNull()->comment('Last Name on Account'),

            'routing'      => $this->string(9)->comment('Bank Routing Number'),
            'account'      => $this->string()->comment('Bank Account Number'),
            'account_type' => $this->integer()->comment('Bank Account Type'), // 1 - checking, 2 - savings

            'exp' => $this->string(7)->comment('Card Expiration Date'),
            'pan' => $this->string(16)->comment('Card Number'),
            'cvv' => $this->string(4)->comment('Card Verification Code'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'sync_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%dependent}}', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer(),
            'relationship' => $this->integer()->comment('Relationship To Member'), // 1 -> spouse, 2 -> child
//            'match_member' => $this->boolean()->comment('Match Member Address'),

            'f_name' => $this->string()->comment('First Name'),
            'm_name' => $this->string()->comment('Middle Initial / Name'),
            'l_name' => $this->string()->comment('Last Name'),

            'dob' => $this->date()->comment('Date of Birth'),
            'gender' => $this->string(1), // M / F
            'ssn' => $this->string(9)->comment('Social Security Number'), // SHOULD BE ENCRYPTED!

            'address' => $this->string()->comment('Address'),
            'address2' => $this->string()->comment('Address 2'),
            'city' => $this->string()->comment('City'),
            'state_id' => $this->integer()->comment('State'),
            'zip' => $this->char(5)->comment('Zip Code'),

            'email' => $this->string()->comment('Email Address'),
            'phone' => $this->string(10)->comment('Phone Number'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'sync_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%member_group}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(),

            'name' => $this->string(),

            'ext_id' => $this->string()->comment('External ID'), // provider / E123 group ID

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%purchase}}', [
            'id' => $this->primaryKey(),
//            'uuid' => $this->string(),

            'member_id' => $this->integer()->notNull(),
            'payment_id' => $this->integer()->notNull(),

            'type' => $this->integer()->notNull()->comment('Purchase Type'), // 1 - membership, 2 - product
            'product_option_id' => $this->integer()->comment('Product Option'),
            'membership_id' => $this->integer()->comment('Membership Plan'),

            'purchase_date' => $this->integer()->notNull(),
            'active_date' => $this->integer()->notNull(),
            'recurring_bill_day' => $this->integer()->notNull(),
            'initial_bill_day' => $this->integer()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'sync_at' => $this->integer(),
        ], $tableOptions);



        $this->createTable('{{%agent}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'parent_id' => $this->integer(),

            'ext_id' => $this->string()->comment('External ID'),
            'has_img' => $this->boolean()->defaultValue(false)->comment('Image Present Flag'),

            'f_name' => $this->string()->comment('First Name'),
            'm_name' => $this->string()->comment('Middle Name'),
            'l_name' => $this->string()->comment('Last Name'),

            'address' => $this->string()->comment('Address'),
            'address2' => $this->string()->comment('Address 2'),
            'city' => $this->string()->comment('City'),
            'state_id' => $this->integer()->comment('State'),
            'zip' => $this->string(5)->comment('Zip'),
            'email' => $this->string()->comment('Email'),
            'phone' => $this->string(10)->comment('Phone'),

            'organization' => $this->string()->comment('Organization Name'),
            'title' => $this->string()->comment('Job Title'),


            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'sync_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%deposit_method}}', [
            'id' => $this->primaryKey(),
            'agent_id' => $this->integer()->notNull()->comment('Agent'),

            'acct_name' => $this->string()->notNull()->comment('Name on Account'),
            'routing' => $this->string(9)->comment('Bank Routing Number'),
            'account' => $this->string()->comment('Bank Account Number'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);



        $this->createTable('{{%provider}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'long_name' => $this->string(),

            'img' => $this->string(),

            'description' => $this->text(),
            'detail' => $this->text(),

            'url' => $this->string(),
            'benefit_email' => $this->string(),
            'benefit_phone' => $this->string(),

            'legal_url' => $this->string(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%provider_user}}', [
            'id' => $this->primaryKey(),
            'provider_id' => $this->integer(),
            'user_id' => $this->integer(),

            'f_name' => $this->string()->comment('First Name'),
            'm_name' => $this->string()->comment('Middle Name'),
            'l_name' => $this->string()->comment('Last Name'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);





        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'short_name' => $this->string(),
            'long_name' => $this->string(),

            'three_letter' => $this->char(3),
            'two_letter' => $this->char(3),

            'currency_id' => $this->integer(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%state}}', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull()->defaultValue(1),
            'name' => $this->string()->notNull(),
            'short_name' => $this->string()->comment('Short Name'),
            'long_name' => $this->string()->comment('Long Name'),

            'three_letter' => $this->char(3)->comment('Three Letter Abbreviation'),
            'two_letter' => $this->char(2)->comment('Two Letter Abbreviation'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);



        $this->createTable('{{%agent_state_map}}', [
            'agent_id' => $this->integer()->notNull(),
            'state_id' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);



        $this->createTable('{{%provider_agent_map}}', [
            'provider_id'   => $this->integer()->notNull(),
            'agent_id' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%provider_state_map}}', [
            'provider_id'=> $this->integer()->notNull(),
            'state_id'   => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);



        $this->createTable('{{%product_state_map}}', [
            'product_id' => $this->integer()->notNull(),
            'state_id'   => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


        $this->createTable('{{%fed_ach}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(36)->comment('')->comment('Customer Name'),
            'type' => $this->integer()->comment('Record Type Code'),

            'office_code' => $this->char(1)->comment('Office Code'),
            'routing_num' => $this->integer()->comment('Routing Number'),
            'new_routing_num' => $this->integer()->comment('New Routing Number'),
            'frb' => $this->integer()->comment('Servicing FRB Number'),

            'change_date' => $this->char(6)->comment('Change Date'),

            'address' => $this->string(36)->comment('Address'),
            'city' => $this->string(20)->comment('City'),
            'state' => $this->char(2)->comment('State Code'),
            'zip' => $this->char(5)->comment('Zipcode'),
            'zip_ext' => $this->char(4)->comment('Zipcode Extension'),
            'phone_area' => $this->char(3)->comment('Telephone Area Code'),
            'phone_prefix' => $this->char(3)->comment('Telephone Prefix Number'),
            'phone_suffix' => $this->char(4)->comment('Telephone Suffix Number'),

            'status_code' => $this->char(1)->comment('Institution Status Code'),
            'view_code' => $this->char(1)->comment('Data View Code'),
            'filter' => $this->char(5)->comment('Filler'),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
