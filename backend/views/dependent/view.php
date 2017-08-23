<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Dependent */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dependents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'member_id',
            'relationship',
            'f_name',
            'l_name',
            'm_name',
            'dob',
            'gender',
            'ssn',
            'address',
            'address2',
            'city',
            'state',
            'zip',
            'email:email',
            'phone',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
