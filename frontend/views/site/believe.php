<?php

use yii\helpers\Url;
$this->title = 'We Believe';
?>

<div class="site-believe">

    <div class="jumbotron jumbo-top jumbo-believe">
        <h1>At NAHC, We Believe...</h1>
    </div>

    <div class="body-content">
        <div class="row caption-row">
            <div class="col-sm-8 col-sm-offset-2">
                <h3>NAHC provides the resources which give our Members the information, tools, and assistance necessary to make informed healthcare decisions</h3>
            </div>
        </div>
        <hr>
        <div class="row content-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h2>You, as a consumer, have every right to affordable health benefits and supplemental insurance products that minimize your out-of-pocket healthcare costs</h2>
                <p class="lead">When it comes to your health, coverage is key.  And managing the cost is critical. We offer you a variety of affordable health insurance products and Member beneftis that can help minimize out-of-pocket expenses and offset high deductibles without in any way compromising the quality of care you receive.</p>
                <a href="<?=Url::to(['site/membership'])?>" class="btn btn-primary">About Membership</a>
            </div>
        </div>
        <hr>
        <div class="row content-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h2>You are entitled to clear, concise, comprehensive, and accurate healthcare pricing information</h2>
                <p class="lead">It’s your money. Just because you’re investing it in products and services designed to improve or restore your health doesn’t make the need to spend it wisely any less important. We provide the resources you need to choose the most cost-effective healthcare options available.</p>
                <a href="<?=Url::to(['site/products'])?>" class="btn btn-primary">About Products</a>
            </div>
        </div>
        <hr>
<!--        <div class="row content-row">-->
<!--            <div class="col-sm-10 col-sm-offset-1">-->
<!--                <h2>It’s crucial for you to have a dedicated personal consultant who can provide the guidance you need to find and manage the best healthcare services available.</h2>-->
<!--                <p class="lead">You’re the driver of your own healthcare decisions. We just help navigate. Your personal NAHC healthcare advocate has the knowledge and experience to steer you on the right course. So, every decision you make regarding your healthcare, is the best possible decision for you.</p>-->
<!--                <a href="--><?//=Url::to(['site/advocacy'])?><!--" class="btn btn-primary">About Advocacy</a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <hr>-->
        <div class="row content-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h2>You have a right to straightforward information about the qualifications and quality of doctors and hospitals prior to selecting your healthcare providers</h2>
                <p class="lead">Not all healthcare providers are equal. We provide you with third-party reviews and ratings on thousands of healthcare providers and facilities, all across the country. There is no reason why you should accept a sub-standard quality of care simply due to lack of concrete information.</p>
                <a href="<?=Url::to(['site/tools'])?>" class="btn btn-primary">About Tools</a>
            </div>
        </div>

        <?=$this->render('_cta_row');?>
    </div>
</div>
