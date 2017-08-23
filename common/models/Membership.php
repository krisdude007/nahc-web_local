<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "membership".
 *
 * @property integer $id
 * @property integer $ext_id
 * @property string $name
 * @property string $long_name
 * @property integer $level
 * @property string $img
 * @property integer $price
 * @property string $description
 * @property string $detail
 * @property string $legal_url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property MembershipBenefit[] $benefits
 * @property Purchase[] $purchases
 */
class Membership extends \yii\db\ActiveRecord
{
    const MEMBERSHIP_BASIC = 1;
    const MEMBERSHIP_BRONZE = 2;
    const MEMBERSHIP_SILVER = 3;
    const MEMBERSHIP_GOLD = 4;

    const MEMBERSHIP_MAX = 4;

    const STATUS_ACTIVE = 10;
    const STATUS_SUSPENDED = 20; // no new members, shows for existing members
    const STATUS_DISABLED = 30;  // completely removed - migrate members to new plans

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ext_id', 'price', 'status', 'level', 'created_at', 'updated_at'], 'integer'],
            [['description', 'detail'], 'string'],
            [['name', 'long_name', 'img', 'legal_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ext_id' => 'Ext ID',
            'name' => 'Name',
            'long_name' => 'Long Name',
            'img' => 'Img',
            'price' => 'Price',
            'description' => 'Description',
            'detail' => 'Detail',
            'legal_url' => 'Legal Url',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getPriceText()
    {
        if($this->price == 0)
            return 'Free';

        return '$'.($this->price / 100).'/mo';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipBenefitMaps()
    {
        return $this->hasMany(MembershipBenefitMap::className(), ['membership_id' => 'id'])->inverseOf('membership');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenefits()
    {
        return $this->hasMany(MembershipBenefit::className(), ['id' => 'benefit_id'])->via('membershipBenefitMaps')->orderBy('page_order');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['membership_id' => 'id'])->inverseOf('membership');
    }

    /**
     * @inheritdoc
     * @return MembershipQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MembershipQuery(get_called_class());
    }
}
