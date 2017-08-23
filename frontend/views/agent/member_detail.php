<?php

use common\models\State;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\bootstrap\ToggleButtonGroup;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

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

<h1>Update Member Information</h1>
<p>Review and update your member's plan, information, or payment method below</p>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Member Details</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'f_name') ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'm_name') ?>
            </div>
            <div class="col-sm-5">
                <?= $form->field($model, 'l_name') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'gender')->dropDownList(['M' => 'Male', 'F' => 'Female'],['prompt' => 'Gender']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'dobText')->widget(MaskedInput::className(),['clientOptions'=>['alias'=>'mm/dd/yyyy']]) ?>
            </div>
            <div class="col-sm-5">
                <?= $form->field($model, 'ssn')->widget(MaskedInput::className(),['mask' => '999-99-9999','clientOptions'=>['autoUnmask'=>true,'removeMaskOnSubmit'=>true]]) ?>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Contact Information</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'email')->widget(MaskedInput::className(),['clientOptions'=>['alias' => 'email']]) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'phone')->widget(MaskedInput::className(),['mask' => '(###)###-####','clientOptions'=>['alias' => 'phone','autoUnmask'=>true,'removeMaskOnSubmit'=>true,]]) ?>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Mailing Address</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'address') ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'address2') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5">
                <?= $form->field($model, 'city') ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'state_id')->dropDownList(State::getStateList(),['prompt' => 'State']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'zip')->widget(MaskedInput::className(),['mask' => '99999']) ?>
            </div>
        </div>
    </div>
</div>



<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'member-details-button']) ?>
</div>

<?php
ActiveForm::end();

?>