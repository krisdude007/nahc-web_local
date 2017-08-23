<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * AgentSearch form
 */
class AgentSearchForm extends Model
{
    public $city;
    public $state;
    public $zip;

    public $results;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'state', 'zip'], 'trim'],

            [['state'], 'match', 'pattern' => '/^[A-Z]{2}$/'],
            [['zip'], 'match', 'pattern' => '/^[0-9]{5}$/'],

            [['city', 'state'], 'required', 'when' => function($model) { return empty($model->zip); },
                'whenClient' => "function (attribute, value) { return $('#agentsearchform-zip').val() == ''; }",],
            [['zip'], 'required', 'when' => function($model) { return (empty($model->city) || empty($model->state)); }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city' =>   'City',
            'state' =>  'State',
            'zip' =>    'Zip',
        ];
    }
}
