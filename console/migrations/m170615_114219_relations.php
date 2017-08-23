<?php

use common\models\User;
use yii\db\Migration;

class m170615_114219_relations extends Migration
{
    public function up()
    {
        // TABLE member
        $this->createIndex('idx-member-agent_id', 'member', 'agent_id');
        $this->createIndex('idx-member-user_id', 'member', 'user_id');
        $this->addForeignKey('fk-member-agent_id', 'member', 'agent_id', 'agent', 'id', 'CASCADE');
        $this->addForeignKey('fk-member-user_id', 'member', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk-member-state_id', 'member', 'state_id', 'state', 'id', 'CASCADE');




        // TABLE agent
        $this->createIndex('idx-agent-user_id', 'agent', 'user_id');
        $this->addForeignKey('fk-agent-user_id', 'agent', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk-agent-state_id', 'agent', 'state_id', 'state', 'id', 'CASCADE');

        // TABLE dependent
        $this->createIndex('idx-dependent-member_id', 'dependent', 'member_id');
        $this->addForeignKey('fk-dependent-member_id', 'dependent', 'member_id', 'member', 'id', 'CASCADE');
        $this->addForeignKey('fk-dependent-state_id', 'dependent', 'state_id', 'state', 'id', 'CASCADE');

        // TABLE purchase
        $this->createIndex('idx-purchase-member_id', 'purchase', 'member_id');
        $this->addForeignKey('fk-purchase-member_id', 'purchase', 'member_id', 'member', 'id', 'CASCADE');
        $this->addForeignKey('fk-purchase-product_option_id', 'purchase', 'product_option_id', 'product_option', 'id', 'CASCADE');
        $this->addForeignKey('fk-purchase-membership_id', 'purchase', 'membership_id', 'membership', 'id', 'CASCADE');

        // TABLE product
        $this->createIndex('idx-product-provider_id', 'product', 'provider_id');
        $this->addForeignKey('fk-product-provider_id', 'product', 'provider_id', 'provider', 'id', 'CASCADE');


        // TABLE product_option
        $this->createIndex('idx-product_option-product_id', 'product_option', 'product_id');
        $this->addForeignKey('fk-product_option-product_id', 'product_option', 'product_id', 'product', 'id', 'CASCADE');

        // TABLE product_faq
        $this->createIndex('idx-product_faq-product_id', 'product_faq', 'product_id');
        $this->addForeignKey('fk-product_faq-product_id', 'product_faq', 'product_id', 'product', 'id', 'CASCADE');


        // TABLE membership_benefit
        $this->addForeignKey('fk-membership_benefit-provider_id', 'membership_benefit', 'provider_id', 'provider', 'id', 'CASCADE');


        // TABLE membership_benefit_map
        $this->createIndex('idx-membership_benefit_map-membership_id', 'membership_benefit_map', 'membership_id');
        $this->createIndex('idx-membership_benefit_map-benefit_id', 'membership_benefit_map', 'benefit_id');
        $this->addForeignKey('fk-membership_benefit_map-membership_id', 'membership_benefit_map', 'membership_id', 'membership', 'id', 'CASCADE');
        $this->addForeignKey('fk-membership_benefit_map-benefit_id', 'membership_benefit_map', 'benefit_id', 'membership_benefit', 'id', 'CASCADE');




        // TABLE member_payment
        $this->createIndex('idx-payment_method-member_id', 'payment_method', 'member_id');
        $this->addForeignKey('fk-payment_method-member_id', 'payment_method', 'member_id', 'member', 'id', 'CASCADE');

        // TABLE member_payment
        $this->createIndex('idx-deposit_method-agent_id', 'deposit_method', 'agent_id');
        $this->addForeignKey('fk-deposit_method-member_id', 'deposit_method', 'agent_id', 'agent', 'id', 'CASCADE');


        $this->createIndex('idx-agent_state_map-state_id', 'agent_state_map', 'state_id');
        $this->createIndex('idx-agent_state_map-agent_id', 'agent_state_map', 'agent_id');
        $this->addForeignKey('fk-agent_state_map-agent_id', 'agent_state_map', 'agent_id', 'agent', 'id', 'CASCADE');
        $this->addForeignKey('fk-agent_state_map-state_id', 'agent_state_map', 'state_id', 'state', 'id', 'CASCADE');



        $this->createIndex('idx-provider_state_map-state_id', 'provider_state_map', 'state_id');
        $this->addForeignKey('fk-provider_state_map-provider_id', 'provider_state_map', 'provider_id', 'provider', 'id', 'CASCADE');
        $this->addForeignKey('fk-provider_state_map-state_id', 'provider_state_map', 'state_id', 'state', 'id', 'CASCADE');


        $this->createIndex('idx-provider_agent_map-agent_id', 'provider_agent_map', 'agent_id');
        $this->addForeignKey('fk-provider_agent_map-provider_id', 'provider_agent_map', 'provider_id', 'provider', 'id', 'CASCADE');
        $this->addForeignKey('fk-provider_agent_map-agent_id', 'provider_agent_map', 'agent_id', 'agent', 'id', 'CASCADE');


        $this->createIndex('idx-product_state_map-state_id', 'product_state_map', 'state_id');
        $this->addForeignKey('fk-product_state_map-product_id', 'product_state_map', 'product_id', 'product', 'id', 'CASCADE');
        $this->addForeignKey('fk-product_state_map-state_id', 'product_state_map', 'state_id', 'state', 'id', 'CASCADE');

    }
}