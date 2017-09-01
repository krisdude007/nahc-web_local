<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Agent Inquiry';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-agent-contact">

    <div class="jumbotron jumbo-top jumbo-contact">
        <h1>Agent Inquiry</h1>
    </div>

    <div class="body-content">
        <?= Alert::widget() ?>

        <div class="row caption-row">
            <div class="col-sm-8 col-sm-offset-2">
                <h1>Interested in becoming an agent, or need more information?<br><small>We'd be happy to help!</small></h1>
                <p class="lead">Fill out the form below and an NAHC representative will get back to you as soon as possible</p>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Agent Inquiry</h1>
            </div>
        </div>


        <div class="row content-row text-left">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <div class="col-sm-6 col-lg-3 col-lg-offset-3">
                <?= $form->field($model, 'name')->textInput() ?>
            </div>
            <div class="col-sm-6 col-lg-3">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="col-sm-12 col-lg-6 col-lg-offset-3">
                <?= $form->field($model, 'subject')->dropDownList(['Agent Application Request' => 'I want to become an NAHC Agent', 'Info request' => 'I need more information on becoming an NAHC Agent', 'Other' => 'Something Else']); ?>
            </div>
            <div class="col-sm-12 col-lg-6 col-lg-offset-3">
                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-sm-6 col-lg-6 col-lg-offset-3"><div class="row">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="col-sm-6">{image}</div><div class="col-sm-6">{input}</div>',
                ]) ?>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-lg-offset-3 text-right">
                <div class="form-group">
                    <br><?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
