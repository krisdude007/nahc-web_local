<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\NAHCAsset;
use common\widgets\Alert;

//AppAsset::register($this);
//NAHCAsset::register($this);
\yii\bootstrap\BootstrapAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="login-html">
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
    <body class="login-body">
<?php $this->beginBody() ?>

    <div class="container-fluid">
        <div class="row" style="margin-left:0; margin-right:0;">
            <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 login-col">
                <div class="site-login">
                    <div class="login-logo">
                        <a href="/"><img src="/img/logo-alpha.png" class="img-responsive center-block"></a>
                    </div>
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>


<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

