<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'f_name') ?>

                <?= $form->field($model, 'm_name') ?>

                <?= $form->field($model, 'l_name') ?>

                <?= $form->field($model, 'dobText') ?>

                <?= $form->field($model, 'gender')->dropDownList(['M' => 'Male', 'F' => 'Female']) ?>

                <?= $form->field($model, 'ssn') ?>

                <?= $form->field($model, 'address') ?>

                <?= $form->field($model, 'address2') ?>

                <?= $form->field($model, 'city') ?>

                <?= $form->field($model, 'state') ?>

                <?= $form->field($model, 'zip') ?>

                <?= $form->field($model, 'phone') ?>

                <?= $form->field($model, 'plan')->dropDownList([1 => 'Basic',2 => 'Bronze', 3 => 'Silver', 4 => 'Gold']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
