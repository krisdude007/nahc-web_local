<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_option".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $ext_id
 * @property integer $coverage_type
 * @property string $coverage_level
 * @property integer $price
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Product $product
 * @property Purchase[] $purchases
 */
class ProductOption extends \yii\db\ActiveRecord
{
    const COVERAGE_INDIVIDUAL = 1;
    const COVERAGE_SPOUSE = 2;
    const COVERAGE_FAMILY = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'ext_id', 'coverage_type', 'price', 'status', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['coverage_level'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'ext_id' => 'Ext ID',
            'coverage_type' => 'Coverage Type',
            'coverage_level' => 'Coverage Level',
            'price' => 'Price',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCoverageTypeText()
    {
        switch ($this->coverage_type) {
            case 1:
                return 'Individual Member';
                break;
            case 2:
                return 'Member and Spouse';
                break;
            case 3:
                return 'Member and family';
                break;
            default:
                return '';
        }

        return '';
    }

    public function getOptionText()
    {
        $label = $this->coverage_level . '--$' . ($this->price / 100) . ' / mo';

        return $label;
    }

    public function getPriceText()
    {
        return '$'.($this->price / 100).' / mo';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id'])->inverseOf('productOptions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['product_option_id' => 'id'])->inverseOf('productOption');
    }

    /**
     * @inheritdoc
     * @return ProductOptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductOptionQuery(get_called_class());
    }
}
