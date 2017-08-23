<?php
/**
 * Included row for "Join Now" CTA banner content for page footers
 *
 **/
use yii\helpers\Url;
?>
<div class="jumbotron cta-row">
<?php if(Yii::$app->user->isGuest || !Yii::$app->user->identity->has_member) { ?>

    <h2>Take control of your healthcare buying decisions</h2>
    <a class="btn btn-lg btn-success" href="<?=Url::to(['site/join']);?>">Join Now</a>

<?php } else { ?>

        <h2>You have great benefits with NAHC!<br><small style="color: white;">Use them today!</small></h2>
        <a class="btn btn-lg btn-success" href="<?=Url::to(['member/index']);?>">Access My Benefits</a>

<?php } ?>
</div>
