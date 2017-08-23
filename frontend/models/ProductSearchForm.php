<?php
namespace frontend\models;

use yii\base\Model;

/**
 * AgentSearch form
 */
class ProductSearchForm extends Model
{
    public $state_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_id'], 'required'],
            [['state_id'], 'integer', 'min' => 1, 'max' => 56],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'state_id' =>   'State',
        ];
    }
}
