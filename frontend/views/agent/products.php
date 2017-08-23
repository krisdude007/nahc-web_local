<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $searchModel common\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Add Products';
//$this->params['breadcrumbs'][] = $this->title;

$this->render('_leftnav');

?>

<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Select a member to add an insurance product to their membership.</p>
    <?php //echo $this->render('_member_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
//            'agent_id',
//            'group_id',
            'ext_id',
            'f_name',
            'l_name',
            // 'm_name',
            // 'dob',
            // 'gender',
//            'address',
            // 'address2',
            'city',
            'state',
            'zip',
            'email:email',
            'phone',
            // 'ssn',
//             'status',
            // 'created_at',
//             'updated_at:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>