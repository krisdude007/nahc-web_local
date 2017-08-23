<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "membership_benefit".
 *
 * @property integer $id
 * @property integer $provider_id
 * @property string $name
 * @property string $icon
 * @property integer $page_order
 * @property boolean $benefit_mem_id
 * @property string $group_data
 * @property string $other_ref
 * @property string $url
 * @property string $email
 * @property string $phone
 * @property string $description
 * @property string $detail
 * @property string $features
 * @property string $features2
 * @property string $legal_url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Provider $provider
 * @property MembershipBenefitMap[] $membershipBenefitMaps
 */
class MembershipBenefit extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_SUSPENDED = 20; // no new members, shows for existing members
    const STATUS_DISABLED = 30;  // completely removed - migrate members to new plans

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership_benefit';
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
            [['provider_id', 'name', 'icon'], 'required'],
            [['provider_id', 'page_order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['benefit_mem_id'], 'boolean'],
            [['description', 'detail', 'features', 'features2'], 'string'],
            [['name', 'icon', 'group_data', 'other_ref', 'url', 'email', 'phone', 'legal_url'], 'string', 'max' => 255],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider_id' => 'Benefit Provider',
            'name' => 'Benefit Name',
            'icon' => 'Icon File Name',
            'page_order' => 'Page List Order',
            'benefit_mem_id' => 'Display Member ID',
            'group_data' => 'Provider Group Number',
            'other_ref' => 'Provider Secondary Reference',
            'url' => 'Benefit Access URL',
            'email' => 'Benefit Provider Email',
            'phone' => 'Benefit Provider Phone',
            'description' => 'Benefit Description',
            'detail' => 'Benefit Details',
            'features' => 'Features',
            'features2' => 'Features2',
            'legal_url' => 'Legal Info URL',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id'])->inverseOf('membershipBenefits');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipBenefitMaps()
    {
        return $this->hasMany(MembershipBenefitMap::className(), ['benefit_id' => 'id'])->inverseOf('benefit');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberships()
    {
        return $this->hasMany(Membership::className(), ['id' => 'membership_id'])->via('membershipBenefitMaps');
    }

    /**
     * @return integer
     */
    public function getMinimumMembershipLevel()
    {
        $membership = $this->getMemberships()->select('level')->distinct()->orderBy(['level' => SORT_ASC])->asArray()->one();

        Yii::info('Membership: '.print_r($membership, true));

        if(empty($membership))
            return null;

        return $membership['level'];
    }

    /**
     * @inheritdoc
     * @return MembershipBenefitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MembershipBenefitQuery(get_called_class());
    }
}
