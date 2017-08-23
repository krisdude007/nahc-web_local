<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MemberSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'agent_id') ?>

    <?= $form->field($model, 'group_id') ?>

    <?= $form->field($model, 'ext_id') ?>

    <?php // echo $form->field($model, 'f_name') ?>

    <?php // echo $form->field($model, 'l_name') ?>

    <?php // echo $form->field($model, 'm_name') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'ssn') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'address2') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'state_id') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
