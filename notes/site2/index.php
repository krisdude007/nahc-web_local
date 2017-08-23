<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'NAHC';
?>
<div class="site-index">

    <div class="jumbotron">
        <div class="box">
            <h1>Take Control of Your Healthcare Spending</h1>

            <p class="lead">We are a non-profit healthcare consumer advocacy association dedicated to helping our members find the best healthcare solutions.</p>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site2/believe']);?>">Learn More</a></p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-1">
                &nbsp;
            </div>
            <div class="col-md-10">
                <div class="col-sm-4">
                    <h2>Save Money on Out of Pocket Healthcare Expenses</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In suscipit lorem imperdiet leo dapibus pulvinar. Cras tempus varius nibh. Nulla facilisi. Etiam congue ullamcorper libero, vel egestas nullam.</p>

                    <p><a class="btn btn-default" href="<?=Url::to(['site2/membership']);?>">Memberships &raquo;</a></p>
                </div>
                <div class="col-sm-4">
                    <h2>Extra Protection When You Need It</h2>

                    <p>Vestibulum feugiat ut ipsum eu iaculis. Sed condimentum eget libero ut convallis. Aliquam urna sapien, lacinia ut pretium a, fringilla sed augue. Donec nulla mi, pretium in lacus at, luctus cras amet.</p>

                    <p><a class="btn btn-default" href="<?=Url::to(['site2/products']);?>">Products &raquo;</a></p>
                </div>
                <div class="col-sm-4">
                    <h2>Comparison Shopping For Quality & Price</h2>

                    <p>Nulla facilisi. Nullam ac elit at mauris faucibus pulvinar ut nec enim. Mauris venenatis vel nisl semper gravida. Fusce sodales, lacus vitae iaculis posuere, justo sem condimentum erat, a turpis duis.</p>

                    <p><a class="btn btn-default" href="<?=Url::to(['site2/tools']);?>">Tools &raquo;</a></p>
                </div>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>

        <div class="jumbotron jumbo-row" style="background-image: url('/img/index-banner-1.jpg');">
            <h1>Reduce your costs. Increase your options.</h1>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site2/membership']);?>">Join Now</a></p>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="row text-left">
                    <div class="col-sm-1"><img src="/img/icon/icon-card.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Discount RX Prescription Card</h3></div>

                    <div class="col-sm-1"><img src="/img/icon/icon-networks.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Discount Medical Provider Networks</h3></div>

                    <div class="col-sm-1"><img src="/img/icon/icon-quality.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Doctor & Hospital Quality Reports</h3></div>
                </div>

                <div class="row text-left">
                    <div class="col-sm-1"><img src="/img/icon/icon-transparency.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Healthcare Pricing Transparency</h3></div>

                    <div class="col-sm-1"><img src="/img/icon/icon-travel.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Worldwide Medical Travel Assistance</h3></div>

                    <div class="col-sm-1"><img src="/img/icon/icon-tele.png" width="100%"></div>
                    <div class="col-sm-3"><h3>24/7 Tele-Medical Access</h3></div>
                </div>

                <div class="row text-left">
                    <div class="col-sm-1 col-sm-offset-2"><img src="/img/icon/icon-advocacy.png" width="100%"></div>
                    <div class="col-sm-3"><h3>Personal Healthcare Advocacy</h3></div>

                    <div class="col-sm-1"><img src="/img/icon/icon-anydoctor.png" width="100%"></div>
                    <div class="col-sm-3"><h3>AnyDoctor</h3></div>
                </div>
                <br>
                <a href="<?=Url::to(['site2/membership']);?>" class="btn btn-primary btn-lg">Join Now</a>
            </div>
        </div>

        <div class="jumbotron jumbo-row" style="background-image: url('/img/index-banner-1.jpg');">
            <h1>Choose a plan tailored to your needs.</h1>
        </div>

        <?=$this->render('_membership_row')?>

        <div class="jumbotron jumbo-row" style="background-image: url('/img/index-banner-2.jpg');">
            <h1>Extra protection when you need it</h1>
            <p class="lead">NAHC offers discounted insurance products exclusively for our members.</p>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="row text-left">
                    <div class="col-sm-1 col-sm-offset-2"><img src="/img/icon/icon-card.png" width="100%"></div>
                    <div class="col-sm-2"><h4>Critical Illness Insurance</h4></div>

                    <div class="col-sm-1"><img src="/img/icon-travel.png" width="100%"></div>
                    <div class="col-sm-2"><h4>Vision Insurance</h4></div>

                    <div class="col-sm-1"><img src="/img/icon-tele.png" width="100%"></div>
                    <div class="col-sm-2"><h4>Dental Insurance</h4></div>
                </div>

                <div class="row text-left">
                    <div class="col-sm-1"><img src="/img/icon-net.png" width="100%"></div>
                    <div class="col-sm-2"><h4>Accident Disability Insurance</h4></div>

                    <div class="col-sm-1"><img src="/img/icon-card.png" width="100%"></div>
                    <div class="col-sm-2"><h4>Accident Hospital Indemnity</h4></div>

                    <div class="col-sm-1"><img src="/img/icon-prod.png" width="100%"></div>
                    <div class="col-sm-2"><h4>Accident Medical Expenses</h4></div>

                    <div class="col-sm-1"><img src="/img/icon-prod.png" width="100%"></div>
                    <div class="col-sm-2"><h4>Accidental Death & Dis-memberment</h4></div>
                </div>
                <br>
                <a href="<?=Url::to(['site2/products']);?>" class="btn btn-primary btn-lg">Learn More</a>
            </div>
        </div>

        <div class="jumbotron jumbo-row" style="background-image: url('/img/index-banner-2.jpg');">
            <h1>NAHC. Who we are. What we believe.</h1>
            <p class="lead">NAHC provides the resources and support to guide our Members through the complex maze of healthcare provider options, pricing, and insurance.</p>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site2/believe']);?>">What We Believe</a></p>
        </div>

        <div class="jumbotron jumbo-row" style="height: auto;">
            <h1>Our Goal Is Helping You Find The Best Healthcare Solutions</h1>

            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['site2/membership']);?>">Join Now</a></p>
        </div>
    </div>

</div>
