<?php
/* @var $member boolean */

use yii\bootstrap\Html;

$btnData = '';

if($member) {
    $btnData = Html::a('Use Resource', ['member/index'], ['class' => 'btn btn-primary']);
} else {
    $btnData = Html::a('Join Now!', ['site/membership'], ['class' => 'btn btn-primary']);
}

$this->title = 'Tools & Resources';


$links = [
    'tool1' => [
        '1' => [],
        '2' => [],
        '3' => [
            'Bill Negotiator' => 'https://thekarisgroup.com/services/karis360/bill-negotiator',
        ],
        '4' => [],
    ],

    'tool2' => [
        '1' => [],
        '2' => [],
        '3' => [],
        '4' => [],
    ],

    'tool3' => [
        '1' => [],
        '2' => [],
        '3' => [],
        '4' => [],
    ],

    'tool4' => [
        '1' => [],
        '2' => [],
        '3' => [],
        '4' => [],
    ],
];
?>

<div class="site-tools">

    <div class="jumbotron jumbo-top jumbo-tools">
        <h1>Find The Highest Quality Care At The Lowest Possible Cost</h1>
    </div>

    <div class="body-content">
        <div class="row caption-row">
            <div class="col-sm-10 col-sm-offset-1">
                <h2>Your NAHC Membership provides tools and resources to compare costs, evaluate quality, and find the best care at the best price.</h2>
            </div>
        </div>
        <div class="row text-left content-row">
            <div class="col-sm-3 col-sm-offset-1">
                <img src="/img/tools-1.jpg" width="100%">
            </div>
            <div class="col-sm-7">
                <h1>Compare Doctor Costs</h1>
                <p class="lead">The price you pay for the same procedures can vary from one doctor to the next. We help to ensure that you choose the right doctor at the right price.</p>
                <dl>
                    <dd>Identify the best doctors in your plan, for your needs</dd>
                    <dd>Confirm your doctor can treat you at the best price</dd>
                    <dd>Provide reviews and ratings on doctor quality</dd>
                </dl>
                <a href="#tools1" data-toggle="modal" data-target="#tools1" class="btn btn-default">More Details</a>&nbsp;&nbsp;<?=$btnData?>
            </div>
        </div>

        <div class="row text-right content-row">
            <div class="col-sm-7 col-sm-offset-1 text-left">
                <h1>Compare Hospital Costs</h1>
                <p class="lead">Not all healthcare facilities are equal. NAHC helps you compare costs of hospitals, clinics and medical centers to help you select the right one for you.</p>
                <dl>
                    <dd>Identify hospitals in your area rated 3-stars or higher</dd>
                    <dd>Confirm your doctor can treat you at a specific facility</dd>
                    <dd>Provide cost-comparison reviews and research</dd>
                </dl>
                <a href="#tools2" data-toggle="modal" data-target="#tools2" class="btn btn-default">More Details</a>&nbsp;&nbsp;<?=$btnData?>
            </div>
            <div class="col-sm-3 ">
                <img src="/img/tools-2.jpg" width="100%">
            </div>
        </div>

        <div class="row text-left content-row">
            <div class="col-sm-3 col-sm-offset-1">
                <img src="/img/tools-3.jpg" width="100%">
            </div>
            <div class="col-sm-7">
                <h1>Doctor & Hospital Quality</h1>
                <p class="lead">Get qualified and unbiased reports on the quality ratings, service records, and overall reputations of healthcare providers and the facilities they use. </p>
                <dl>
                    <dd>Evaluations of healthcare-facility quality</dd>
                    <dd>Reviews on the reputations of doctors and clinicians</dd>
                    <dd>Research and reports on patient satisfaction</dd>
                </dl>
                <a href="#tools3" data-toggle="modal" data-target="#tools3" class="btn btn-default">More Details</a>&nbsp;&nbsp;<?=$btnData?>
            </div>
        </div>

        <div class="row text-right content-row">
            <div class="col-sm-7 col-sm-offset-1 text-left">
                <h1>Procedures & Diagnosis</h1>
                <p class="lead">For Members with questions or concerns about procedures and diagnoses, NAHC can assist you with the answers, advice and information you need.</p>
                <dl>
                    <dd>Second-opinion referrals</dd>
                    <dd>Reference materials on diagnoses</dd>
                    <dd>Information on treatment options</dd>
                </dl>
                <a href="#tools4" data-toggle="modal" data-target="#tools4" class="btn btn-default">More Details</a>&nbsp;&nbsp;<?=$btnData?>
            </div>
            <div class="col-sm-3 ">
                <img src="/img/tools-4.jpg" width="100%">
            </div>
        </div>


    <?=$this->render('_cta_row');?>
    </div>
</div>


<div class="modal fade" id="tools1" tabindex="-1" role="dialog" aria-labelledby="tools1Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tools1Label">Compare Doctor Costs</h4>
            </div>
            <div class="modal-body">
                <p>
                    The prices you’re charged by medical professionals can vary widely and may have less to do with the
                    quality of care you receive than they do with the type of coverage you carry. As an NAHC Member, we
                    help you compare among the doctors, specialist and clinicians in your plan’s list of approved providers
                    to help identify the finest-quality doctors and specialists for your specific medical needs.</p>

                    <p>We possess the working knowledge to help you find the best doctors in the specific areas of care you
                        need, based on the accumulated reviews and ratings we’ve receive from actual patients.</p>

                <p>
                    • Identify the best doctors in your plan, for your needs<br>
                    • Confirm your doctor can treat you at the best price<br>
                    • Provide reviews and ratings on doctor quality<br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Join Now</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tools2" tabindex="-1" role="dialog" aria-labelledby="tools2Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tools2Label">Compare Hospital Costs</h4>
            </div>
            <div class="modal-body">
                <p>
                    There are a variety of factors that can affect the prices you’re billed at the hospitals you select. These
                    may include but are not limited to: the experience level and reputation of the hospital staff; the condition,
                    age and location of the facility; the quality of service they offer; and, most importantly, whether or not
                    your attending physician has admitting privileges.</p>

                    <p>Additionally, some hospitals are known to concentrate their expertise in specialized areas of care like
                    treating pulmonary conditions, various types of cancer, or autoimmune disorders, leading them to
                    deliver significantly better care than others when it comes to addressing specific conditions and
                    performing specialized medical or surgical procedures.</p>

                    <p>NAHC can help you compare hospitals in your area to make sure the facility you’re considering
                    offers not only admitting privileges to your doctor but also provides the highest level of service
                    at a price you can afford to pay,</p>

                <p>
                   • Identify hospitals in your area rated 3-stars or higher<br>
                    • Confirm your doctor can treat you at a specific facility<br>
                    • Provide cost-comparison reviews and research<br>

                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Join Now</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tools3" tabindex="-1" role="dialog" aria-labelledby="tools3Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tools3Label">Doctor & Hospital Quality</h4>
            </div>
            <div class="modal-body">
                <p>
                    Not all doctors are created equal. And neither are the hospitals where they practice. So, in order to help you better understand, compare, and
                    evaluate  hospital quality and physician performance, NAHC provides you access to objective and comprehensive information in matters related
                    to the healthcare quality and service records of America’s hospitals and medical praticioners.</p>

                    <p>We start by assisting you in evaluating and selecting the best doctors with the highest level of expertise in the specific area of care you need.
                        Once your doctor is determined, we’ll help you identify the best qualified medical facility where your preferred doctor has admitting privileges.</p>

                    <p>Unlike other hospital-quality analyses, our evaluations rate hospital quality for conditions and procedures based on clinical outcomes. We measure
                    hospital performance for the most common in-hospital procedures and conditions and adjust for your unique risk factors, such as age, gender and
                    medical condition. Our analysis is based on more than 45 million Medicare medical claims records for the most recent three-year time period
                        available from nearly 4,500 hospitals nationwide.</p>

                    <p>So, whether you’re evaluating medical facilities or medical providers, NAHC helps you make sure that the doctor you choose can treat you at
                        the facility you prefer; a facility with at least a 3-star rating or higher in your area of care.</p>

                <p>
                    • Evaluations of healthcare-facility quality<br>
                    • Reviews on the reputations of doctors and clinicians<br>
                    • Research and reports on patient satisfaction<br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Join Now</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tools4" tabindex="-1" role="dialog" aria-labelledby="tools4Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tools4Label">Procedures & Diagnosis</h4>
            </div>
            <div class="modal-body">
                <p>
                    For our Members with questions or concerns about procedures they are considering or diagnoses they’ve received, NAHC is ready to assist. We can
                    point you in the right direction for professional advice on your recommended and alternative healthcare treatment options. Through our professional
                    partnerships with leading healthcare-service consultants like HealthCare Advocates and The Karis Group, your NAHC Advocate can provide you with
                    members-only access to an array of patient advocacy programs and support services. We can also assist you in satisfying a variety of needs related
                    to any impending procedures and recent diagnoses, from identifying physician specialists and understanding surgical options, to better
                    comprehending insurance coverage and out-of-pocket costs.</p>
                <p>
                    • Second-opinion referrals<br>
                    • Reference materials on diagnoses<br>
                    • Information on treatment options<br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Join Now</button>
            </div>
        </div>
    </div>
</div>