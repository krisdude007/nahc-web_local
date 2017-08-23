<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $provider_id
 * @property string $name
 * @property string $short_name
 * @property integer $page_order
 * @property string $img
 * @property string $url
 * @property string $description
 * @property string $detail
 * @property string $legal_url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Provider $provider
 * @property ProductFaq[] $productFaqs
 * @property ProductOption[] $productOptions
 * @property ProductStateMap[] $productStateMaps
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_SUSPENDED = 20; // no new sales, shows for existing members
    const STATUS_DISABLED = 30;  // completely removed - migrate members to new products

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'name', 'created_at', 'updated_at'], 'required'],
            [['provider_id', 'page_order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description', 'detail'], 'string'],
            [['name', 'short_name', 'img', 'url', 'legal_url'], 'string', 'max' => 255],
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
            'provider_id' => 'Product Provider',
            'name' => 'Product Name',
            'short_name' => 'Short Name',
            'page_order' => 'Page Display Order',
            'img' => 'Image Filename',
            'url' => 'Url',
            'description' => 'Description',
            'detail' => 'Detail',
            'legal_url' => 'Legal Url',
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
        return $this->hasOne(Provider::className(), ['id' => 'provider_id'])->inverseOf('products');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFaqs()
    {
        return $this->hasMany(ProductFaq::className(), ['product_id' => 'id'])->inverseOf('product')->orderBy('num');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptions()
    {
        return $this->hasMany(ProductOption::className(), ['product_id' => 'id'])->inverseOf('product')->indexBy('id');
    }

    public function getProductOptionGroups()
    {
        $options = $this->productOptions;

        return ArrayHelper::index($options, 'id', 'coverageTypeText');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStateMaps()
    {
        return $this->hasMany(ProductStateMap::className(), ['product_id' => 'id'])->inverseOf('product');
    }

    public function checkState($state_id)
    {
        if(empty($state_id))
            return false;

        $providerStateMap = ProviderStateMap::find()->where(['provider_id' => $this->provider->id, 'state_id' => $state_id])->all();

        if(!empty($providerStateMap)) {
            return true;
        }

        $productStateMap = ProductStateMap::find()->where(['product_id' => $this->id, 'state_id' => $state_id])->all();

        if(!empty($productStateMap)) {
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
