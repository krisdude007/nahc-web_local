<?php
namespace console\controllers;

use yii\console\Controller;

class ExportController extends Controller
{
    public $defaultAction = 'list-formats';

    public function actionListFormats()
    {
        return Controller::EXIT_CODE_NORMAL;
    }
}