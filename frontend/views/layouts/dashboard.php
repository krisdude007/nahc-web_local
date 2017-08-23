<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\NAHCAsset;
use common\widgets\Alert;

//AppAsset::register($this);
//NAHCAsset::register($this);

if(empty($this->params['leftNav'])) {
    $leftNav = [];
} else {
    $leftNav = $this->params['leftNav'];
}

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

<div class="dash-wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/img/logo.png">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-static-top',
        ],
//        'containerOptions' => [
//            'class' => 'container-fluid',
//        ],
        'innerContainerOptions' => [
//            'class' => 'container-fluid',
        ],
    ]);

    $menuItems = [];

    if(!\Yii::$app->user->isGuest) {
        $user = \Yii::$app->user->identity;

        if($user->has_member) {
            $menuItems[] = ['label' => 'Membership', 'url' => ['member/index']];
        }

        if($user->has_agent) {
            $menuItems[] = ['label' => 'Agent', 'url' => ['agent/index']];
        }

        if($user->has_provider) {
            $menuItems[] = ['label' => 'Provider', 'url' => ['provider/index']];
        }
    }

    $loginItems = [];


    if (Yii::$app->user->isGuest) {
//        $loginItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//        $loginItems[] = '<li>'.Html::a('Join Now',[ '/site/signup'], ['class' => 'btn btn-primary']).'</li>';
    } else {
//        $loginItems[] = '<li>'.Html::a('Membership',[ '/site/dashboard'], ['class' => 'btn btn-primary']).'</li>';
        $loginItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right navbar-secondary'],
//        'items' => $loginItems,
//    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-primary '],
        'items' => $menuItems,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-secondary '],
        'items' => $loginItems,
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav visible-xs'],
        'items' => $leftNav,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-3 hidden-xs">
                <div class="list-group">
                    <?php foreach($leftNav as $item) { ?>
                        <a href="<?=Url::to($item['url'])?>" class="list-group-item <?= ($this->context->action->id == $item['action']?'active':null) ?>"><?=$item['label']?></a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-sm-9">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer"  style="padding-left: 0; padding-right: 0;">
    <div class="container">
        <?=$this->render('_footer');?>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
