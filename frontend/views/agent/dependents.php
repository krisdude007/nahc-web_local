<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DependentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $member common\models\Member */

$this->title = 'Member Dependents';
//$this->params['breadcrumbs'][] = $this->title;

$this->render('_leftnav');
?>
<div class="dependent-index">

    <h1><?= Html::encode($member->nameText . ' Dependents') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Dependent', ['agent/dependent', 'member_id' => $member->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'f_name',
            'l_name',
//            'id',
//            'member.name',
            'relationshipText',

            // 'm_name',
            // 'dob',
            // 'gender',
            // 'ssn',
            // 'address',
            // 'address2',
            // 'city',
            // 'state',
            // 'zip',
            // 'email:email',
            // 'phone',
            // 'status',
            // 'created_at',
            // 'updated_at',

//            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{dependent}',
                'buttons' => [
                    'dependent' => function ($url, $model, $key) {
                        return Html::a('Edit', ['agent/dependent', 'id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
