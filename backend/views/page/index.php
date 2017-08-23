<?php

use yii\helpers\BaseStringHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
//            'content:ntext',
//            'html:ntext',
            [
                'format' => 'ntext',
                'label' => 'Content',
                'value' => function ($dataProvider) {
                    $url = $dataProvider->content;
                    return BaseStringHelper::truncateWords($url,10,'...',false);
                },
            ],
            [
                'format' => 'ntext',
                'label' => 'Html',
                'value' => function ($dataProvider) {
                    $url = $dataProvider->html;
                    return BaseStringHelper::truncateWords($url,10,'...',false);
                },
            ],
            'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
