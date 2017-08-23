<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\NAHCAsset;
use common\widgets\Alert;

AppAsset::register($this);
//NAHCAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/css/fonts/gotham/stylesheet.css" rel="stylesheet">
    <link href="/css/nahc.css" rel="stylesheet">
</head>
<body class="modal-bg">
<?php $this->beginBody() ?>

<div class="modal-wrap">
   <img src="/img/logo-alpha.png">

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; NAHC --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?php ////Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
