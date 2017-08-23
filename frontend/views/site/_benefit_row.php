<?php
/* @var $benefits \common\models\MembershipBenefit[] */

?>

<div  style="display: flex; flex-wrap: wrap; justify-content: center; padding-top: 0;">
    <?php           $i = 1;
    foreach($benefits as $benefit) { ?>

        <div class="col-xs-12 col-sm-5 col-md-6 col-lg-6 col-md-offset-0 col-lg-offset-0 <?=(($i % 2 == 0)?'col-sm-offset-1':'col-sm-offset-0')?> text-left" style="padding-top: 10px; padding-bottom: 10px; padding-left: 5px; padding-right: 5px;">
            <a href="#mem<?=$benefit->id?>">
                <img src="/img/icon/<?=$benefit->icon?>.png" width="100%" style="margin-bottom: 5px; max-width: 50px; padding-left: 5px; padding-right: 5px;">
                <br class="hidden-xs hidden-sm">
                <span><?=$benefit->name?></span></a>
        </div>

        <?php       //$i++;
    } ?>
</div>
