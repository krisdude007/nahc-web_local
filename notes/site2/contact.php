<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

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
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Stay In Touch</h1>
                <p>Have a question?  We’re here for you when and as you need us. Please feel free to contact us by mail,
                    phone or email with any questions, comments, or concerns.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>MAP</h1>
                <p>Insert Map Here
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>National Association for Healthcare Consumers</h1>
                <p>16801 Addison Road<br>
                    Suite 247<br>
                    Addison, Texas 75001<br><br>
                    Phone Us<br>
                    (844) 640-0400<br></p>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
