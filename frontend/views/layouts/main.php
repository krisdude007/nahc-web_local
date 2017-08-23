<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
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
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'NAHC',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'We Believe', 'url' => ['site/page', 'id' => 2]],
        [
            'label' => 'Membership',
            'items' => [
                ['label' => 'Overview', 'url' => ['site/page', 'id' => 3]],
                ['label' => 'Bronze', 'url' => ['site/page', 'id' => 7]],
                ['label' => 'Silver', 'url' => ['site/page', 'id' => 8]],
                ['label' => 'Gold', 'url' => ['site/page', 'id' => 9]],
            ],
        ],
        [
            'label' => 'Insurance Products',
            'items' => [
                ['label' => 'Overview', 'url' => ['site/page', 'id' => 4]],
                ['label' => 'Accident Insurance', 'url' => ['site/page', 'id' => 10]],
                ['label' => 'Critical Illness Insurance', 'url' => ['site/page', 'id' => 11]],
                ['label' => 'Vision Insurance', 'url' => ['site/page', 'id' => 12]],
                ['label' => 'Dental Insurance', 'url' => ['site/page', 'id' => 13]],
                ['label' => 'Prescription Coverage', 'url' => ['site/page', 'id' => 14]],
                ['label' => 'Travel Assist', 'url' => ['site/page', 'id' => 15]],
            ],
        ],
        [
            'label' => 'Tools & Resources',
//            'url' => ['site/page', 'id' => 16],
            'items' => [
                ['label' => 'Overview', 'url' => ['site/page', 'id' => 16]],
                ['label' => 'Compare Doctor Costs', 'url' => ['site/page', 'id' => 17]],
                ['label' => 'Compare Hospital Costs', 'url' => ['site/page', 'id' => 18]],
                ['label' => 'Doctor & Hospital Quality', 'url' => ['site/page', 'id' => 19]],
                ['label' => 'Procedures & Diagnosis', 'url' => ['site/page', 'id' => 20]],
            ],
        ],
//        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'About', 'url' => ['site/page', 'id' => 5]],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
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
