<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_faq".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $num
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Product $product
 */
class ProductFaq extends \yii\db\ActiveRecord
{
    public $faqLabel = [
        1 => ['prompt' => 'What is ',                   'label' => true ],
        2 => ['prompt' => 'Who needs ',                 'label' => true ],
        3 => ['prompt' => 'Who Doesn\'t Need ',         'label' => true ],
        4 => ['prompt' => 'What is Included?',          'label' => false],
        5 => ['prompt' => 'What is Excluded?',          'label' => false],
        6 => ['prompt' => 'Limitations & Exclusions',   'label' => false],
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'num', 'created_at', 'updated_at'], 'required'],
            [['product_id', 'num', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
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
            'product_id' => 'Product',
            'num' => 'FAQ number',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id'])->inverseOf('productFaqs');
    }

    /**
     * @inheritdoc
     * @return ProductFaqQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductFaqQuery(get_called_class());
    }
}
