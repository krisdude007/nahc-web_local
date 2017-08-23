<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\MaskedInput;

//$this->render('_leftnav');
$this->title = 'Purchase Product';

//JS Function
$js = "$('.table-hover tr').click(function() {
        $(this).find('td input[type=radio]').prop('checked', true);
    })";

$this->registerJs($js,View::POS_READY);

$optionList = $model->getOptionList();

$legalText = "By my signature below, I authorize my financial institution to honor pre-authorized debit entries initiated by National Association for Healthcare Consumers (hereafter “NAHC”) on my account for membership dues each month.  I understand that my account will be debited using the information on this form, on the day selected above for each subsequent month hereafter.  I understand that my membership dues electronic funds transfer will continue until written notification has been received by NAHC, requesting cancellation.  When my financial institution honors the electronic funds transfer by debiting my account, such transaction constitutes my receipt for payment.  Should any electronic funds transfer not be honored by said financial institution due to Non-Sufficient Funds (NSF), it is understood that payment is to be made by me in the amount of said payment, plus a service fee.  Such NSF fees will be $25.00 and will be electronically debited from my account.  If subsequent electronic funds transfer is not honored by said financial institution when, I understand that my membership in NAHC and all benefits to which I have enrolled shall be canceled immediately.  I hereby waive any requirement for notification of said cancellation by NAHC to me in the event that my membership dues are not paid as a result of a returned check or NSF notice. I agree not to dispute this recurring billing with my bank so long as the transactions correspond to the terms indicated in this authorization form. If at any time there is a change, deletion, or cancellation of my membership, it is to be submitted in writing to NAHC within 10 days from the day that the electronic funds are to be debited from my account.";

$form = ActiveForm::begin([
    'enableClientValidation'=> false,
    'enableAjaxValidation'=> false,
//    'layout' => 'horizontal',
//    'fieldConfig' => [
//        'horizontalCssClasses' => [
//            'label' => 'col-sm-3 col-md-3',
//            'offset' => 'col-sm-offset-2 col-md-offset-2',
//            'wrapper' => 'col-sm-6 col-md-4',
//        ],
//    ],
]);

?>
    <input type="hidden" name="PurchaseForm[product_option_id]" value="<?=$model->product_option_id?>">


<?php if(empty($model->product_option_id)) { ?>
    <h1>Purchase Product</h1>
    <p>Select a coverage level below</p>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?=$model->productName?></h3>
            </div>
<!--            <div class="panel-body">-->
<!--                --><?php ////$form->field($model, 'product_option_id')->radioList($optionSet, ['unselect' => null,]);?>
<!--            </div>-->
                <table class="table table-hover" id="purchaseform-product_option_id">
                    <thead>
                        <tr>
                            <th>Coverage</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($optionList as $optionSetKey => $optionSet) { ?>
                    <tr class="no-hover">
                        <td><?= $optionSetKey ?></td>
                        <td></td>
                    </tr>
                    <?php foreach ($optionSet as $optionVal => $optionName) {
                        $itemLabel = explode('--', $optionName);
                        ?>
                        <tr class="radio" style="display: table-row;" role="button">
                            <td>
                                <label><input type="radio" name="PurchaseForm[product_option_id]"
                                              value="<?= $optionVal ?>" <?= ($optionVal == $model->product_option_id ? 'checked' : null) ?>><?= $itemLabel[0] ?>
                                </label>
                            </td>
                            <td>
                                <?= $itemLabel[1] ?>
                            </td>
                        </tr>
                        <?php // $form->field($model, 'product_option_id', ['template' => "<div class=\"radio\">\n{input}\n{label}\n{error}\n{hint}\n</div>"])->input('radio', ['value'=>$optionVal, 'label'=>$optionName]); ?>
                        <?php //$form->field($model, 'product_option_id')->radio(['label'=>$optionName, 'value'=>$optionVal, 'uncheck'=>null,]);?>
                    <?php }
                } ?>
                </tbody>
                </table>

        </div>
<?php
        //echo $form->field($model, 'product_option_id')->hiddenInput()->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Purchase', ['class' => 'btn btn-primary pull-right', 'name' => 'purchase-button']) ?>
    </div>
    <?php

} elseif(!empty($model->option)) {

    ?>
    <h1>Confirm Purchase</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Coverage</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td style="/*padding-left: 20px;*/">
                    <h5><?=$model->option->product->name?></h5>
                    <?=$model->option->coverageTypeText.' - '.$model->option->coverage_level?>
                </td>
                <td>
                    <h5>&nbsp;</h5>
                    <?=$model->option->priceText?>
                </td>
            </tr>
            <tr style="font-weight: 500;">
                <td>Total</td>
                <td><?=$model->option->priceText?></td>
            </tr>
        </tbody>
    </table>
    <?= Html::textarea('legal', $legalText, ['rows' => '6', 'style' => 'width: 100%;', 'readonly' => true]); ?>
    <?= $form->field($model, 'agree')->checkbox(['label' => 'I agree to the terms and conditions']);?>
    <div class="form-group">
        <?= Html::submitButton('Purchase', ['class' => 'btn btn-primary pull-right', 'name' => 'purchase-confirm-btn']) ?>
    </div>
    <?php  ?>
<?php
}
ActiveForm::end();?>