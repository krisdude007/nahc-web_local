<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use common\models\State;
use yii\bootstrap\ToggleButtonGroup;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Enroll Member';
//$this->params['breadcrumbs'][] = $this->title;

$this->render('_leftnav');
?>
<div class="agent-enroll">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to enroll a new member:</p>

<?php $form = ActiveForm::begin(['id' => 'form-enroll']); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Membership Level</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'plan')->dropDownList(ArrayHelper::map($plans, 'id', 'name'),['prompt' => 'Select Plan']) ?>
        </div>
    </div>

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

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Payment Information</h3>
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

            <div class="row" id="acctName" style="display: none;">
                <div class="col-sm-12">
                    <?php
                    if(empty($model->acct_f_name))
                        $model->acct_f_name = $model->f_name;

                    if(empty($model->acct_l_name))
                        $model->acct_l_name = $model->l_name;?>

                    <div class="row">
                        <div class="col-sm-6">
                            <?=$form->field($model, 'acct_f_name') ?>
                        </div>
                        <div class="col-sm-6">
                            <?=$form->field($model, 'acct_l_name') ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="cardPanel" style="display: none;">
                <div class="col-sm-6">
                    <?= $form->field($model, 'pan')->widget(MaskedInput::className(),['mask' => ['x### ###### #####', 'o### #### #### ####'],
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
                <div class="col-sm-2">
                    <?= $form->field($model, 'cvv')->widget(MaskedInput::className(),['mask' => '999[9]']); ?>
                </div>
            </div>

            <div class="row" id="bankPanel" style="display: none;">
                <div class="col-sm-3">
                    <?= $form->field($model, 'account_type')->dropDownList([1 => 'Checking', 2 => 'Savings'],['prompt' => 'Type']); ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'routing')->widget(MaskedInput::className(),['mask' => '999999999', 'clientOptions' => [
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
                    <?= $form->field($model, 'account')->widget(MaskedInput::className(),['mask' => ['9999[9999999999999]']]); ?>
                </div>
            </div>

        </div>
    </div>



            <div class="form-group">
                <?= Html::submitButton('Enroll', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
</div>
