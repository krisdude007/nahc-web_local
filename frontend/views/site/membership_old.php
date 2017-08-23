<?php
use yii\helpers\Url;


?>

<div class="site-membership">

    <div class="jumbotron jumbo-top" style="background-image: url('/img/jumbo-membership.png');">
        <h1>The Valuable Advantages Of NAHC Membership</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>The cost-saving benefits of your NAHC Membership ensure that you’ll always have access to the best healthcare policies, products, services, and support – at the most affordable prices. </h1>
                <p>As a Member of the NAHC, you receive all the resources you’ll need to make well-informed decisions in all matters concerning your and your family’s healthcare. Considering what you can save as an NAHC Member, the cost of joining will more than pay for itself many times over.</p>
            </div>
        </div>
        <div class="row" style="text-align: center;">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Membership Benefits</h1>
                <p>Membership in NAHC includes the following benefits:</p>

                <div class="row">
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span><br>
                        <a href="#mem1" data-toggle="modal" data-target="#mem1">Discount RX Prescription Card</a>
                    </div>
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-book"></span><br>
                        <a href="#mem2" data-toggle="modal" data-target="#mem2">Discount Medical Provider Networks</a>
                    </div>
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-list-alt"></span><br>
                        <a href="#mem3" data-toggle="modal" data-target="#mem3">Doctor & Hospital Quality Reports</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-search"></span><br>
                        <a href="#mem4" data-toggle="modal" data-target="#mem4">Healthcare Pricing Transparency</a>
                    </div>
                    <div class="col-sm-4">

                        <span class="glyphicon glyphicon-globe"></span><br>
                        <a href="#mem5" data-toggle="modal" data-target="#mem5">Worldwide Medical Travel Assistance</a>
                    </div>
                    <div class="col-sm-4">
                        <span class="glyphicon glyphicon-facetime-video"></span><br>
                        <a href="#mem6" data-toggle="modal" data-target="#mem6">24/7 Tele-Medicine Access</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <span class="glyphicon glyphicon-briefcase"></span><br>
                        <a href="#mem7" data-toggle="modal" data-target="#mem7">Personal Healthcare Advocacy</a>
                    </div>
                    <div class="col-sm-6">
                        <span class="glyphicon glyphicon-plus"></span><br>
                        <a href="#mem8" data-toggle="modal" data-target="#mem8">AnyDoctor</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Membership Levels</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
                <div class="row is-table-row">
                    <div class="col-sm-3">
                        <h1>Basic</h1>
                        <h2>$0 / mo</h2>
                        <h3>Just the basics</h3>
                        <hr>
                        <p>
                            <a href="#mem1" data-toggle="modal" data-target="#mem1">Discount RX Card</a><br>
                            <a href="#mem2" data-toggle="modal" data-target="#mem2">Discount Provider Networks</a><br>
                        </p>
                        <?php if($level == 0) { ?>
                            <a href="<?=Url::to(['site/join', 'plan' => 1])?>" class="btn btn-primary btn-lg">Join Now!</a>
                        <?php } elseif($level < 1) { ?>
                            &nbsp;
                        <?php } else { ?>
                            &nbsp;
                        <?php } ?>
                    </div>
                    <div class="col-sm-3">
                        <h1>Bronze</h1>
                        <h2>$7.95 / mo</h2>
                        <h3>The basics & more</h3>
                        <hr>
                        <p>
                            The Basic Plan PLUS:<br>
                            <a href="#mem3" data-toggle="modal" data-target="#mem3">Doctor & Hospital Quality Reports</a><br>
                            <a href="#mem4" data-toggle="modal" data-target="#mem4">Healthcare Pricing Transparency</a><br>
                            <a href="#mem5" data-toggle="modal" data-target="#mem5">Worldwide Medical Travel Assistance</a><br>
                        </p>
                        <?php if($level == 0) { ?>
                            <a href="<?=Url::to(['site/join', 'plan' => 2])?>" class="btn btn-primary btn-lg">Join Now!</a>
                        <?php } elseif($level < 2) { ?>
                            <a href="<?=Url::to(['member/upgrade', 'plan' => 2])?>" class="btn btn-success btn-lg">Upgrade Today!</a>
                        <?php } else { ?>
                            &nbsp;
                        <?php } ?>

                    </div>
                    <div class="col-sm-3">
                        <h1>Silver</h1>
                        <h2>$14.95 / mo</h2>
                        <h3>Adds the Advocate</h3>
                        <hr>
                        <p>
                            The Bronze Plan PLUS:<br>
                            <a href="#mem6" data-toggle="modal" data-target="#mem6">24/7 TeleMedicine Access ($20 co-pay)</a><br>
                            <a href="#mem7" data-toggle="modal" data-target="#mem7">Personal Healthcare Advocacy (better)</a><br>
                        </p>
                        <?php if($level == 0) { ?>
                            <a href="<?=Url::to(['site/join', 'plan' => 3])?>" class="btn btn-primary btn-lg">Join Now!</a>
                        <?php } elseif($level < 3) { ?>
                            <a href="<?=Url::to(['member/upgrade', 'plan' => 3])?>" class="btn btn-success btn-lg">Upgrade Today!</a>
                        <?php } else { ?>
                            &nbsp;
                        <?php } ?>
                    </div>
                    <div class="col-sm-3">
                        <h1>Gold</h1>
                        <h2>$19.95 / mo</h2>
                        <h3>Soup to Nuts</h3>
                        <hr>
                        <p>
                            The Silver Plan PLUS:<br>
                            <a href="#mem6" data-toggle="modal" data-target="#mem6">24/7 TeleMedicine Access ($0 co-pay)</a><br>
                            <a href="#mem7" data-toggle="modal" data-target="#mem7">Personal Healthcare Advocacy (best)</a><br>
                            <a href="#mem8" data-toggle="modal" data-target="#mem8">AnyDoctor</a><br>
                        </p>
                        <?php if($level == 0) { ?>
                            <a href="<?=Url::to(['site/join', 'plan' => 4])?>" class="btn btn-primary btn-lg">Join Now!</a>
                        <?php } elseif($level < 4) { ?>
                            <a href="<?=Url::to(['member/upgrade', 'plan' => 4])?>" class="btn btn-success btn-lg">Upgrade Today!</a>
                        <?php } else { ?>
                            &nbsp;
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="jumbotron">
            <h1>Why NAHC?</h1>
            <p class="lead">You’ll have ready access to resources  that will keep you apprised of healthcare provider quality ratings and pricing and access to benefits, products and services that will help you save money and have more peach of mind.</p>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Reasons to join NAHC</h1>
                <p>The National Association for Healthcare Consumers ( NAHC) is organization devoted to empowering its Members to make better, more cost effective choices in healthcare. NAHC does this by giving its Members the information and tools they need to make more informed decisions on their healthcare options for them and their families. This includes the following:</p>
                <p>NAHC Members have access to a personal healthcare advocate who can guide them through the complex maze of healthcare provider options, costs, and billing issues.<br><br>
                   NAHC Members have access to innovative and affordable health insurance products which will limit their out-of-pocket exposure.<br><br>
                   NAHC Members will have access to information which will give them more transparency in healthcare pricing as well as more transparency on the reputation of doctors and quality of hospitals.<br><br>
                   NAHC Members will have access to educational resources to stay apprised of healthcare industry trends, advances in medical diagnoses, and best treatment options available.<br><br>
                   NAHC Members will have access to membership plans which will offer them more affordable healthcare provider options.<br><br>
                   NAHC Members will have access to discount programs which will bring immediate out-of-pocket cost savings, including a nationwide discount healthcare provider network and discount prescription drug card.<br><br>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>Membership FAQs</h1>
                <p>
                    <a data-toggle="collapse" href="#faq1" aria-expanded="false" aria-controls="faq1">
                        How do I enroll in one of the programs on this website?
                    </a>
                    <div class="collapse" id="faq1">
                        Click on the "Enroll Now!" link at the top of this page. You will then begin the enrollment process. If you do not want to complete your enrollment online, please contact your agent for other available options.
                    </div>
                </p>
                <p>
                    <a data-toggle="collapse" href="#faq2" aria-expanded="false" aria-controls="faq2">
                        After enrolling today, how do I access my benefits and membership services?
                    </a>
                    <div class="collapse" id="faq2">
                        During registration, you will create a membership account. Simply login to your account following the directions in your confirmation email. By logging in to your account, you can review the details of your membership, download certificates of insurance or summaries of coverage (if any), reprint identification cards, and gain access to direct links for all membership services.
                    </div>
                </p>
                <p>
                    <a data-toggle="collapse" href="#faq3" aria-expanded="false" aria-controls="faq3">
                        When is my coverage effective?
                    </a>
                    <div class="collapse" id="faq3">
                    If you enroll in a program today, access to the benefits and services will be effective on the first day of next month, subject to acceptance by NACD.
                    (* Employer List Bill Groups may have exceptions. Contact your agent for more information)
                    </div>
                </p>
                <p>
                    <a data-toggle="collapse" href="#faq4" aria-expanded="false" aria-controls="faq4">
                        Are there any exclusions or limitations?
                    </a>
                    <div class="collapse" id="faq4">
                        Yes, there are exclusions and limitations applicable to the benefits and services. Please see the brochures for each program for more details.
                    </div>
                </p>
                <p>
                    <a data-toggle="collapse" href="#faq5" aria-expanded="false" aria-controls="faq5">
                        What are the payment terms?
                    </a>
                    <div class="collapse" id="faq5">
                        Payment can be made by bank draft or credit card on the 15th, 20th or 25th of each month, whichever you prefer. All payments are to be made in advance of the month of membership (eg., payment on June 15 for July 1 effective date).

                        If you are an employer with a minimum of 5 enrollees, NACD can list bill your group for the monthly dues. Please see your agent for details.
                    </div>
                </p>
            </div>
        </div>
        <?=$this->render('_cta_row');?>
    </div>
</div>

<div class="modal fade" id="mem1" tabindex="-1" role="dialog" aria-labelledby="mem1Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mem1Label"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>&nbsp;Discount RX Prescription Card</h4>
            </div>
            <div class="modal-body">
                <p>The Discount Prescription Drug Card provides NAHC members immediate discounts at pharmacies nationwide on the purchase of prescription drugs.</p>

                <p>The NAHC Discount Prescription Drug Card is good at over 59,000 pharmacies nationwide, including CVS, Walgreens, Rite-Aid and Costco as well as many independent community pharmacies.</p>

                <h3>With the NAHC WellCard it pays to use it, to save!</h3>

                <p>Need a prescription for savings? The NAHC WellCard Savings is an easy way for you and your family to save on all your prescription drug needs. One card can be used by all family members and it is free at no cost to you.</p>

                <p>Instantly receive savings that average 50% or higher on drug prices through our nationwide network of over 59,000 pharmacies, including major chains such as CVS, Walmart, Walgreens, Rite-Aid and Costco, as well as independent community pharmacies.</p>

                <p>Your card can also be used through the exclusive NAHC WellCard mail order service to save an average of 20% off the regular retail price of your mail-order prescription drugs.</p>

                <p>Here are a few examples when using the NAHC WellCard pharmacy discount card gives you more options that also mean savings:<br>
                    When your insurance doesn’t cover a medication.<br>
                    It is likely our NAHC WellCard will provide you a good measure of instant savings at time of pick-up and purchase of the prescription.<br>
                    When your insurance limits the quantity of pills.<br>
                    Our NAHC WellCard will allow you to buy a bigger quantity of pills as long as your doctor permits it, and again, you will be able buy the pills at a cost savings.<br>
                    When you lose your prescription and your insurance carrier says it’s too soon to refill.<br>
                    With the NAHC WellCard you can afford to pay for the prescription refill on your own.<br>
                    When you have a deductible – show both cards and get the best rate.<br>
                    Your current insurance may have a co-pay plan or coverage for prescription drug costs, but your out-of-pocket expense may still be high. With the NAHC WellCard you may get a bigger discount than with your coverage.<br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary">Join Now!</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mem2" tabindex="-1" role="dialog" aria-labelledby="mem2Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mem2Label"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>&nbsp;Discount Medical Provider Networks</h4>
            </div>
            <div class="modal-body">
                <p>NAHC will provide its members access to a nationwide discount medical provider network (DMPO) to be able to access the provider’s discounted rate. The discount medical provider network includes over 400,000 physician offices and over 45,000 healthcare service providers including labs and imaging, durable medical equipment and home healthcare.</p>

                <p>NAHC provides our members access to a nationwide discount medical provider organization, or DMPO – with a savings discount card providing savings nationwide at over 410,000 physician offices and over 45,000 healthcare service providers including, lab tests, imaging tests, durable medical equipment, and home healthcare.</p>

                <p>You and your family can save money on doctor visits, retail clinic visits and medical services - by utilizing our concierge team to access the provider’s discounted rate. No complex enrollment, you immediately benefit by utilizing participating providers, facilities and healthcare companies – giving you savings from day one!</p>

                <p>Participating providers include family doctors and specialties such as weight loss, infertility, pediatricians, allergists, dermatology and internal medicine. There is no limit to the number of times you can save when visiting participating providers.</p>

                <p>Just sign up and become a NAHC member today.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary">Join Now!</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mem3" tabindex="-1" role="dialog" aria-labelledby="mem3Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mem3Label"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;Doctor & Hospital Quality Transparency</h4>
            </div>
            <div class="modal-body">
                <p>NAHC has partnered with Healthcare Bluebook and Healthgrades to allow NAHC members to access their comprehensive databases of doctors and hospitals nationwide.</p>

                <p>Healthcare data and ratings by patients are designed to give transparent information about physicians and hospitals so that consumers can make informed decisions</p>

                <p>NAHC believes that its Members as healthcare consumers should be informed as to the reputation of doctors and hospitals. To support its Members NAHC has partnered with Healthcare Bluebook and Healthgrades to give Members access to comprehensive databases of doctors and hospitals nationwide. Doctor and hospital reviews are also published on Healthcare Bluebook and Healthgrades and a star rating system up to 5-stars is shown for each doctor and hospital.</p>

                <p>Healthcare data and ratings by patients are designed to give transparent information about physicians and hospitals so that consumers can make informed decisions. Healthcare Bluebook and Healthgrades not only redefine how consumers research, compare and connect with physicians and hospitals, but they also help to transform the way hospitals reach, engage and communicate with consumers and physicians.</p>

                <p>Here is what NAHC Members need to know in finding the right doctor:<br>

                    Experience: Start by finding doctors who have experience in the specific care you need. Just enter your health condition or medical procedure into the search box provided.<br>
                    Patient Satisfaction: Make sure your doctor receives high marks from patients in the areas that matter most to you.<br>
                    Hospital Quality: Confirm your doctor can treat you at a hospital rated at least three stars in your area of care. A highly rated hospital can dramatically lower your risks of complications.<br>
                </p>

                <p>Here’s what you need to know to find the right hospital:<br>

                    Doctors and Hospitals are Linked: Doctors have admitting privileges at only certain hospitals — so when you choose a doctor, you are also choosing a hospital.<br>
                    Care Quality Varies a Lot: Some hospitals deliver significantly better care than others when it comes to specific conditions and procedures.<br>
                    You Can Minimize Risk: If you need hospital care, use the industry-leading ratings to make sure your doctor can treat you at a hospital rated at least three stars in your area of care. The difference in your healthcare can be dramatic.<br>
                </p>

                <p>Healthgrades also provides an online ‘Our Health’ chat room where NAHC Members can converse with other people regarding similar symptoms or diagnoses, and treatment options. Their Right Diagnosis section helps our Members discern what illness they may have based on a series of diagnostic questions.</p>

                <p>Member access to Doctor and Hospital Quality Transparency is through the NAHC membership plans, starting with the Bronze Plan at $7.95 per month. Having access to doctor and hospital quality transparency can enable you to have the confidence that you are choosing the best healthcare provider option.</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary">Join Now!</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mem4" tabindex="-1" role="dialog" aria-labelledby="mem4Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mem4Label"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Healthcare Pricing Transparency</h4>
            </div>
            <div class="modal-body">
                <p>NAHC has aligned itself with Healthcare Bluebook to offer healthcare pricing transparency to its members.</p>

                <p>Healthcare Bluebook has leveled the playing field with cost and quality transparency that allows Members to make informed healthcare decisions.</p>

                <p>NAHC believes its Members should have access to healthcare pricing information to enable them to have the tools to make more informed decisions on healthcare purchases, and reduce their costs.</p>

                <p>The healthcare system makes it difficult to find information on quality and cost of care; this hidden information putting patients at risk. This lack of transparency puts everyone at an unfair disadvantage – leading to gaps in quality of care and much higher costs. NAHC has aligned itself with Healthcare Bluebook to offer healthcare pricing transparency to our Members. Healthcare Bluebook has leveled the playing field with cost and quality transparency that allows our Members to make informed healthcare decisions.</p>

                <p>Healthcare Bluebook was founded on a simple, yet powerful idea: create fairness in the healthcare marketplace. We believe simple is smart. It’s transformational. This belief is the driving force behind what makes them different. It’s why their transparency product is not only the most informative, but also the most intuitive and easy to use. By combining the best cost and quality data with industry-leading usability, Healthcare Bluebook provides NAHC Members with everything they need to be more effective healthcare consumers. They’re forever changing the way people choose and bringing fairness to healthcare.</p>

                <p>Healthcare Bluebook is a diverse team of clinicians, healthcare experts, strategists and technologists dedicated to transforming healthcare with transparency. Healthcare Bluebook is leading a revolution to empower people everywhere to become better healthcare consumers by providing cost and quality transparency that makes it easy to find quality care at a Fair Price.</p>

                <p>Healthcare Bluebook helps you save money on out-of-pocket medical expenses. Shop for affordable care in your area and save hundreds or thousands of dollars while making informed decisions about your healthcare. NAHC Members can easily search any procedure to find out how much they should be paying in your area.</p>

                <p>Here’s what you need to know to find the right hospital:<br>

                    Use Fair Price Information to compare procedures and costs and make decisions about your healthcare.<br>
                    The Fair Price is the reasonable amount you should pay for a medical service. It’s calculated from a nationwide database of medical payment data and customized to your geographic area.<br>
                    Save hundreds to thousands of dollars in out-of-pocket costs every time you receive medical care.<br>
                </p>

                <p>Member access to Healthcare Bluebook is through the NAHC membership plans, starting with the Bronze Plan at $7.95 per month. Having healthcare pricing transparency can enable you to better navigate the complexities of the healthcare world and better cope with the frustration often felt when dealing with care and treatment decisions without knowing the price, which could lead to unforeseen financial burden on you and your family.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary">Join Now!</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mem5" tabindex="-1" role="dialog" aria-labelledby="mem5Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mem5Label"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>&nbsp;Travel Assist</h4>
            </div>
            <div class="modal-body">
                <p>NAHC has set up Travel Medical Assistance for its members through a partnership with Europ Assist. Members will be able to access emergency assistance when traveling including emergency medical assistance as well as to convenient support services.</p>

                <p>Europ Assistance is addressing new challenges in health and dependency with Care Services, a set of personalized support solutions for care, medical follow-up and remote assistance.</p>

                <p>Travel assistance is a term in use throughout much of the world which refers to a service which provides help, primarily in medical emergencies during travel.</p>

                <p>Travel assistance is different from medical, travel or trip cancellation insurance. Travel assistance programs arrange and pay for members away from home (usually a set distance of 100 miles or so, varying by provider) to find and obtain emergency medical care in an unfamiliar place, and to return members home when stabilized.</p>

                <p>When travelers experience a medical emergency, they can call the assistance company to receive help. The assistance program may be called first, or after the individual has been taken by local emergency services to the hospital.</p>

                <p>The assistance representative talks with the member and/or any medical providers that may be involved, and makes recommendations based on the details. Medical personnel at the assistance company make health care decisions in conjunction with the local treating physicians. Any variety of resources may be called into play to solve a travel medical challenge. Given the mobility of the world today, travel assistance with a healthcare provision reassures travelers that they will have a safety net available should they have a medical emergency while traveling.</p>

                <p>Travel Assist is a comprehensive program of information, referral, assistance, transportation, and evacuation services designed to help you respond to medical care situations and many other emergencies that may arise during travel. Most travel medical assist programs provide the following services to their members when traveling 100 miles or more from their homes or internationally up to 180 days.</p>

                <p>Some of the benefits of travel assist programs include:<br>

                Locating Medical Care: Assists you in locating medical care providers or local sources of medical care referrals.<br>
                24 Hour Health Information: Offers 24/7 access year round to registered nurses who can provide symptom decision support, evidence based health information and medication information, as well as help understanding treatment options to discuss with doctors.<br>
                Case Communications: In medical care cases, communicates between patients, family, physicians, employer, travel company and consulate as needed.<br>
                Emergency Evacuation: Arranges and provides emergency evacuation to the nearest facility, capable of providing appropriate care if you have a medical emergency while traveling and adequate medical facilities are not available locally.<br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary">Join Now!</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mem6" tabindex="-1" role="dialog" aria-labelledby="mem6Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mem6Label"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span>&nbsp;24/7 Tele-Medicine Access </h4>
            </div>
            <div class="modal-body">
                <p>Tele-medicine gives NAHC members convenient 24/7 access to doctors and other health care professionals to evaluate, diagnose and treat patients at an affordable price.</p>

                <p>Communicate with doctors or other healthcare professionals from the convenience and privacy of one’s residence, workplace, assisted living facility, or when traveling – as an alternative to in-person visits for both primary and specialty care.</p>

                <p>Tele-medicine gives NAHC members convenient 24/7 access to doctors and other health care professionals to evaluate, diagnose and treat patients at an affordable price.</p>

                <p>The benefits to tele-medicine for our Members is less time away from work, no travel expenses or travel time, less interference with child care or elder care responsibilities, privacy, and no exposure to potentially sick or contagious patients. Communicate with doctors or other healthcare professionals from the convenience and privacy of one’s residence, workplace, assisted living facility, or when traveling – as an alternative to in-person visits for both primary and specialty care.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary">Join Now!</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mem7" tabindex="-1" role="dialog" aria-labelledby="mem7Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mem7Label"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>&nbsp;Personal Healthcare Advocacy </h4>
            </div>
            <div class="modal-body">
                <p>NAHC has partner with two leading Healthcare Advocacy groups, Healthcare Advocates and The Karis Group. Both offer our members concierge services, so members do not have to deal with their healthcare questions and issues alone.</p>

                <p>Advocates often act as a personal healthcare guide, advising on more complex healthcare decisions that might involve physician specialists or surgical procedures as well as lowering medical costs.</p>

                <p>Healthcare Advocacy is a newer discipline in the healthcare field that has evolved out of the need for patients and healthcare customers to better enable them to navigate the increasingly complex healthcare world, medical insurance and claims, and patient rights. NAHC has partnered with two groups to provide patient advocacy services to our Members, Healthcare Advocates and The Karis Group.</p>

                <p>HealthCare Advocates combines the strengths of its experts on staff to offer members such valuable services as medical research, insurance dispute resolution, bills and forms consolidation services, health counselors and more. As a Member of NAHC, when you have medical questions, insurance disputes, questions about coverage, even if you've been denied access for a certain medical procedure, HealthCare Advocates can help.</p>

                <p>Healthcare Advocates has also put together a unique package of information that covers everything from choosing the best healthcare plan to preparing for your hospitalization to your rights as a patient. In addition, they have negotiated special discounts for our members to receive health-related books and other medical publications. Working as a team, HealthCare Advocates' professionals see to it that your health insurance works the way it's supposed to. They will work closely with you and your healthcare insurance company to resolve issues quickly. What's more, you'll be able to tap into the wealth of knowledge and experience of the HealthCare Advocates group through several services offered as part of HealthCare Advocates' membership. The NAHC gold membership plan entitles you to benefits including access to HealthCare Advocates and their services listed below:<br>

                    Healthcare Advocates Services<br>
                Physician Referral Service<br>
                Insurance Disputes Services (fight for payment - insurance appeals & grievances )<br>
                Medical Bill Auditing and Disputes Service<br>
                Medical Bill Auditing and Disputes Service<br>
                Cost Navigator (lower cost procedures)<br>
                Rx Price Comparison<br>
                Medical Research<br>
                Prescription, Dental and Vision Plans<br>
                The Health Counselor (a life coach for your medical needs)<br>
                Bills And Forms Consolidation Services<br>
                Nursing Home, Assisted Living & Hospice Services<br>
                Health Plan Review & Assessment<br>
                Selecting A Health Plan Booklet<br>
                Preparing For Your Hospitalization Booklet<br>
                </p>

                <p>Healthcare isn't as simple as it used to be and getting the best care is getting more difficult. Wouldn't it be nice to have a friend who knows the ins and outs of the healthcare system? When you're a member of NAHC, you do.</p>

                <p>Our partner, The Karis Group is built on the vision to make healthcare work. The Karis Group’s products and services help our Members tackle the stress and expense of the healthcare world today. Within the Karis360 service bundle, they offer an array of cost containment services that will be of benefit to the NAHC members. The Karis360 program offers three services that will help our Members more readily access the healthcare they need, save money on surgical procedures, and better be able to deal with medical bills.</p>

                <p>Karis360 Services<br>
                Healthcare Navigator: With its concierge services, NAHC Members through the Karis Group don’t have to deal with their healthcare questions and issues alone. Karis360 Advisors will assist Members with healthcare needs including finding doctors and healthcare facilities in their area, obtaining best available pricing for procedures and prescriptions and we can even schedule appointments. With Healthcare Navigator, our Members will save time and money.<br>
                Surgery Saver: You need surgery. What’s next? With Karis360, NAHC Members have access to an experienced advisor who will research up to five surgical facilities in the Member’s designated area to get the best available price, quality, physician privileges and availability for non-emergency procedures. With this information, Members can make an informed, money-saving decision.<br>
                Bill Negotiator: With Karis360, NAHC Members are given a dedicated patient advocate who works directly with their healthcare providers to help reduce their out-of-pocket medical bills. Patient advocates can help lower these medical costs to something more manageable for our Members.<br>
                </p>

                <p>Member access to Healthcare Advocacy and the services of Healthcare Advocates and the Karis Group is through the NAHC Gold membership plan at $19.95 per month. Having an advocate on your side can enable you to better navigate the complexities of the healthcare world and better cope with the frustration often felt when dealing with care and treatment decisions, and the financial burden they can bring.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary">Join Now!</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mem8" tabindex="-1" role="dialog" aria-labelledby="mem8Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mem8Label"><span class="glyphicon glyphicon-plus"></span>&nbsp;AnyDoctor</h4>
            </div>
            <div class="modal-body">
                <p>NAHC members can have access to the services of AnyDoctor. Can you imagine having access to any doctor in the country, having someone negotiate the best rates for that doctor for you, getting cash paying discounts, having financing available for your out-of-pocket costs and get all of that in writing? Well, you can. As an NAHC member you have these services available to you through AnyDoctor.</p>
                <h4>Find, schedule and pay for your healthcare!</h4>
                <p>Virtually any doctor is at your fingertips with AnyDoctor. This revolutionary idea works as a concierge service for healthcare consumers. When you need to have a surgical procedure performed, you want the best possible care at the best possible price. That can be easier said than done, because who has the time and resources to contact and negotiate with thousands of doctors around the country? AnyDoctor does, and they will do that for you as a member of NAHC , free of charge.</p>

                <p>AnyDoctor will negotiate a cash price for any non-contracted provider on behalf of the consumer. Personalized concierge service connects consumers with the right doctor, using simplified provider lookup for consumers for all health plan networks. This creates immediate savings for the consumer with no hassles, due to upfront payment and available cash discounts. AnyDoctor allows for full transparency by providing the consumer the cost of service in writing. Over 80% of the time, the cash price negotiated by AnyDoctor from the providers is less than the negotiated price through the large networks.</p>

                <p>In many cases, the patient might not have the upfront resources to make the payment to the provider before medical services are rendered. NAHC members have access to zero interest financing, with no credit underwriting. A third-party financier can make the funds available to the patient, so that they can make their payment upfront to the provider, and receive the cash discount that the provider offers. AnyDoctor is by your side so you don’t have to go through this alone.</p>

                <p>Member access to AnyDoctor and the services they provide is made available through the NAHC Gold membership plan at $19.95 per month.</p>

                <p>The future of healthcare is changing rapidly. Over 35 million Americans have a high deductible health plan. Over 25% of these people do not have emergency funds set aside for healthcare expenses, should the need arise. Having an advocate on your side in AnyDoctor to negotiate your medical costs is a must!</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary">Join Now!</a>
            </div>
        </div>
    </div>
</div>