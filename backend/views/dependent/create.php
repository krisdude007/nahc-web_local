<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Dependent */

$this->title = 'Create Dependent';
$this->params['breadcrumbs'][] = ['label' => 'Dependents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
