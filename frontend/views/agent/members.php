<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $searchModel common\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
//$this->params['breadcrumbs'][] = $this->title;

$this->render('_leftnav');

?>

<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_member_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Enroll Member', ['agent/enroll'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
//            'agent_id',
//            'group_id',
//            'ext_id',
             'f_name',
             'l_name',
            // 'm_name',
            // 'dob',
            // 'gender',
//             'address',
            // 'address2',
             'city',
             'state.two_letter:text:State',
             'zip',
//             'email:email',
//             'phone',
            // 'ssn',
//             'status',
            // 'created_at',
//             'updated_at:date',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{member} {memberDetail} {memberPlan} {memberPayment} {memberProduct}',
                'buttons' => [
                    'member' => function ($url, $model, $key) {
                        return Html::a('Detail', ['agent/member', 'id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
                    },
                    'memberDetail' => function ($url, $model, $key) {
                        return Html::a('Update', ['agent/member-detail', 'id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
                    },
                    'memberPlan' => function ($url, $model, $key) {
                        return Html::a('Plan', ['agent/member-plan', 'id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
                    },
                    'memberPayment' => function ($url, $model, $key) {
                        return Html::a('Payment', ['agent/member-payment', 'id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
                    },
                    'memberProduct' => function ($url, $model, $key) {
                        return Html::a('Products', ['agent/products', 'member_id'=>$model->id], ['class' => 'btn btn-xs btn-link']);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>