<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $member common\models\Member */

?>
<div class="member-welcome">
    Dear <?=Html::encode($member->getNameText(false))?>,

    <p><strong>Thank you for your purchase!</strong> - Thank you for your recent purchase of <?=$productOption->product->name?> coverage.  You have selected the <?=$productOption->coverageTypeText?> coverage of <?=$productOption->coverage_level?>.</p>

    <p><strong>More Information</strong> - once your coverage is active, you can manage your coverage product on the NAHC website using the “My Membership” page, located at <a href="https://joinnahc.com/member">https://joinnahc.com/member</a>.</p>

    <p><strong>Questions? Contact NAHC Member Services at 844-640-0400</strong> – As always, should you have any questions about your coverage or to file a claim, please contact NAHC Member Services at 844-640-0400.  Thank you for your membership in NAHC!</p>

</div>
