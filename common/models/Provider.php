<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider".
 *
 * @property integer $id
 * @property string $name
 * @property string $long_name
 * @property string $img
 * @property string $description
 * @property string $detail
 * @property string $url
 * @property string $benefit_email
 * @property string $benefit_phone
 * @property string $legal_url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property MembershipBenefit[] $membershipBenefits
 * @property Product[] $products
 */
class Provider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'detail'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['name', 'long_name', 'img', 'url', 'benefit_email', 'benefit_phone', 'legal_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'long_name' => 'Long Name',
            'img' => 'Img',
            'description' => 'Description',
            'detail' => 'Detail',
            'url' => 'Url',
            'benefit_email' => 'Benefit Email',
            'benefit_phone' => 'Benefit Phone',
            'legal_url' => 'Legal Url',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipBenefits()
    {
        return $this->hasMany(MembershipBenefit::className(), ['provider_id' => 'id'])->inverseOf('provider');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['provider_id' => 'id'])->inverseOf('provider');
    }

    /**
     * @inheritdoc
     * @return ProviderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProviderQuery(get_called_class());
    }
}
