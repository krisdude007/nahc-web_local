<?php
/**
 * Copyright (c) 2016-2017 Michael Menefee / CBH
 */
namespace common\components;

use yii\base\Event;

class WizardEvent extends Event
{
    public $model;
    public $result = false;
}