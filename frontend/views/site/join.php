<?php
use common\components\GeographicUtils;
use common\models\State;
use yii\bootstrap\ToggleButtonGroup;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\MaskedInput;

/* @var $wm common\components\WizardModel  */
/* @var $model frontend\models\MemberForm  */

$this->title = 'Join NAHC';

\common\assets\InputMaskPhoneAsset::register($this);

//if(!empty($inviteCode)) {
//    if(empty($model->firstName))
//        $model->firstName = $inviteCode->fname;
//
//    if(empty($model->lastName))
//        $model->lastName = $inviteCode->lname;
//
//    if(empty($model->email))
//        $model->email = $inviteCode->email;
//}

$memberLegal = "MEMBER TERMS AND ACKNOWLEDGMENT OF NAHC MEMBERSHIP
I understand that by signing below, I am enrolling in a membership in the National Association for Healthcare Consumers (NAHC). I understand that membership, and access to the membership benefits, will begin on the 1st day of the 1st month immediately following the date my application is received and accepted by NAHC. I understand that NAHC is not an insurance company or insurance program. Insurance benefit payments are made by the administrator for the insurance company or the insurance company issuing the coverage for NAHC members. Healthcare professionals providing health care services receive no reimbursement from NAHC. I understand that NAHC provides benefits and services to its members through a number of third parties. Benefits and services may be modified through additions or deletions at NAHC's discretion. I understand that my membership identification cards will be delivered to me via email at the email address provided during my enrollment and that I will access all membership benefits and services by logging in to my personalized membership website.

THIS AGREEMENT CONTAINS A BINDING ARBITRATION PROVISION WHICH AFFECTS YOUR LEGAL RIGHT AND MAY BE ENFORCED BY THE PARTIES.
I understand that if any dispute, controversy or claim concerning my membership cannot by resolved through direct discussion between me and NAHC, then the dispute, controversy or claim shall be submitted to binding arbitration in Dallas, Texas. Such arbitration shall be conducted pursuant to the rules of the American Arbitration Association. Each party shall be responsible for its own fees and costs except that the arbitrator may, in the arbitrator's sole discretion, require that the losing party pay the prevailing party all or some portion of the prevailing party's attorney fees and arbitration costs.
The parties agree to abide by all decisions and awards rendered in such proceedings. Such decisions and awards rendered by the arbitrator shall be final and conclusive. All such controversies, claims or disputes shall be settled in this manner in lieu of any action at law or equity; provided however, that nothing in this subsection shall be construed as precluding the bringing an action for injunctive relief or other equitable relief. The arbitrator shall not have the right to award punitive damages or speculative damages to either party and shall not have the power to amend this Agreement. The arbitrator shall be required to follow applicable law. IF FOR ANY REASON THIS ARBITRATION CLAUSE BECOMES NOT APPLICABLE, THEN EACH PARTY, TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, HEREBY IRREVOCABLY WAIVES ALL RIGHT TO TRIAL BY JURY AS TO ANY ISSUE RELATING HERETO IN ANY ACTION, PROCEEDING, OR COUNTERCLAIM ARISING OUT OF OR RELATING TO THIS AGREEMENT OR ANY OTHER MATTER INVOLVING THE PARTIES HERETO.

REVOCABLE PROXY
In consideration of my membership in NAHC and my desire to be represented at meetings of members, I hereby appoint the Secretary of NAHC to cast any votes I would be entitled to cast if personally present, on any and all matters, from time to time, and from year to year, until this proxy is cancelled by writing delivered to NAHC, said type of writing to include a subsequently issued proxy. I expressly authorize such Secretary to cast my vote or votes.

ELECTRONIC SIGNATURE AGREEMENT
Your consent to this electronic transaction covers your Acknowledgement of NAHC Membership, as well as your receipt of disclosures, agreements or other notices related to that transaction. The transaction and related disclosures, agreements, and notices are referred to as \"Electronic Records.\" You agree that the documents related to that transaction will be in electronic form only, and that NAHC may provide Electronic Records as NAHC elects based on your consent. Electronic Records will not be distributed in paper unless you contact NAHC Agent Services and request a paper version of a particular Electronic Record.
If you request a paper copy of a particular Electronic Record, the paper copy will be mailed to you at no charge. To obtain a paper copy of an Electronic Record you may contact NAHC.
At any point in this process, you will be able to print and read the information that is presented to you using your browser print option.
At any time prior to submitting your electronic signature, you may opt out of the electronic signature process and continue with a paper process.

To sign electronically, you will be prompted to enter your name and the date you signed the request. This information will appear on the electronic document along with the words \"Electronically Signed.\" You will be prompted to enter the password you created for your NAHC agent account. Selecting \"Submit\" completes the electronic signature process.

After signing the document, you should print a copy for your records. Note: The document you print upon completion of the electronic-sign process may not be a complete version of the Electronic Record due to system limitations and differences of technology. Upon acceptance by NAHC, you will receive a true and exact copy of the Electronic Record by email.
You may withdraw your consent to receive Electronic Records at any time. Regardless, the NAHC Marketing Agent Agreement you signed electronically will be enforceable. To withdraw consent, please contact NAHC Agent Services.

To conduct transactions electronically you will need the following minimum hardware and software, which you acknowledge having by proceeding with this transaction and giving us your consent:
•	Access to the Internet
•	A Web Browser (Microsoft Internet Explorer 11.0 or higher, Google Chrome, or Mozilla Firefox are recommended.
•	You may need additional software to view or print your electronic record.
•	Documents are presented in an Adobe portable document format (.pdf) and can be viewed by using the free Adobe Reader.
•	Click here to download a free copy of Adobe Reader: http://get.adobe.com/reader/
•	You can test your ability to open .pdf documents by clicking the test link here

If we change the minimum hardware and/or software requirements, we will notify you of the changes. If you cannot access or retain Electronic Records as a result, you will have the right to withdraw your consent with respect to Electronic Records without incurring any fees or being subject to any new conditions not previously disclosed to you.
You agree to ensure NAHC has the correct information to contact you electronically (e.g. providing any changes in e-mail address)
By electronically signing my name below, I agree to the above terms and conditions above. By clicking the Continue link below, I hereby consent to the use of my electronic signature to execute the Enrollment Form. I understand that my electronic signature will have the same legal effect, validity and enforceability as if I were to execute by handwritten signature.

SIGNATURE
By electronically signing my name below, I agree to the above terms and authorize immediate payment of the membership dues detailed herein. By clicking the Continue link below, I hereby consent to the use of my electronic signature to execute the Enrollment Form. I understand that my electronic signature will have the same legal effect, validity and enforceability as if I were to execute by handwritten signature.";

$payLegal = "By my signature below, I authorize my financial institution to honor pre-authorized debit entries initiated by National Association for Healthcare Consumers (hereafter “NAHC”) on my account for membership dues each month.  I understand that my account will be debited using the information on this form, on the day selected above for each subsequent month hereafter.  I understand that my membership dues electronic funds transfer will continue until written notification has been received by NAHC, requesting cancellation.  When my financial institution honors the electronic funds transfer by debiting my account, such transaction constitutes my receipt for payment.  Should any electronic funds transfer not be honored by said financial institution due to Non-Sufficient Funds (NSF), it is understood that payment is to be made by me in the amount of said payment, plus a service fee.  Such NSF fees will be $25.00 and will be electronically debited from my account.  If subsequent electronic funds transfer is not honored by said financial institution when, I understand that my membership in NAHC and all benefits to which I have enrolled shall be canceled immediately.  I hereby waive any requirement for notification of said cancellation by NAHC to me in the event that my membership dues are not paid as a result of a returned check or NSF notice. I agree not to dispute this recurring billing with my bank so long as the transactions correspond to the terms indicated in this authorization form. If at any time there is a change, deletion, or cancellation of my membership, it is to be submitted in writing to NAHC within 10 days from the day that the electronic funds are to be debited from my account.";

?>

<?php $this->beginContent($wm->viewBase, ['wm' => $wm]);

$form = ActiveForm::begin([
    'id' => 'wm-form',
    //'enableClientValidation'=> true,
    //'enableAjaxValidation'=> false,
    //'validateOnSubmit' => false,
    //'validateOnChange' => false,
    //'validateOnType' => false,
    ////    'options' => ['class' => 'form-horizontal'],
    //'fieldConfig' => [
    //'options' => [
    //'tag' => false,
    //],
    //],
]);

echo $form->field($wm, 'step')->hiddenInput()->label(false)->hint(false);
echo $form->field($wm, 'action')->hiddenInput()->label(false)->hint(false);
echo $form->field($wm, 'data')->hiddenInput()->label(false)->hint(false);

?>

<?php switch ($wm->step):?>
<?php case 1:
    $plans = \common\models\Membership::find()->active()->all();
    $planOpts = [];

    foreach($plans as $p) {
        $planOpts[$p->id] = '<div class="wizard-plan-title">'.$p->name.'</div><div class="wizard-plan-price">'.$p->priceText.'</div>';
    }
    ?>
<div class="modal-header">
    <h3 class="modal-title">Step 1 - Select Membership Plan</h3>
    <p>Please select a membership plan</p>
</div>
<div class="modal-body">
    <?php

    if(empty($model->plan))
        $model->plan = $plan;

    echo $form->field($model, 'plan', ['enableLabel' => false,'options'=>['style'=>'width:100%;']])->widget(ToggleButtonGroup::classname(), [
            'type' => 'radio',
            'items' => $planOpts,
//                [
//                    [
//                            'value' => '1',
//                        'label' => 'Basic<br>Free',
//                    ],
//                [
//                    'value' => '2',
//                    'label' => 'Basic<br>Free',
//                ],
//                [
//                    'value' => '3',
//                    'label' => 'Basic<br>Free',
//                ],
//                [
//                    'value' => '4',
//                    'label' => 'Basic<br>Free',
//                ],



//                '1' => '<div class="wizard-plan-title">Basic</div><div class="wizard-plan-price">Free</div>',
//                '2' => '<div class="wizard-plan-title">Basic+</div><div class="wizard-plan-price">$7.95/mo</div>',
//                '3' => '<div class="wizard-plan-title">Advocate</div><div class="wizard-plan-price">$14.95/mo</div>',
//                '4' => '<div class="wizard-plan-title">Advocate+</div><div class="wizard-plan-price">$19.95/mo</div>',
//            ],
        'labelOptions' => ['class' => 'btn-primary'],
        'options' => ['class' => 'plan-full-width'],
        'encodeLabels' => false,
        ]);?>
</div>
    <?php break; case 2: ?>
        <div class="modal-header">
            <h3 class="modal-title">Step 2 - Login</h3>
            <p>Select a username and password that you will use to log into the site.</p>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-4"><?= $form->field($model, 'username'); ?></div>
                <div class="col-sm-8"><?= $form->field($model, 'email'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-6"><?= $form->field($model, 'password')->passwordInput(); ?></div>
                <div class="col-sm-6"><?= $form->field($model, 'repeat_password')->passwordInput(); ?></div>
            </div>




        </div>

<?php /*            <div class="section-divider"></div>
            <div class="row ">
                <div class="col-sm-2 row-label">Type</div>
                <div class="col-sm-10">

                </div>
            </div>

        </div> */
?>

        <?php break; case 3:
        $this->params['modal-size'] = 'modal-lg';?>
        <div class="modal-header">
            <h3 class="modal-title">Step 3 - Member Information</h3>
            <p>Tell us about yourself</p>
        </div>
        <div class="modal-body">

            <div class="row ">
                <div class="col-sm-4">
                    <?= $form->field($model, 'f_name'); ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'm_name'); ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($model, 'l_name'); ?>
                </div>
            </div>
            <div class="section-divider"></div>
            <div class="row ">
                <div class="col-sm-3">
                    <?php //echo $form->field($model, 'dobText', ['inputOptions' => ['placeholder' => 'mm/dd/yyyy']]);  ?>
                    <?= $form->field($model, 'dobText')->widget(MaskedInput::className(),['clientOptions'=>['alias'=>'mm/dd/yyyy']]);  ?>
                    <?php //$form->field($model, 'email')->widget(MaskedInput::className(),['clientOptions'=>['alias'=>'email']]); ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'gender')->dropDownList(['M' => 'Male', 'F' => 'Female'],['prompt' => 'Gender']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'ssn')->widget(MaskedInput::className(),['mask' => '999-99-9999','clientOptions'=>['autoUnmask'=>true,'removeMaskOnSubmit'=>true]]); ?>

                </div>
            </div>

        </div>
        <?php break; case 4:
        $this->params['modal-size'] = 'modal-lg';?>
        <div class="header-primary modal-header">
            <h3 class="modal-title">Step 4 - Contact Information</h3>
            <p>Help us keep in touch</p>
        </div>
        <div class="modal-body">
            <div class="section-divider"></div>
            <div class="row ">
                <div class="col-sm-5">
                    <?= $form->field($model, 'phone')->widget(MaskedInput::className(),['mask' => '(###)###-####','clientOptions'=>['alias' => 'phone','autoUnmask'=>true,'removeMaskOnSubmit'=>true,]]); ?>
                </div>
                <div class="col-sm-7">
                    <?= $form->field($model, 'email')->textInput(['disabled' => true]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'address'); ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'address2'); ?>
                </div>
            </div>
            <div class="row ">

                        <div class="col-sm-5">
                            <?= $form->field($model, 'city'); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'state_id')->dropDownList(State::getStateList(),['prompt' => 'State']);
                            /*->widget(Select2::className(),[
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'data'=> GeographicUtils::getStates(),
                            'options' => ['placeholder' => 'Select State'],
                            'changeOnReset' => true,
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],]); */?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($model, 'zip')->widget(MaskedInput::className(),['mask' => '99999']); ?>
                        </div>

            </div>
        </div>

        <?php break; case 5:
        $this->params['modal-size'] = 'modal-lg';?>
        <div class="header-primary modal-header">
            <h3 class="modal-title">Step 5 - Payment Information</h3>
            <p>Enter your payment information below.</p>
        </div>
        <div class="modal-body">
            <div class="row ">
                <div class="col-sm-12">
                    <?php $this->registerJs('document.selPay = function (btn) { 
                        if(btn.childNodes[0].getAttribute("value") == 1) {
                            $("#bankPanel").show();
                            $("#cardPanel").hide();
                        } 
                        
                        if(btn.childNodes[0].getAttribute("value") == 2) {
                           $("#bankPanel").hide();
                           $("#cardPanel").show();
                        }
                        
                        $("#acctName").show();
                     
                     };'); ?>
                    <?= $form->field($model, 'pay_type')->widget(ToggleButtonGroup::className(), [
                        'type' => 'radio',
                        'items' => [
                            1 => 'Bank Account',
                            2 => 'Credit Card',
                        ],
                        'labelOptions' => ['class' => 'btn-primary', 'onclick' => 'document.selPay(this)'],
                        'options' => ['class' => 'plan-full-width'],
                        ]);?>
                </div>
            </div>
            <div class="row" id="acctName" style="<?=(!empty($model->pay_type)?'':'display:none;')?>">
                <?php
                if(empty($model->acct_f_name))
                    $model->acct_f_name = $model->f_name;

                if(empty($model->acct_l_name))
                    $model->acct_l_name = $model->l_name;
                ?>
                <div class="col-sm-6">
                    <?= $form->field($model, 'acct_f_name') ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'acct_l_name') ?>
                </div>
            </div>
            <div class="section-divider"></div>
            <div class="row" id="cardPanel" style="<?=($model->pay_type == 2?'':'display:none;')?>">
                        <div class="col-sm-5">
                            <?= $form->field($model, 'pan')->widget(MaskedInput::className(),['mask' => ['x### ###### #####', 'o### #### #### ####'],
                                    'definitions' => [
                                        'x' => [
                                            'validator' =>  '3',
                                            'cardinality' => 1,
                                        ],
                                        'o' => [
                                            'validator' =>  '[456]',
                                            'cardinality' => 1,
                                        ],
                                    ],
                                    'clientOptions'=>['autoUnmask'=>true,'removeMaskOnSubmit'=>true,]
                                ]); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'exp')->widget(MaskedInput::className(),[
//                                'aliases' => [
//                                        'mm/yy' => [
//                                            'mask' => "1/y",
//                                            'placeholder' => "mm/yy",
//                                            'leapday' => "donotuse",
//                                            'separator' => "/",
//                                            'alias' => "mm/dd/yyyy",
//                                        ]
//                                ],
                                'clientOptions'=>['alias' => 'mm/yyyy',],
                            ]); ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($model, 'cvv')->widget(MaskedInput::className(),['mask' => '999[9]']); ?>
                        </div>
            </div>
            <div class="row" id="bankPanel" style="<?=($model->pay_type == 1?'':'display:none;')?>">
                        <div class="col-sm-3">
                            <?= $form->field($model, 'account_type')->dropDownList([1 => 'Checking', 2 => 'Savings'],['prompt' => 'Type']); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'routing')->widget(MaskedInput::className(),['mask' => '999999999', 'clientOptions' => [
                                    'autoUnmask' => true,
                                'onBeforeWrite' =>
                            new \yii\web\JsExpression('function (event, buffer) { 
                            var pad = \'000000000\';
                            if (event.type !== \'blur\') { return {}; }; 
                            var filteredValue = buffer.filter(function(e) { return e !== \'_\' });
                            var currentValue = filteredValue.join(\'\'); 
                            var subBuf = ( pad + currentValue).substr(currentValue.length, pad.length); 
                            return { refreshFromBuffer: true, buffer: subBuf.split(\'\') };}'),]]); ?>
                        </div>
                        <div class="col-sm-5">
                            <?= $form->field($model, 'account')->widget(MaskedInput::className(),['mask' => '9999[9999999999999]']); ?>
                        </div>
            </div>
        </div>

        <?php break; case 6: ?>
        <div class="modal-header">
            <h3 class="modal-title">Step 6 - Agreements</h3>
            <p>Please review and agree to the following terms & conditions</p>

        </div>
        <div class="modal-body">
            <h4>Payment Terms & Conditions</h4>
            <textarea class="form-control" rows="3"><?=$memberLegal?></textarea>
            <?=$form->field($model, 'agree_member')->checkbox()->label('Agree to Membership Terms & Conditions')?>
            <br>
            <h4>Payment Terms & Conditions</h4>
            <textarea class="form-control" rows="3"><?=$payLegal?></textarea>
            <?=$form->field($model, 'agree_pay')->checkbox()->label('Agree to Payment Terms & Conditions')?>
        </div>

        <?php break; case 7:
        $this->params['modal-size'] = 'modal-lg';?>
        <div class="modal-header">
            <h2 class="modal-title">Summary</h2>
            <p>Please double-check the information below, and then push Finish to complete the registration process.</p>
        </div>
        <div class="modal-body">
            <h4>Membership</h4>
            <hr>
            <div class="row">
                <?php
                $selPlan = \common\models\Membership::find()->where(['id'=>$model->plan])->active()->one();

                if(!empty($selPlan)) { ?>

                    <div class="col-sm-6">
                        <div class="form-group field-joinform-plan">
                            <label class="control-label" for="joinform-plan">Membership Plan</label>
                            <p class="form-control-static"><?=$selPlan->name?></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group field-joinform-plan">
                            <label class="control-label" for="joinform-plan">Membership Price</label>
                            <p class="form-control-static"><?=$selPlan->priceText?></p>
                        </div>
                    </div>
                <?php }  ?>

            </div>

            <h4>Account</h4>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <?=$form->field($model,'username',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-6">
                    <?=$form->field($model,'passwordText',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
            </div>

            <h4>User Profile</h4>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <?=$form->field($model,'nameText',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-4">
                    <?=$form->field($model,'dobText',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-4">
                    <?=$form->field($model,'ssnText',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-4">
                    <?=$form->field($model,'phoneText',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-4">
                    <?=$form->field($model,'email',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-4">
                    <div class="form-group field-joinform-addresstext">
                        <label class="control-label" for="joinform-addresstext">Address</label>
                        <address class="form-control-static">
                            <?=$model->getAddressText(true)?>
                        </address>
                    </div>
                </div>
            </div>

            <h4>Payment Information</h4>
            <hr>
            <div class="row">
                <?php if($model->pay_type == 1) {?>
                    <div class="col-sm-4">
                    <div class="form-group field-joinform-paytype">
                        <label class="control-label" for="joinform-paytype">Method</label>
                        <p class="form-control-static"> Bank Draft </p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?=$form->field($model,'accountName',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-4">
                    <div class="form-group field-joinform-accounttype">
                        <label class="control-label" for="joinform-accounttype">Type</label>
                        <p class="form-control-static"><?=($model->account_type == 1?'Checking':'Savings')?></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?=$form->field($model,'routingText',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-6">
                    <?=$form->field($model,'accountText',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <?php } elseif($model->pay_type == 2) {?>
                <div class="col-sm-6">
                    <div class="form-group field-joinform-paytype">
                        <label class="control-label" for="joinform-paytype">Method</label>
                        <p class="form-control-static"> Credit Card </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?=$form->field($model,'accountName',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-6">
                    <?=$form->field($model,'panText',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <div class="col-sm-6">
                    <?=$form->field($model,'exp',['template' => "{label}\n{input}"])->staticControl()?>
                </div>
                <?php } ?>
            </div>
        </div>



        <?php break; case 'finish': ?>
        <div class="modal-header">
            <h2 class="modal-title">Complete</h2>

        </div>
        <div class="modal-body">
            <p class="lead">Welcome to the<br>National Association for Healthcare Consumers</p>
            <p>Thank you for your enrollment in NAHC.  We believe that you will find our products and services to be very beneficial.</p>
            <p>Your account is now active, and we are in the process of activating your membership benefits.  Click "Finish" to visit your new, personalized membership page.</p>
        </div>

        <?php break; endswitch; ?>

<?php ActiveForm::end() ?>

<?php $this->endContent(); ?>


