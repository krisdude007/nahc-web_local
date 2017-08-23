<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\MemberForm */
/* @var $agent \common\models\Agent */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact Agent';
$this->render('_leftnav');
//$this->params['breadcrumbs'][] = $this->title;

//$agent = $model->agent;
?>
<div class="member-agent-contact">

    <h1>Contact My Agent</h1>

    <div class="well">
        <h3><?=$agent->nameText?></h3>
        <div class="row">
            <div class="col-sm-6">
                <address>
                    <?=$agent->address?><br>
                    <?=$agent->address2?><br>
                    <?=$agent->city?>,&nbsp;<?=$agent->stateText?>&nbsp;<?=$agent->zip?>
                </address>
            </div>
            <div class="col-sm-6">
                <p><?=Html::a($agent->phoneText, 'tel:+1'.$agent->phone)?><br>
                   <?=Html::a($agent->email, 'mailto:'.$agent->email)?>
                </p>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'contact-agent-form']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'email')->textInput(['readonly' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'subject')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

