<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_state_map".
 *
 * @property integer $product_id
 * @property integer $state_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Product $product
 * @property State $state
 */
class ProductStateMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_state_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'state_id', 'created_at', 'updated_at'], 'required'],
            [['product_id', 'state_id', 'created_at', 'updated_at'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'state_id' => 'State ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id'])->inverseOf('productStateMaps');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id'])->inverseOf('productStateMaps');
    }
}
