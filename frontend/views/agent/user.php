<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\MaskedInput;

$this->title = 'Change Password';

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

<h1>Change Password</h1>
<p>To update the password for your account, enter your current password and new password below.</p>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Current Password</h3>
    </div>
    <div class="panel-body">
        <?= $form->field($model, 'password')->passwordInput(); ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">New Password</h3>
    </div>
    <div class="panel-body">
        <?= $form->field($model, 'new_password')->passwordInput(); ?>
        <?= $form->field($model, 'repeat_password')->passwordInput(); ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>
<?php ActiveForm::end();?>