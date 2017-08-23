<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $member common\models\Member */

?>
<div class="member-welcome">
    Dear <?=Html::encode($member->getNameText(false))?>,

    <p><strong>Welcome to the National Association for Healthcare Consumers</strong> - Thank you for your enrollment in NAHC.  We believe that you will find our products and services to be very beneficial.</p>

    <p><strong>Identification Cards</strong> - In the coming days, you will be receiving a welcome packet that will include your Identification Cards. When you use your membership benefits, you will be asked for your NAHC Member ID Number, so keep your ID cards where they are easily accessible.  If you forget your Member ID Number or password, you can visit our website to retrieve them.  Temporary ID cards can also be printed from the website on the “My Membership” page, located at <a href="https://joinnahc.com/member">https://joinnahc.com/member</a>.</p>

    <p><strong>Quick Links and Certificates of Coverage for Insurance Benefits</strong> – On the member website, you will have instant access to all of your NAHC Membership benefits, including quick links and telephone numbers to all of the service providers along with certificates of coverage for insurance benefits purchased with your membership.  To access these items, click on the “Benefits” tab in the upper right hand corner after you have successfully logged in, to open the “My Membership” page.</p>

    <p><strong>Questions? Contact NAHC Member Services at 844-640-0400</strong> – As always, should you have any questions about your membership, please contact NAHC Member Services at 844-640-0400.  Thank you for your membership in NAHC!</p>

</div>
