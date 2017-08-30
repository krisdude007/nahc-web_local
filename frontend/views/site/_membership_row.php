<?php
/* @var $level integer */

use kartik\popover\PopoverX;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $memberships \common\models\Membership[] */

$js = <<< 'SCRIPT'
/* To initialize BS3 tooltips set this below */
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});;
/* To initialize BS3 popovers set this below */
$(function () { 
    $("[data-toggle='popover']").popover(); 
});

SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);

$colors = ['m','g','b','o'];

?>


<!--<div class="row">-->
<!--    <div class="col-sm-12 col-md-12 col-lg-12">-->
        <div class="row is-table-row membership-row">
<?php
$c = 0;
$memAr = [];
foreach ($memberships as $membership)
        {
            $memAr[$membership->level] = $membership;

            ?>
            <div id="memcol<?=$membership->level?>" class="col-sm-3 membership-col nahc-bg-<?=$colors[$c]?>-dk">
                <a id="plan<?=$membership->id?>" name="plan<?=$membership->id?>"></a>
                <div class="row nahc-bg-<?=$colors[$c]?>-base" style="padding-bottom: 5px;">
                    <div class="col-sm-12">
                        <h3><?=$membership->name?></h3>
                    </div>
                </div>

                <div class="row text-row">
                    <div class="col-sm-12">
                        <h3><?=$membership->priceText ?></h3><h4 style="font-weight: 200;"><?=$membership->description?></h4>
                        <hr>
                        <span><dl><dt>Includes</dt>
                                <?php  if($membership->level > 1) { ?>
                                    <dd>The <?=$memAr[($membership->level - 1)]->name?> Plan PLUS:</dd>
                                <?php    }

                                foreach($membership->benefits as $benefit) {

                                    if($benefit->minimumMembershipLevel == $membership->level) { ?>
                                        <dd><a id="mem<?=$membership->level?>btn<?=$benefit->id?>" href="<?=Url::to(['site/membership', '#' => "mem{$benefit->id}"])?>" data-toggle="tooltip" title="<?=$benefit->description?>"><?=$benefit->name?></a></dd>
                                <?php    }
                                }?></dl></span>
                    </div>
                </div>


                <div class="row flex-row">
<?php
// data-toggle="tooltip" data-placement="top"
foreach($membership->benefits as $benefit)
            {
                //$highlight = ($benefit->minimumMembershipLevel == $membership->level)?'nahc-highlight-'.$colors[$c]:'';


                 //   <a id="mem<?=$membership->level? >btn<?=$benefit->id? >" role="button" tabindex="0"  data-container="memcol<?=$membership->level? >" data-toggle="popover-x" data-target="#mem<?=$membership->level? >po<?=$benefit->id? >"  <?php //href="/membership#mem<?=$benefit->id>"? > title="<?=$benefit->name? >" class="opt-block nahc-bg-<?=$colors[$c]? >-dk col-xs-12 col-sm-3 col-md-3 col-lg-3 <?=$highlight? >" >

                         //<img src="/img/icon/<?=$benefit->icon? >-white.png">
                        //<br class="hidden-lg hidden-xs">
                         //<div style="display: none;"><?=$benefit->name </div>? >
                    //</a> ?>

<?php echo PopoverX::widget([
                'id' => "mem{$membership->level}po{$benefit->id}",
                'header' => $benefit->long_name,
                'placement' => PopoverX::ALIGN_AUTO,
                'content' => $benefit->description,
                'footer' => Html::a('Learn More...', ['site/membership', '#' => "mem{$benefit->id}"], ['class'=>'btn btn-sm btn-primary', 'onclick' => "window.href = '#mem{$benefit->id}';$('#mem{$membership->level}po{$benefit->id}').popoverX('hide');"]),
                'toggleButton' => ['label'=>'Right', 'class'=>'btn btn-default hidden'],
                //'options' => ['data-target' => "mem{$membership->level}btn{$benefit->id}"]
            ]);
            } ?>
                </div>
                <?php
//                if(!isset($active) || $active == true) {
                    if (0 < $level && $level < $membership->level) { ?>
                        <a href="<?= Url::to(['member/upgrade', 'plan' => $membership->id]) ?>" class="btn btn-success btn-lg <?=(!isset($active) || $active == true)?'':''?>">Upgrade Now!</a>
                    <?php } elseif ($level == $membership->level) { ?>
                        <a href="<?= Url::to(['member/index']) ?>" class="btn btn-info btn-lg <?=(!isset($active) || $active == true)?'':'visible-xs'?>">Use Benefits</a>
                    <?php } elseif ($level == 0) { ?>
                        <a href="<?= Url::to(['site/join', 'plan' => $membership->id]) ?>" class="btn btn-primary btn-lg <?=(!isset($active) || $active == true)?'':'visible-xs'?>">Join Now!</a>
                    <?php }
//                }?>
            </div>
<?php   $c++;
        } ?>
        </div>
<!--    </div>-->
<!--</div>-->
