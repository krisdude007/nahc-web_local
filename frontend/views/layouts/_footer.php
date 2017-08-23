<?php
use yii\helpers\Html;
?>


    <div class="row">
        <div class="col-sm-3 col-md-3 text-center">
            <img src="/img/logo-bw.png" class="img-responsive center-block">
            <div class="legal-block">&copy; NAHC <?= date('Y') ?><br>
                <?=Html::a('Legal', ['site/legal'])?>&nbsp;|&nbsp;<?=Html::a('Privacy', ['site/legal', 'doc' => 'privacy'])?>&nbsp;|&nbsp;<?=Html::a('Terms', ['site/legal', 'doc' => 'terms'])?>
            </div>
        </div>
        <div class="col-sm-9 col-md-8 col-md-offset-1">
            <div class="row" style="margin-left: 0; margin-right: 0;">
                <div class="col-sm-4">
                    <h1>Membership</h1>
                    <?php if(!empty($memList)) {
                        foreach ($memList as $mem) {
                            echo Html::a($mem['label'], $mem['url']) . '<br>' . PHP_EOL;
                        }
                    } else {
                        echo Html::a('All Memberships', ['site/membership']) . '<br>' . PHP_EOL;
                    }?>
                </div>
                <div class="col-sm-5">
                    <h1>Products</h1>
                    <?php if(!empty($prodList)) {
                        foreach($prodList as $prod) {
                            echo Html::a($prod['label'], $prod['url']).'<br>'.PHP_EOL;
                        }
                    } else {
                        echo Html::a('All Products', ['site/products']) . '<br>' . PHP_EOL;
                    }?>
                </div>
                <div class="col-sm-3">
                    <h1>About</h1>
                    <?=Html::a('About NAHC',['site/about'])?><br>
                    <?=Html::a('We Believe',['site/believe'])?><br>
                    <?=Html::a('Tools & Resources',['site/tools'])?><br>
                    <?=Html::a('Contact Us',['site/contact'])?><br>
                    <?=Html::a('Agents',['site/agents'])?><br>
                </div>
            </div>
        </div>
    </div>

