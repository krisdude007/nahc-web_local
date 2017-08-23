<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "membership_benefit_map".
 *
 * @property integer $id
 * @property integer $membership_id
 * @property integer $benefit_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Membership $membership
 * @property MembershipBenefit $benefit
 */
class MembershipBenefitMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership_benefit_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['membership_id', 'benefit_id', 'created_at', 'updated_at'], 'required'],
            [['membership_id', 'benefit_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['membership_id'], 'exist', 'skipOnError' => true, 'targetClass' => Membership::className(), 'targetAttribute' => ['membership_id' => 'id']],
            [['benefit_id'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipBenefit::className(), 'targetAttribute' => ['benefit_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'membership_id' => 'Membership',
            'benefit_id' => 'Membership Benefit',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembership()
    {
        return $this->hasOne(Membership::className(), ['id' => 'membership_id'])->inverseOf('membershipBenefitMaps');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenefit()
    {
        return $this->hasOne(MembershipBenefit::className(), ['id' => 'benefit_id'])->inverseOf('membershipBenefitMaps');
    }

    /**
     * @inheritdoc
     * @return MembershipBenefitMapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MembershipBenefitMapQuery(get_called_class());
    }
}
