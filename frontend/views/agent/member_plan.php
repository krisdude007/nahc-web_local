<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\bootstrap\ToggleButtonGroup;
use yii\widgets\MaskedInput;

/* @var $model \common\models\Member */

$this->render('_leftnav');

$form = ActiveForm::begin([
//    'layout' => 'horizontal',
//    'fieldConfig' => [
//        'horizontalCssClasses' => [
//            'label' => 'col-sm-3 col-md-3',
//            'offset' => 'col-sm-offset-2 col-md-offset-2',
//            'wrapper' => 'col-sm-6 col-md-4',
//        ],
//    ],
]);

?>

    <h1>Membership Plan Information</h1>
    <p>Please select an updated membership plan below</p>
    <?=$this->render('_member_panel', ['member'=>$model]);?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Current Membership Level</h3>
        </div>
        <div class="panel-body">
            <?php // $form->field($model, 'plan')->dropDownList([1 => 'Basic',2 => 'Bronze', 3 => 'Silver', 4 => 'Gold'],['prompt' => 'Select Plan']) ?>
            <h3><?= (empty($model->membership)?'None':$model->membership->name)?></h3>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">New Membership Level</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'plan')->dropDownList($options,['prompt' => 'Select Plan']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'member-plan-button']) ?>
    </div>

<?php
ActiveForm::end();

?>