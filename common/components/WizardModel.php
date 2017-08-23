<?php
/**
 * Copyright (c) 2016-2017 Michael Menefee / CBH
 */
namespace common\components;

use yii\base\Model;

class WizardModel extends Model
{
    public $step;
    public $action;
    public $viewBase;
    public $steps;
    public $data;
    public $redirect;
    public $btnClass;
    public $btnClassDisabled;
    public $cancel;

    public function rules()
    {
        return [
            ['action', 'in', 'range' => ['cancel', 'next', 'prev', 'finish', 'start']],

            ['step', 'in', 'range' => [1,2,3,4,5,6,7,8,9,10]],

            ['data', 'safe'],
        ];
    }
}