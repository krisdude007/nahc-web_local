<?php

use common\models\ProductOption;
use common\models\State;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $member common\models\Member */
/* @var $products common\models\Product */

$this->title = 'Products';

$is_member = !empty($member);

$memberProducts = [];
if($is_member) {
    $memberProducts = $member->getProducts()->select('id')->asArray()->column();
}
?>

<div class="site-products">

    <div class="jumbotron jumbo-top jumbo-products">
        <h1>Shop for healthcare just like you do for other of life’s necessities</h1>
    </div>

    <div class="body-content">
        <div class="row caption-row">
            <div class="col-sm-8 col-sm-offset-2">
                <h2>Your NAHC Membership provides tools and resources to compare costs, evaluate quality, and find the best care at the best price.</h2>
            </div>
        </div>
    <?php if(!$is_member) { ?>
        <div class="well">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8">
                <p class="lead text-center">NAHC insurance products are offered on a state-by-state basis.  Select your state to find out which products we offer members in your area!</p>

            </div>
            <div class="col-sm-6 col-sm-offset-3 col-md-offset-0 col-md-4 col-lg-4">
<!--                <div class="row">-->
                    <?php $form = ActiveForm::begin();?>
<!--                    <div class="col-sm-12 col-md-12 col-lg-4 col-lg-offset-4">-->
                        <div class="form-group">
                            <?= $form->field($model, 'state_id')->dropDownList(State::getStateList(), ['prompt' => 'Select your state', 'class' => 'form-control'])->label(false); ?>
                        </div>
<!--                    </div>-->
<!--                    <div class="col-sm-12 col-md-12 col-lg-4 col-lg-offset-4">-->
                        <div class="form-group">
                            <?= Html::submitButton('See Products', ['class' => 'btn btn-primary btn-block']) ?>
                        </div>
<!--                    </div>-->
                    <?php ActiveForm::end(); ?>
<!--                </div>-->
            </div>
        </div>
        </div>
    <?php ; } ?>

        <div class="row content-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>NAHC Insurance Products</h1>
                <p class="lead">Designed to both save money and deliver peace of mind, these insurance products are available exclusively to NAHC members. <span style="font-size: 14px;">(Catlin Insurance Company, Inc.’s accident insurance products are not available to Utah residents.)</span></p>
            </div>
        </div>

        <?php
        $i = 0;
        $prodBtn = '';

        foreach($products as $product) {

            if($is_member) {
                if(in_array($product->id, $memberProducts))
                    $prodBtn = Html::a('View Benefit', ['member/index','#'=>'prod'], ['class' => 'btn btn-primary']);
                else
                    $prodBtn = Html::a('Buy Now!', ['member/purchase', 'product_id' => $product->id], ['class' => 'btn btn-primary']);
            } else {
                $prodBtn = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buyModal"> Buy Now! </button>';
            }

//            echo '<hr>'.PHP_EOL;
            echo '<a id="prod'.$product->id.'"></a>'; ?>


                <div class="row text-left content-row">
                <?php if ($i % 2 == 0) { ?>
                    <div class="hidden-sm col-md-3 col-lg-3 col-lg-offset-1">
                        <img src="/img/icon/<?=$product->icon?>.png" width="100%">
                    </div>
                <?php } ?>
                    <div class="col-sm-12 col-md-9 col-lg-7 <?=($i%2==1?'col-lg-offset-1':'')?>">
                        <h1><?= $product->name ?> (<?=$product->short_name?>)</h1>
                        <p class="lead"><?= $product->description ?></p>
                        <div class="row">
                            <div class="col-sm-7">
                                <dl>
                                <dt>Benefits</dt>
                                <?=implode(PHP_EOL, array_map( function ($b) { return '<dd>'.$b.'</dd>';}, explode('::', $product->benefits)));?>
                                </dl>
                            </div>
                            <div class="col-sm-5">
                                <dl>
                                    <dt>FAQs</dt>
                                    <dd><a href="#prod<?=$product->id?>" data-toggle="modal" data-target="#prodmod<?=$product->id?>" data-section="prod<?=$product->id?>faq1">What is <?=$product->short_name?>?</a></dd>
                                    <dd><a href="#prod<?=$product->id?>" data-toggle="modal" data-target="#prodmod<?=$product->id?>" data-section="prod<?=$product->id?>faq2">Who Needs <?=$product->short_name?>?</a></dd>
                                    <dd><a href="#prod<?=$product->id?>" data-toggle="modal" data-target="#prodmod<?=$product->id?>" data-section="prod<?=$product->id?>faq3">Who Doesn’t Need <?=$product->short_name?>?</a></dd>
                                    <dd><a href="#prod<?=$product->id?>" data-toggle="modal" data-target="#prodmod<?=$product->id?>" data-section="prod<?=$product->id?>faq4">What Is Included?</a></dd>
                                    <dd><a href="#prod<?=$product->id?>" data-toggle="modal" data-target="#prodmod<?=$product->id?>" data-section="prod<?=$product->id?>faq5">What is Excluded?</a></dd>
                                </dl>
                            </div>
                        </div>
                        <a href="#prod<?=$product->id?>" data-toggle="modal" data-target="#prodmod<?=$product->id?>" data-section="prod<?=$product->id?>faq1" class="btn btn-default">More Details</a>&nbsp;&nbsp;
                        <?=$prodBtn?>
                    </div>
                <?php if ($i % 2 == 1) { ?>
                    <div class="hidden-sm col-md-3 col-lg-3">
                        <img src="/img/icon/<?=$product->icon?>.png" width="100%">
                    </div>
                <?php } ?>
                </div>
            <div class="row content-row">
                &nbsp;
            </div>
<?php   Modal::begin([
             'header'=>"<h2 class=\"modal-title\">$product->name</h2>",
             'id' => 'prodmod'.$product->id,
             'size' => Modal::SIZE_LARGE,
             'options' => ['class' => 'faq-modal',],
             'clientEvents' => [
                     'shown.bs.modal' => "function(event) {
                          // reset the scroll to top
//                          $('#prod{$product->id} .modal-body').scrollTop(0);
                          // get the section using data
                          var section = $(event.relatedTarget).data('section');
//                          console.log(section);
                          // get the top of the section
//                          var sectionOffset = $('#' + section).offset();
//                          console.log(sectionOffset);
                          //scroll the container
                          //$('#prod{$product->id} .modal-body').animate({scrollTop: sectionOffset.top - 30}, \"slow\");
                          var position = $('#' + section).position();
                          $('#prod{$product->id}').animate({scrollTop: position.top - 35}, \"slow\");
                      }",
             ],
             'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'.$prodBtn,
         ]); ?>

        <div id='modalContent'>
            <h3>Pricing</h3>
            <table class="table">
                <thead>
                    <th>Coverage</th>
                    <th>Member</th>
                    <th>Family</th>
                </thead>
                <tbody>
                    <?php foreach($product->productOptions as $option) { ?>
                        <tr>
                            <td><?=$option->coverage_level?></td>
                            <td><?=($option->coverage_type == ProductOption::COVERAGE_INDIVIDUAL?$option->priceText:'')?></td>
                            <td><?=($option->coverage_type == ProductOption::COVERAGE_INDIVIDUAL?'':$option->priceText)?></td>
                        </tr>

                <?php } ?>
                </tbody>
            </table>
            <?php foreach($product->productFaqs as $faq) {
                if(!empty($faq->content)) { ?>
                    <a id="prod<?=$product->id.'faq'.$faq->num?>"></a>
                    <h3><?=$faq->faqLabel[$faq->num]['prompt'].($faq->faqLabel[$faq->num]['label']?($product->short_name.'?'):'')?></h3>
                    <p><?=$faq->content?></p>
        <?php   }
            }?>
        </div>
<?php   Modal::end();


            $i++;
        }?>

        <?php if(empty($products)): ?>
        <div class="row content-row">
            <div class="col-sm-12">
                <h1>Coming Soon!</h1>
                <p class="lead">We don't have any products for you in <?=empty($state)?'your state':$state->name?> yet, but you can still join NAHC!  We are bringing the benefits of NAHC products to new states as fast as we can. Become a member today, and we'll let you know when NAHC insurance products are offered in <?=empty($state)?'your state':$state->name?>.</p>
            </div>
        </div>
            <div class="row content-row">
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xs-offset-6 col-sm-offset-3 col-md-offset-4 col-lg-offset-4">
                    <?=Html::a('Join Now!', ['site/membership'], ['class' => 'btn btn-primary btn-lg btn-block'])?>
                </div>
            </div>
        <?php else: ?>

        <?=$this->render('_cta_row');?>

        <?php endif;?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="buyModalLabel">Oops!</h4>
            </div>
            <div class="modal-body">
                <p>NAHC Insurance Products are available to our members only!</p>
                <p>If you are an NAHC member, please sign in first.</p>
                <p>Or, to get access to great NAHC products, join NAHC today!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?=Html::a('Log In', ['site/login'], ['class' => 'btn btn-primary']);?>
                <?=Html::a('Join Now!', ['site/join'], ['class' => 'btn btn-success']);?>
            </div>
        </div>
    </div>
</div>