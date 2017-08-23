<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

class ProductForm extends Model
{
    public $product_id;
    public $product_option_id;

    public function rules()
    {
        return [
            ['product_option_id', 'integer'],
        ];
    }
}


