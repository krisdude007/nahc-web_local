<?php

/* @var $this yii\web\View */
/* @var $benefits common\models\MembershipBenefit[] */

use kartik\icons\Icon;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'NAHC';
Icon::map($this, Icon::FA);
Icon::map($this, Icon::ICF);

$js = <<< SCRIPT
// To initialize BS3 tooltips set this below //
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});;
// To initialize BS3 popovers set this below //
$(function () {
    $("[data-toggle='popover']").popover();
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);

?>
<div class="site-index">

    <div class="jumbotron">
        <div class="box">
            <h1>We've pulled back the curtain on the healthcare industry. Never overpay for healthcare services again.</h1>

            <p class="lead hidden-xs">We're a healthcare consumer advocacy association dedicated to helping our members find the best healthcare solutions, with the highest possible doctor and hospital ratings, all delivered at the best possible pricing by your own, personal healthcare consultant.</p>
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
                    <div class="col-sm-4 col-pad">
                        <h3>Shop For Healthcare Services Like You Do Anything Else</h3>
                    </div>
                    <div class="col-sm-4 col-pad" >
                        <h3>Doctor and Facility Ratings / Reviews Nationwide</h3>
                    </div>
                    <div class="col-sm-4 col-pad" >
                        <h3>Personal Healthcare Consulting Services Only A Call Away</h3>
                    </div>
                </div>



                <div class="row narrow-row hidden-xs">
                    <div class="col-sm-4 col-pad" style="text-align: justify;">
                        <p>Shopping online for TV's, cars and clothing is second nature these days. Wouldn't it be great if you could do the same to find the best possible healthcare services? Now you can with our simple to use memberships.</p>
                    </div>
                    <div class="col-sm-4 col-pad" style="text-align: justify;">
                        <p>Your NAHC Membership provides access to reviews, reports, doctor ratings and so much more which will ensure you’re able to engage the nation’s top rated and most reputable healthcare providers.</p>
                    </div>
                    <div class="col-sm-4 col-pad" style="text-align: justify;">
                        <p>With NAHC, you now have your own healthcare concierge Advocate who will collaborate with you, one-on-one, to make sure your best interests are always protected. And in healthcare, that is huge!</p>
                    </div>
                </div>

                <div class="row visible-xs">
                    <div class="col-sm-4">
                        <h3>Shop For Healthcare Services Like You Do Anything Else</h3>
                        <p>Shopping online for TV's, cars and clothing is second nature these days. Wouldn't it be great if you could do the same to find the best possible healthcare services? Now you can with our simple to use memberships.</p><br>
                    </div>
                    <div class="col-sm-4">
                        <h3>Doctor and Facility Ratings / Reviews Nationwide</h3>
                        <p>Your NAHC Membership provides access to reviews, reports, doctor ratings and so much more which will ensure you’re able to engage the nation’s top rated and most reputable healthcare providers.</p><br>
                    </div>
                    <div class="col-sm-4">
                        <h3>Personal Healthcare Consulting Services Only A Call Away</h3>
                        <p>With NAHC, you now have your own healthcare concierge Advocate who will collaborate with you, one-on-one, to make sure your best interests are always protected. And in healthcare, that is huge!</p><br>
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

            <h1>You already comparison shop for clothing, TV's and other life necessities...why not healthcare?</h1>
            <p class="lead">Our world has changed, and we've introduced the most comprehensive method for locating, comparing and learning about the best possible healthcare services at the best possible prices around. All in one place with an affordable membership!</p>


            <!--<p class="lead"><a class="btn btn-lg btn-success" href="<?=Url::to(['site/membership']);?>">Join Now</a></p>-->
        </div>

        <div class="row content-row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <h1>Just imagine access to tools like this...</h1>

                <p class="lead">You can now search in your area for medical services by price and doctor quality ratings. Even each facility receives documented ratings that are held to the highest standards. Our database is second to none and completely accurate.<br>
                    ​
                    And this is just one of many tools you'll have at your disposal.</p>
                <img src="/img/index-tools.jpg" class="img-responsive">

            </div>
        </div>


        <div class="row nahc-bg-gr-dk">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <h1>Memberships that deliver big time.</h1>
                <p class="lead">A membership to anything is only as good as the benefits it offers. Make no mistake, with NAHC, you'll now have access to premium services in healthcare unlike anything you have seen before, and a personal advocate assisting you with it all!</p>
            </div>
        </div>



        <div class="row narrow-row nahc-bg-gr-dk">
            <div class="col-sm-12 col-lg-10 col-lg-offset-1">
                <div class="row flex-row icon-index">


                    <?php echo $this->render('_membership_row', ['level' => $level, 'memberships' => $memberships])

                    //foreach($benefits as $benefit) {

                    //<a href="/membership#mem<?=$benefit->id? >" class="col-xs-4 text-left btn" data-toggle="tooltip" title="<?$benefit->description? >">


                    //                                <img src="/img/icon/<$benefit->icon? >.png">

                    //                              <div class="h4"><?=$benefit->name? ></div>
                    //

                    //</a>

                    //}

                    ?>
                </div>
            </div>
        </div>

        <div class="row spacer-row-lg nahc-bg-gr-dk">
            <div class="col-12-sm">
                &nbsp;
            </div>
        </div>

        <div class="jumbotron jumbo-row index-banner-2" style="">
            <div class="box">
                <h1>Finally, a place to save on all your out-of-pocket expenses with powerful products.</h1>
                    <p class="lead" style="color: white;">Say goodbye to the days of the "pricing cram down" from providers. Get the most experienced doctors at the lowest prices. Dentists, Optometrists, Surgeons, Therapists...our memberships cover every possible healthcare need you could ever need.</p>
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

        <div class="row spacer-row">
            <div class="col-12-sm">
                &nbsp;
            </div>
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





        <div class="jumbotron jumbo-row index-cta" style="height: auto;">
            <h1>Your new single source for every healthcare need you face, with support from your own consultant!</h1><br>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site/membership']);?>">Join Now</a></p>
        </div>
    </div>

</div>
