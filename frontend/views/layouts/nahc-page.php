<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\NAHCAsset;
use common\widgets\Alert;

//AppAsset::register($this);
//NAHCAsset::register($this);

// TODO: REPLACE!!
$memprod = \Yii::$app->session->get('memprod');

$memList = ArrayHelper::getValue($memprod, 'mem', null);
$prodList = ArrayHelper::getValue($memprod, 'prod', null);
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

<div class="page-wrap">
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
            'class' => 'container-fluid',
        ],
    ]);
    $menuItems = [
        [
            'label' => 'Who We Are',
            'items' => [
                ['label' => 'We Believe', 'url' => ['site/believe']],
                ['label' => 'About Us', 'url' => ['site/about']],
                ['label' => 'Contact Us', 'url' => ['site/contact']],
            ],
        ],
        ['label' => 'Membership', 'url' => ['site/membership'],
            'items' => $memList,],
        ['label' => 'Products', 'url' => ['site/products'],
            'items' => $prodList,],
        ['label' => 'Tools & Resources', 'url' => ['site/tools']],
        ['label' => 'Agents', 'url' => ['site/agents']],

    ];
    $actionList = [];

    if (Yii::$app->user->isGuest) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right navbar-secondary hidden-xs'],
            'items' => [
                '<li>'.Html::a('Login',['site/login'], ['class' => 'btn btn-link']).'</li>',
                '<li>'.Html::a('Join Now',[ '/site/join'], ['class' => 'btn btn-primary']).'</li>',
            ],
        ]);

        $actionList[] = ['label' => 'Login', 'url' => ['site/login']];
        $actionList[] = ['label' => 'Join Now', 'url' => ['site/join']];
    } else {
        if(Yii::$app->user->identity->has_agent) {
            $action = ['label' => 'Agent Dashboard', 'uri' => Url::to(['agent/index'])];
            $actionList[] = ['label' => 'Agent Dashboard', 'url' => ['agent/index']];
        }
        else if(Yii::$app->user->identity->has_member) {
            $action = ['label' => 'Benefits', 'uri' => Url::to(['member/index'])];
            $actionList[] = ['label' => 'Benefits', 'url' => ['member/index']];
        } else {
            $action = ['label' => 'Join Now', 'uri' => Url::to(['site/join'])];
            $actionList[] = ['label' => 'Join Now', 'url' => ['site/join']];
        }


        $actionBtn = Html::beginForm(['/site/logout'], 'post').'<div class="btn-group">
        <a class="btn btn-primary" href="'.$action['uri'].'">'.$action['label'].'</a>
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">';

        if(Yii::$app->user->identity->has_agent || Yii::$app->user->identity->has_provider)
        {

            if(Yii::$app->user->identity->has_member) {
                $actionBtn .= '<li><a href="'.Url::to(['member/index']).'">Benefits</a></li>'.PHP_EOL;
                $actionList[] = ['label' => 'Benefits', 'url' => ['member/index']];
            }

            if(Yii::$app->user->identity->has_provider) {
                $actionBtn .= '<li><a href="'.Url::to(['provider/index']).'">Provider Tools</a></li>'.PHP_EOL;
                $actionList[] = ['label' => 'Provider Tools', 'url' => ['provider/index']];
            }

            if(Yii::$app->user->identity->has_member|| Yii::$app->user->identity->has_provider)
                $actionBtn .= '<li role="separator" class="divider"></li>';
        }


        $actionBtn .= '<li>'.Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']).'</li></ul></div>'.Html::endForm();

        $actionList[] = Html::beginForm(['/site/logout'], 'post').'<li>'.Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']).'</li></ul>'.Html::endForm();

//        else
//        {
//            $actionBtn = Html::a('Benefits',['member/index'], ['class' => 'btn btn-primary']);
//        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right navbar-secondary hidden-xs'],
            'items' => [$actionBtn],
        ]);

    }




    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-primary '],
        'items' => $menuItems,
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right navbar-secondary visible-xs'],
        'items' => $actionList,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php // Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <?=$this->render('_footer', ['memList' => $memList, 'prodList' => $prodList]);?>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
