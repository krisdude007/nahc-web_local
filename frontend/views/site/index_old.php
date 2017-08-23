<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'NAHC';
?>
<div class="site-index">

    <div class="jumbotron">
        <div class="box">
            <h1>National Association for Healthcare Consumers</h1>

            <p class="lead">Our focus is you.  We help guide your search for the best healthcare solutions.</p>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site/believe']);?>">Learn More</a></p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-1">
                &nbsp;
            </div>
            <div class="col-md-10">
                <div class="col-sm-4">
                    <h2>Provider & Pricing Transparency</h2>

                    <p>Our NAHC Network helps identify the highest quality, most affordable doctors and other healthcare providers - and give you options to help find the healthcare that's best suited to you and your family's needs.</p>

                    <p><a class="btn btn-default" href="<?=Url::to(['site/membership']);?>">Learn More &raquo;</a></p>
                </div>
                <div class="col-sm-4">
                    <h2>Doctor & Hospital Quality</h2>

                    <p>Your NAHC Membership provides access to reviews, reports and other critical data that ensures you are able to engage the nation’s top rated and most reputable healthcare providers, hospitals, and other medical facilities.</p>

                    <p><a class="btn btn-default" href="<?=Url::to(['site/tools']);?>">Learn More &raquo;</a></p>
                </div>
                <div class="col-sm-4">
                    <h2>Personal Healthcare Advocacy</h2>

                    <p>NAHC Members will have access to healthcare advocacy specialists that will collaborate with you, one-on-one, to make sure your best interests are always protected, first and foremost, in all your healthcare matters.</p>

                    <p><a class="btn btn-default" href="<?=Url::to(['site/advocacy']);?>">Learn More &raquo;</a></p>
                </div>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>

        <div class="jumbotron jumbo-row" style="background-image: url('/img/index-banner-1.jpg');">
            <h1>Reduce your costs. Increase your options.</h1>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site/membership']);?>">Join Now</a></p>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="row text-left">
                    <div class="col-sm-1"><img src="/img/icon-net.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Discount Medical Provider Networks</h3></div>

                    <div class="col-sm-1"><img src="/img/icon-card.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Something Not Education</h3></div>

                    <div class="col-sm-1"><img src="/img/icon-prod.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Affordable Insurance Products</h3></div>
                </div>

                <div class="row text-left">
                    <div class="col-sm-1"><img src="/img/icon-card.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Discount Prescription Drug Cards</h3></div>

                    <div class="col-sm-1"><img src="/img/icon-tele.png" width="100%"></div>
                    <div class="col-sm-3"><h3>24/7 Tele-Medical Access</h3></div>

                    <div class="col-sm-1"><img src="/img/icon-travel.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Worldwide Medical Travel Assistance</h3></div>
                </div>
                <a href="<?=Url::to(['site/membership']);?>" class="btn btn-primary btn-lg">Join Now</a>
            </div>
        </div>

        <div class="jumbotron jumbo-row" style="background-image: url('/img/index-banner-2.jpg');">
            <h1>NAHC. Who we are. What we believe.</h1>
            <p class="lead">NAHC provides the resources and support to guide our Members through the complex maze of healthcare provider options, pricing, and insurance.</p>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site/believe']);?>">What We Believe</a></p>
        </div>

        <div class="jumbotron jumbo-row" style="height: auto;">
            <h1>Our Goal Is Helping You Find The Best Healthcare Solutions</h1>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site/membership']);?>">Join Now</a></p>
        </div>
    </div>

</div>
