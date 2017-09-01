<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

    <div class="jumbotron jumbo-top jumbo-contact">
        <h1>Contact Us</h1>
    </div>

    <div class="body-content">
        <?= Alert::widget() ?>

        <div class="row caption-row">
            <div class="col-sm-8 col-sm-offset-2">
                <h1>Stay In Touch!<br><small>We’re here for you when and as you need us</small></h1>
                <p class="lead">Have a question? Please feel free to contact us by mail, phone or email with any questions, comments, or concerns. </p>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Contact Us</h1>
                <p class="lead">Contact us using the form below and someone will get back to you ASAP!</p>
            </div>
        </div>
        <div class="row content-row text-left" style="margin-top: 0; padding-top: 0;">
            <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="row" style="margin-top: 0;">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'name')->textInput() ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'email') ?>
                    </div>
                    <div class="col-sm-12">
                            <?= $form->field($model, 'subject') ?>
                    </div>
                    <div class="col-sm-12">
                            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="col-sm-6">
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="col-sm-6">{image}</div><div class="col-sm-6">{input}</div>',
                    ]) ?>
                    </div>
                    <div class="col-sm-12 text-right">
                            <div class="form-group">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Location</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <address>
                    <strong>National Association for Healthcare Consumers</strong><br>
                    16801 Addison Road<br>
                    Suite 247<br>
                    Addison, Texas 75001<br><br>
                    Phone: <a href="tel:1-844-640-0400">(844) 640-0400</a><br>
                </address>
            </div>
        </div>
        <div class="jumbotron cta-row" style="background-image: url('/img/map.png'); min-height: 350px; background-size: cover;">
        </div>

    </div>
</div>
