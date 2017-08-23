<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">

    <div class="jumbotron jumbo-top jumbo-about">
        <h1>It Is Our Goal To Help You Find The Best Healthcare Solutions</h1>
    </div>

    <div class="body-content">
        <div class="row caption-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1><small>NAHC is an invaluable resource for healthcare consumers like you.</small></h1>
                <p class="lead">We provide access to cost-saving benefits, supplemental insurance products, best-in-class services, and personal consultants who help you identify and access the best healthcare options for your needs.</p>
            </div>
        </div>
        <div class="row text-left content-row">
            <div class="col-sm-7 col-sm-offset-1 text-left">
                <h1>What is NAHC?</h1>
                <p class="lead">The National Association for Healthcare Consumers (NAHC) is a national non-profit organization that provides membership benefits for healthcare consumers.</p><p>We were formed to provide our Members with high-quality, exclusive health benefits, products and services at the lowest possible pricing.  As a Member of NAHC, you have access to the knowledge and tools you need to shop for healthcare the same way you shop for other consumer goods – competitively, and with a full, comparative knowledge of cost and value.</p>
            </div>
            <div class="col-sm-3 ">
                <img src="/img/about-2.jpg" width="100%">
            </div>
        </div>
        <div class="row text-left content-row">
            <div class="col-sm-3 col-sm-offset-1">
                <img src="/img/about-1.jpg" width="100%">
            </div>
            <div class="col-sm-7">
                <h1>Who is NAHC?</h1>
                <p class="lead">NAHC is a collective of experienced, career professionals with deep and extensive backgrounds in the healthcare, benefits and insurance industries.</p><p>We use our knowledge and understanding of these markets to give our Members access the best healthcare providers and services available. As a Member, you’ll discover that the price of joining NAHC will be covered multiple times over by the savings you will gain through our benefits, insurance products, advice and services.</p>
            </div>
        </div>
        <div class="row text-left content-row">
            <div class="col-sm-7 col-sm-offset-1">
                <h1>Why Choose NAHC?</h1>
                <p class="lead">It is an unfortunate and irrefutable fact of life: High deductibles on healthcare insurance policies are here to stay.</p><p>However, for informed NAHC Members, there are ways to reduce the costs you pay when medical services are needed. The secret is knowing where and how to find value, and having exclusive access to products and services that deliver above-average value.  NAHC provides you with the tools and comprehensive information access which pulls back the curtain on costs, uncovering the true value of your healthcare dollars.</p>
            </div>
            <div class="col-sm-3 ">
                <img src="/img/about-3.jpg" width="100%">
            </div>
        </div>

        <?=$this->render('_cta_row');?>
    </div>
</div>
