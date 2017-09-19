<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\bootstrap\ToggleButtonGroup;
use yii\widgets\MaskedInput;

$this->title = 'Payment Information';

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

    <h1>Payment Information</h1>
    <p>Please select a payment method and enter the payment information below</p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Current Payment Method</h3>
        </div>
        <div class="panel-body">
            <dl class="dl-horizontal">
                <dt>Payment Type</dt>
                <dd><?= $model->payTypeText ?></dd>
                <dt>Name On Account</dt>
                <dd><?= $model->accountName ?></dd>
            </dl>
            <?php if ($model->pay_type == 1) { ?>
                <dl class="dl-horizontal">
                    <dt>Account Type</dt>
                    <dd><?= $model->acctTypeText ?></dd>
                    <dt>Routing Code</dt>
                    <dd><?= $model->routingText ?></dd>
                    <dt>Account Number</dt>
                    <dd><?= $model->accountText ?></dd>
                </dl>
            <?php } elseif ($model->pay_type == 2) { ?>
                <dl class="dl-horizontal">
                    <dt>Card Number</dt>
                    <dd><?= $model->panText ?></dd>
                    <dt>Expiration Date</dt>
                    <dd><?= $model->exp ?></dd>
                </dl>
            <?php } ?>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Updated Payment Method</h3>
        </div>
        <div class="panel-body">
            <?php $this->registerJs('document.selPay = function (btn) { 
                        if(btn.childNodes[0].getAttribute("value") == 1) {
                            $("#bankPanel").show();
                            $("#cardPanel").hide();
                        } 
                        
                        if(btn.childNodes[0].getAttribute("value") == 2) {
                           $("#bankPanel").hide();
                           $("#cardPanel").show();
                        }
                        
                        $("#acctName").show();
                     
                     };'); ?>
            <?= $form->field($updateModel, 'pay_type')->widget(ToggleButtonGroup::className(), [
                'type' => 'radio',
                'items' => [
                    1 => 'Bank Account',
                    2 => 'Credit Card',
                ],
                'labelOptions' => ['class' => 'btn-primary', 'onclick' => 'document.selPay(this)'],
                'options' => ['class' => 'plan-full-width'],
            ]);?>
        </div>
    </div>

    <div class="panel panel-default" id="acctName" style="<?=(empty($updateModel->pay_type)?'display: none;':'')?>">
        <div class="panel-heading">
            <h3 class="panel-title">Updated Account Information</h3>
        </div>
        <div class="panel-body">
            <?php
            if(empty($updateModel->f_name))
                $updateModel->f_name = $updateModel->member->f_name;

            if(empty($updateModel->l_name))
                $updateModel->l_name = $updateModel->member->l_name; ?>

            <div class="row">
                <div class="col-sm-6">
                    <?=$form->field($updateModel, 'f_name') ?>
                </div>
                <div class="col-sm-6">
                    <?=$form->field($updateModel, 'l_name') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="cardPanel" style="<?=($updateModel->pay_type == 2?'':'display: none;')?>">
        <div class="panel-heading">
            <h3 class="panel-title">Updated Card Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-5">
                    <?= $form->field($updateModel, 'panText')->widget(MaskedInput::className(),['mask' => ['x### ###### #####'],
                        'definitions' => [
                            'x' => [
                                'validator' =>  '3',
                                'cardinality' => 1,
                            ],
                            'o' => [
                                'validator' =>  '[45]',
                                'cardinality' => 1,
                            ],
                        ],
                        'clientOptions'=>['autoUnmask'=>true,'removeMaskOnSubmit'=>true,]
                    ]); ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($updateModel, 'exp')->widget(MaskedInput::className(),[
//                                'aliases' => [
//                                        'mm/yy' => [
//                                            'mask' => "1/y",
//                                            'placeholder' => "mm/yy",
//                                            'leapday' => "donotuse",
//                                            'separator' => "/",
//                                            'alias' => "mm/dd/yyyy",
//                                        ]
//                                ],
                        'clientOptions'=>['alias' => 'mm/yyyy',],
                    ]); ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($updateModel, 'cvv')->widget(MaskedInput::className(),['mask' => '999[9]']); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="bankPanel" style="<?=($updateModel->pay_type == 1?'':'display: none;')?>">
        <div class="panel-heading">
            <h3 class="panel-title">Updated Bank Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($updateModel, 'account_type')->dropDownList($updateModel->acctTypes,['prompt' => 'Type']); ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($updateModel, 'routing')->widget(MaskedInput::className(),['mask' => '999999999', 'clientOptions' => [
                        'autoUnmask' => true,
                        'onBeforeWrite' =>
                            new \yii\web\JsExpression('function (event, buffer) { 
                            var pad = \'000000000\';
                            if (event.type !== \'blur\') { return {}; }; 
                            var filteredValue = buffer.filter(function(e) { return e !== \'_\' });
                            var currentValue = filteredValue.join(\'\'); 
                            var subBuf = ( pad + currentValue).substr(currentValue.length, pad.length); 
                            return { refreshFromBuffer: true, buffer: subBuf.split(\'\') };}'),]]); ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($updateModel, 'account')->widget(MaskedInput::className(),['mask' => '9999[9999999999999]']); ?>
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