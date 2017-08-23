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
<body>
<?php $this->beginBody() ?>

<div class="wrap index-jumbo jumbo-home">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/img/logo-alpha.png">',
        'brandUrl' => ['site2/index'],
        'options' => [
            'class' => 'navbar-static-top navbar-index',
        ],
        'containerOptions' => [
            'class' => 'container-fluid',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid',
        ],
    ]);
    $menuItems = [
        [
            'label' => 'Who We Are',
            'items' => [
                ['label' => 'We Believe', 'url' => ['site2/believe']],
                ['label' => 'About Us', 'url' => ['site2/about']],
                ['label' => 'Contact Us', 'url' => ['site2/contact']],
            ],
        ],
        ['label' => 'Membership', 'url' => ['site2/membership']],
        ['label' => 'Products', 'url' => ['site2/products']],
        ['label' => 'Advocacy', 'url' => ['site2/advocacy']],
        ['label' => 'Tools & Resources', 'url' => ['site2/tools']],
    ];
    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Signup', 'url' => ['/site2/signup']];
//        $menuItems[] = ['label' => 'Login', 'url' => ['/site2/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site2/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right navbar-secondary'],
        'items' => [
            ['label' => 'Login', 'url' => ['/site2/login']],
            '<li>'.Html::a('Join Now',[ '/site2/signup'], ['class' => 'btn btn-primary']).'</li>',

        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-primary '],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; NAHC <?= date('Y') ?></p>

        <p class="pull-right"><?php //Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
