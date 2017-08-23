<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DependentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dependents';

$this->render('_leftnav');

?>

<h1>Dependents</h1>
<p>
    <?= Html::a('Add Dependent', ['add-dependent'], ['class' => 'btn btn-success']) ?>
</p>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],

//        'id',
//        'member_id',
        'nameText',
        'relationshipText',
//        'f_name',
//        'l_name',
        // 'address',
        // 'city',
        // 'state',
        // 'zip',
        // 'email:email',
//         'dob',
//         'gender',
        // 'ssn',
        // 'status',
        // 'created_at',
        // 'updated_at',

        ['class' => 'yii\grid\ActionColumn',
            'template' => '{dependent}',// {memberDetail} {memberPlan} {memberPayment} {memberProduct}',
            'buttons' => [
                'dependent' => function ($url, $model, $key) {
                    return Html::a('Update', ['member/dependent', 'id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
                },
//                'memberDetail' => function ($url, $model, $key) {
//                    return Html::a('Update', ['agent/member-detail', 'id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
//                },
//                'memberPlan' => function ($url, $model, $key) {
//                    return Html::a('Plan', ['agent/member-plan', 'id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
//                },
//                'memberPayment' => function ($url, $model, $key) {
//                    return Html::a('Payment', ['agent/member-payment', 'id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
//                },
//                'memberProduct' => function ($url, $model, $key) {
//                    return Html::a('Products', ['agent/products', 'member_id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
//                },
            ],
        ],
    ],
]); ?>

<?php Pjax::end(); ?>