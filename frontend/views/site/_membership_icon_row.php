<?php
/* @var $level integer */

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
    foreach ($memberships as $membership)
    { ?>
            <div class="row flex-row">
                <?php
                // data-toggle="tooltip" data-placement="top"
                foreach($membership->benefits as $benefit)
                {
                    $highlight = ($benefit->minimumMembershipLevel == $membership->level)?'nahc-highlight-'.$colors[$c]:'';

                    ?>
                    <a href="/membership#mem<?=$benefit->id?>" title="<?=$benefit->name?>" class="opt-block nahc-bg-<?=$colors[$c]?>-dk col-xs-12 col-sm-5 col-md-5 col-lg-5 <?=$highlight?>">

                        <img src="/img/icon/<?=$benefit->icon?>-white.png">
                        <!--                        <br class="hidden-lg hidden-xs">-->
                        <div class=""><?=$benefit->name?></div>
                    </a>

                    <?php
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
