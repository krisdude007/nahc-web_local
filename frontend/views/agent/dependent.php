<?php
use common\models\State;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\MaskedInput;
/* @var $this yii\web\View */
/* @var \common\models\Dependent $model */

if(empty($model->id))
    $this->title = 'Add Dependent';
else
    $this->title = 'Edit Dependent';

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
    <div class="dependent-edit">

    <h1><?= Html::encode($this->title) ?></h1><br>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Dependent Relationship</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'relationship')->dropDownList($model->relationshipTypes,['prompt' => 'Relationship']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Dependent Details</h3>
        </div>
        <div class="panel-body">
            <div class="row ">
                <div class="col-sm-4">
                    <?= $form->field($model, 'f_name'); ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'm_name'); ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($model, 'l_name'); ?>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-3">
                    <?= $form->field($model, 'dobText', ['inputOptions' => ['placeholder' => 'mm/dd/yyyy']]);  ?>
                    <?php //echo $form->field($model, 'dobText')->widget(MaskedInput::className(),['clientOptions'=>['alias'=>'mm/dd/yyyy']]);  ?>
                    <?php //$form->field($model, 'email')->widget(MaskedInput::className(),['clientOptions'=>['alias'=>'email']]); ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'gender')->dropDownList(['M' => 'Male', 'F' => 'Female'],['prompt' => 'Gender']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'ssn')->widget(MaskedInput::className(),['mask' => '999-99-9999','clientOptions'=>['autoUnmask'=>true,'removeMaskOnSubmit'=>true]]); ?>
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
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'dependent-save-button']) ?>
    </div>

<?php
ActiveForm::end();

?>