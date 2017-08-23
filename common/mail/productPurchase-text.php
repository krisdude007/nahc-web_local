<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $member common\models\Member */

?>

Dear <?=$member->getNameText(false)?>,

Thank you for your purchase! - Thank you for your recent purchase of <?=$productOption->product->name?> coverage.  You have selected the <?=$productOption->coverageTypeText?> coverage of <?=$productOption->coverage_level?>.

More Information - once your coverage is active, you can manage your coverage product on the NAHC website using the “My Membership” page, located at https://joinnahc.com/member .

Questions? Contact NAHC Member Services at 844-640-0400 – As always, should you have any questions about your coverage or to file a claim, please contact NAHC Member Services at 844-640-0400.  Thank you for your membership in NAHC!


