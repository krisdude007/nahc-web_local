<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\bootstrap\ToggleButtonGroup;
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

    <h1>Payment Information</h1>
    <p>Please select a payment method and enter the member's updated payment information below</p>
<?=$this->render('_member_panel', ['member'=>$member]);?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Payment Method</h3>
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
            <?= $form->field($model, 'pay_type')->widget(ToggleButtonGroup::className(), [
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

    <div class="panel panel-default" id="acctName" style="<?=(empty($model->pay_type)?'display: none;':'')?>">
        <div class="panel-heading">
            <h3 class="panel-title">Account Information</h3>
        </div>
        <div class="panel-body">
            <?php
            if(empty($model->f_name))
                $model->f_name = $model->member->f_name;

            if(empty($model->l_name))
                $model->l_name = $model->member->l_name;?>
            <div class="row">
                <div class="col-sm-6">
                    <?=$form->field($model, 'f_name') ?>
                </div>
                <div class="col-sm-6">
                    <?=$form->field($model, 'l_name') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="cardPanel" style="<?=($model->pay_type == 2?'':'display: none;')?>">
        <div class="panel-heading">
            <h3 class="panel-title">Card Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-5">
                    <?= $form->field($model, 'pan')->widget(MaskedInput::className(),['mask' => ['x### ###### #####'],
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
                    <?= $form->field($model, 'exp')->widget(MaskedInput::className(),[
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
                    <?= $form->field($model, 'cvv')->widget(MaskedInput::className(),['mask' => '999[9]']); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default" id="bankPanel" style="<?=($model->pay_type == 1?'':'display: none;')?>">
        <div class="panel-heading">
            <h3 class="panel-title">Card Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-5">
                    <?= $form->field($model, 'routing')->widget(MaskedInput::className(),['mask' => '999999999']); ?>
                </div>
                <div class="col-sm-7">
                    <?= $form->field($model, 'account')->widget(MaskedInput::className(),['mask' => ['99999999[999999999]']]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'member-payment-button']) ?>
    </div>

<?php
ActiveForm::end();

?>