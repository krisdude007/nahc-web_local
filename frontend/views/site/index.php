<?php

/* @var $this yii\web\View */
/* @var $benefits common\models\MembershipBenefit[] */

use kartik\icons\Icon;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'NAHC';
Icon::map($this, Icon::FA);
Icon::map($this, Icon::ICF);
?>
<div class="site-index">

    <div class="jumbotron">
        <div class="box">
            <h1>Never overpay for healthcare again</h1>

            <p class="lead hidden-xs">We are a non-profit healthcare consumer advocacy association dedicated to helping our members find the best healthcare solutions</p>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site/believe']);?>">Learn More</a></p>
        </div>
    </div>

    <div class="body-content">
        <?php if(!empty($agent)) { ?>

            <div class="row content-row nahc-bg-gr-lt">
                <div class="col-sm-12">
                    <div class="row narrow-row nahc-bg-gr-lt">
                        <div class="col-sm-10 col-sm-offset-1 text-left">
                            <h3>Your NAHC Agent</h3>
                        </div>
                    </div>
                    <div class="row narrow-row nahc-bg-gr-lt">
                        <?php if($agent->has_img) { ?>
                            <div class="col-sm-2 col-sm-offset-1 text-right"><img src="/img/agents/<?=$agent->ext_id?>.jpg" class="img-circle" style="max-height: 100px;"></div>
                        <?php } ?>
                        <div class="<?=($agent->has_img?'col-sm-8':'col-sm-10 col-sm-offset-1')?> text-left">
                            <h4><?=$agent->nameText?></h4>
                            <div class="row narrow-row">
                                <div class="col-sm-5">
                                    <a href="http://maps.google.com/?q=<?=$agent->address.', '.$agent->city.', '.$agent->stateText.' '.$agent->zip?>">
                                        <address>
                                            <?=$agent->address?><br>
                                            <?=(empty($agent->address2)?'':$agent->address2.'<br>')?>
                                            <?=$agent->city?>,&nbsp;<?=$agent->stateText?>&nbsp;<?=$agent->zip?>
                                        </address>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <p><?=Html::a($agent->phoneText,'tel:+1'.$agent->phone)?><br>
                                        <?=Html::a($agent->email, 'mailto:'.$agent->email)?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>

        <div class="row content-row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row hidden-xs">
                    <div class="col-sm-4">
                        <h2>Plan & Pricing Transparency</h2>
                    </div>
                    <div class="col-sm-4">
                        <h2>Doctor & Hospital Quality</h2>
                    </div>
                    <div class="col-sm-4">
                        <h2>Personal Healthcare Advocacy</h2>
                    </div>
                </div>



                <div class="row narrow-row hidden-xs">
                    <div class="col-sm-4" style="text-align: justify">
                        <p>Our NAHC Network helps identify the highest-quality, most affordable plans and options – we help find the coverage that’s best suited to you and your family’s individual needs.</p>
                    </div>
                    <div class="col-sm-4" style="text-align: justify">
                        <p>Your NAHC Membership provides access to reviews, reports and other critical data that ensures you’re able to engage the nation’s top rated and most reputable healthcare providers.</p>
                    </div>
                    <div class="col-sm-4" style="text-align: justify">
                        <p>Your personal NAHC Advocate will collaborate with you, one-on-one, to make sure your best interests are always protected, first and foremost, in all your healthcare matters.</p>
                    </div>
                </div>

                <div class="row visible-xs">
                    <div class="col-sm-4">
                        <h2>Plan & Pricing Transparency</h2>
                        <p>Our NAHC Network helps identify the highest-quality, most affordable plans and options – we help find the coverage that’s best suited to you and your family’s individual needs.</p><br>
                    </div>
                    <div class="col-sm-4">
                        <h2>Doctor & Hospital Quality</h2>
                        <p>Your NAHC Membership provides access to reviews, reports and other critical data that ensures you’re able to engage the nation’s top rated and most reputable healthcare providers.</p><br>
                    </div>
                    <div class="col-sm-4">
                        <h2>Personal Healthcare Advocacy</h2>
                        <p>Your personal NAHC Advocate will collaborate with you, one-on-one, to make sure your best interests are always protected, first and foremost, in all your healthcare matters.</p><br>
                    </div>

                    <?php /*
                    <div class="col-sm-4">
                        <h2>Save Money on Out of Pocket Healthcare Expenses</h2>

                        <p>Our NAHC Network helps identify the highest-quality, most affordable plans and options – we help find the coverage that’s best suited to you and your family’s individual needs.</p>

                        <a class="btn btn-default" href="<?=Url::to(['site/membership']);?>">Memberships &raquo;</a>
                    </div>
                    <div class="col-sm-4">
                        <h2>Comparison Shopping For Quality & Price</h2>

                        <p>Your NAHC Membership provides access to reviews, reports and other critical data that ensures you’re able to engage the nation’s top rated and most reputable healthcare providers.</p>

                        <a class="btn btn-default" href="<?=Url::to(['site/products']);?>">Products &raquo;</a>
                    </div>
                    <div class="col-sm-4">
                        <h2>Personal advocate and consultant to assist you</h2>

                        <p>Your personal NAHC Advocate will collaborate with you, one-on-one, to make sure your best interests are always protected, first and foremost, in all your healthcare matters.</p>

                        <a class="btn btn-default" href="<?=Url::to(['site/tools']);?>">Tools &raquo;</a>
                    </div> */
                    ?>
                </div>
            </div>
        </div>

        <div class="jumbotron jumbo-row index-banner-1" style="">

            <h1><span style="white-space:nowrap">Reduce your costs.</span>  <span style="white-space:nowrap">Increase your options.</span></h1>


            <!--<p class="lead"><a class="btn btn-lg btn-success" href="<?=Url::to(['site/membership']);?>">Join Now</a></p>-->
        </div>

<!--        <div class="row">-->
<!--            <div class="col-sm-12 col-md-10 col-md-offset-1">-->
<!--                --><?php ////$this->render('_benefit_row', ['benefits' => $benefits])?>
<!--                <br>-->
<!--                <a href="--><?php ////Url::to(['site/membership']);?><!--" class="btn btn-primary btn-lg">Join Now</a>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div class="jumbotron jumbo-row" style="background-image: url('/img/index-banner-1.jpg');">-->
<!--            <h1>Choose a plan tailored to your needs.</h1>-->
<!--        </div>-->

        <div class="row">
            <div class="col-sm-12">
                <h1>Our memberships deliver great results</h1>
                <p class="lead">NAHC offers a variety of membership benefits and plans designed to fit any family at any budget!</p>
            </div>
        </div>

        <div class="row narrow-row">
            <div class="col-sm-12 col-lg-10 col-lg-offset-1">
                <div class="row flex-row icon-index">


                <?php //$this->render('_membership_row', ['level' => $level, 'memberships' => $memberships, 'active' => false])

                foreach($benefits as $benefit) { ?>

                    <a href="/membership#mem<?=$benefit->id?>" class="col-xs-4 text-left btn">


                                <img src="/img/icon/<?=$benefit->icon?>.png">

                                <div class="h4"><?=$benefit->name?></div>


                    </a>

                <?php }

                ?>
                </div>
            </div>
        </div>


        <div class="row content-row">
            <div class="col-sm-6 col-md-4 col-lg-4 col-sm-offset-3 col-md-offset-4 col-lg-offset-4 hidden-xs">
                <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->has_member) {?>
                    <a href="<?= Url::to(['member/index']) ?>" class="btn btn-info btn-lg btn-block">My Benefits</a>
                <?php } else{ ?>
                    <a href="<?= Url::to(['site/membership', '#' => 'plans']) ?>" class="btn btn-primary btn-lg btn-block">Join Now!</a>
                <?php } ?>
            </div>
        </div>



        <div class="jumbotron jumbo-row index-banner-2" style="">
            <div class="box">
                <h1>Peace of mind with the protection you need<br><small style="color: white;">When you become an NAHC member, you will have a full array of healthcare protection and services you can count on</small></h1>
            </div>
        </div>

        <div class="row narrow-row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="row flex-row icon-index">
<?php           foreach($products as $product) {
                    $iconSet = [];

                    preg_match('/^([a-zA-Z]+)-([a-zA-Z-]+)/', $product->icon, $iconSet);

//                    Yii::info('Got iconset: '.$product->icon.' / '.print_r($iconSet, true));

    ?>
            <a href="/products#prod<?=$product->id?>" class="col-xs-4 text-left btn">

                <img src="/img/icon/<?=$product->icon?>.png">
                <div class="h4"><?=$product->name?></div>
            </a>



<!--                            <img src="/img/icon/" width="100%" style="margin-bottom: 5px; max-width: 50px; padding-left: 5px; padding-right: 5px;">-->
<!--                            <br class="hidden-xs hidden-sm">-->


<?php           }  ?>
                </div>


            </div>
        </div>
        <div class="row content-row">
            <div class="col-sm-12">
                <br>
                <a href="<?=Url::to(['site/products']);?>" class="btn btn-primary btn-lg">Learn More</a>
            </div>
        </div>

        <div class="jumbotron jumbo-row index-cta" style="height: auto;">
            <h1>Our Goal Is Helping You Find The Best Healthcare Solutions</h1><br>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site/membership']);?>">Join Now</a></p>
        </div>
    </div>

</div>
