<?php

use common\models\State;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
$this->title = 'Agents';
?>

<div class="site-agents">

    <div class="jumbotron jumbo-top jumbo-agent">
        <h1>We make your life easier with our unique product approach</h1>
    </div>

    <div class="body-content">
        <div class="row caption-row">
            <div class="col-sm-8 col-sm-offset-2">
                <h3>Selling today has become harder than ever. That’s why when you become an NAHC agent, you truly have access to something never before offered in one place, and that means bigger sales ahead for you!</h3>
            </div>
        </div>
        <?php /*<div class="row">
            <div class="col-sm-12">
                <h2>Find an Agent</h2>
                <?php if(empty($model->results)) { $form = ActiveForm::begin([]);?>
                <div class="row">
                    <div class="col-sm-4"><?=$form->field($model, 'city')->textInput(['placeholder' => 'City'])->label(false);?></div>

                    <div class="col-sm-3"><?=$form->field($model, 'state')->dropDownList(State::getStateList(), ['prompt' => 'State'])->label(false);?></div>

                    <div class="col-sm-3"><?=$form->field($model, 'zip')->textInput(['placeholder' => 'Zip Code'])->label(false);?></div>

                    <div class="col-sm-2"><?php echo Html::submitButton('Find', ['class' => 'btn btn-primary btn-block']);?></div>
                </div>
                <?php ActiveForm::end(); } else {?>
                <div class="row">
                    <div class="col-sm-10">
                        Results!
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <hr> */?>
        <div class="row content-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Become an Agent</h1>
                <p class="lead">At NAHC, we’re looking for ethical, professional agents who are committed to putting members first and making a difference. If that describes you, our association may be just the home you are looking for.</p>
                <a href="<?=Url::to(['site/agent-contact'])?>" class="btn btn-primary btn-lg">Contact NAHC</a>
            </div>
        </div>
        <hr>
        <div class="row content-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Tools</h1>
                <p class="lead">As an NAHC agent you will have the tools necessary to run a successful business.</p><p>We provide our agents with a free CRM, back office system, and accounting for your book of business. You will have everything that you need to be successful. By leaving the headaches to us, you can work on what is most important, building customer loyalty and securing your personal financial freedom. What are you waiting for, get contracted with NAHC today!</p>
            </div>
        </div>
        <div class="row content-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Training</h1>
                <p class="lead">Our senior sales support team offers periodic training on new and existing products, member benefits, the sales cycle, generating referrals and more.</p><p>In addition to the group training offerings, one-to-one training is available as well. We believe that training our agents to succeed will lead to long lasting relationships, ultimately leading to a healthier membership base for NAHC.</p>
            </div>
        </div>
        <div class="row content-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Support</h1>
                <p class="lead">Whether you are a brand-new agent or a seasoned one, you will find the exact level of support that you need from NAHC.</p><p>We have hundreds of satisfied agents serving our current and potential members. Our sales leadership team and our internal customer support team, assist agents with locating, enrolling and retaining members into our membership programs and innovative insurance products. We truly offer the ability to be in business for yourself, but not by yourself. Sales, Customer Management and Technical Support are just a phone call away.</p>
            </div>
        </div>
    </div>
</div>
