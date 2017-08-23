<?php
use common\models\State;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\MaskedInput;

$this->render('_leftnav');

?>

<h1>Details</h1>
<p>Review and update Agent details, and then click Save</p>

<?php $form = ActiveForm::begin(['id' => 'form-agent']); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Agent Details</h3>
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
            <div class="col-sm-6">
                <?= $form->field($model, 'organization') ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'title') ?>
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
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'agent-save-button']) ?>
    </div>

<?php ActiveForm::end(); ?>