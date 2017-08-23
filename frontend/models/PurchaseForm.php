<?php

namespace frontend\models;

use common\models\Product;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * PurchaseForm is the model behind the member product purchase form.
 */
class PurchaseForm extends Model
{
    public $product_id;
    public $product_option_id;

    public $product;
    public $option;

    public $agree;

    public function rules()
    {
        return [
            ['product_option_id', 'required'],
            ['product_option_id', 'integer'],
            ['agree', 'boolean'],
        ];
    }

    public function getProductName()
    {
        return $this->product->name;
    }

    public function getOptionList()
    {
        $this->product = Product::findOne($this->product_id);

        if(empty($this->product))
            return null;

        $options = $this->product->getProductOptions()->all();

        $optionList = ArrayHelper::map($options, 'id', 'optionText', 'coverageTypeText');

        Yii::info('Option List: '.print_r($optionList, true));

        return $optionList;
    }

}