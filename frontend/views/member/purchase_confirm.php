<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use \yii\helpers\ArrayHelper;

/* @var $products common\models\Product[] */
/* @var $models frontend\models\ProductForm[] */

$this->title = 'Confirm Purchase';

$this->render('_leftnav');

$legalText = "By my signature below, I authorize my financial institution to honor pre-authorized debit entries initiated by National Association for Healthcare Consumers (hereafter “NAHC”) on my account for membership dues each month.  I understand that my account will be debited using the information on this form, on the day selected above for each subsequent month hereafter.  I understand that my membership dues electronic funds transfer will continue until written notification has been received by NAHC, requesting cancellation.  When my financial institution honors the electronic funds transfer by debiting my account, such transaction constitutes my receipt for payment.  Should any electronic funds transfer not be honored by said financial institution due to Non-Sufficient Funds (NSF), it is understood that payment is to be made by me in the amount of said payment, plus a service fee.  Such NSF fees will be $25.00 and will be electronically debited from my account.  If subsequent electronic funds transfer is not honored by said financial institution when, I understand that my membership in NAHC and all benefits to which I have enrolled shall be canceled immediately.  I hereby waive any requirement for notification of said cancellation by NAHC to me in the event that my membership dues are not paid as a result of a returned check or NSF notice. I agree not to dispute this recurring billing with my bank so long as the transactions correspond to the terms indicated in this authorization form. If at any time there is a change, deletion, or cancellation of my membership, it is to be submitted in writing to NAHC within 10 days from the day that the electronic funds are to be debited from my account.";

$total = 0;
$form = ActiveForm::begin();
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
        <?php if(!empty($existing)) { ?>
            <tr>
                <td><h3>Existing Products</h3></td>
                <td></td>
            </tr>
            <?php
            foreach($existing as $prod_id => $opt) {
                    $total += $opt->price; ?>
                    <tr>
                        <td style="/*padding-left: 20px;*/">
                            <h5><?=$opt->product->name?></h5>
                            <?=$opt->coverageTypeText.' - '.$opt->coverage_level?>
                        </td>
                        <td>
                            <h5>&nbsp;</h5>
                            <?=$opt->priceText?>
                        </td>
                    </tr>
                <?php       }
            }

        $total += $model->option->price;
?>
        <tr>
            <td><h3>New Products</h3></td>
            <td></td>
        </tr>
        <tr>
            <td style="/*padding-left: 20px;*/">
                <input type="hidden" name="PurchaseForm[product_option_id]" value="<?=$model->product_option_id?>">
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
            <td><?='$'.($total/100).' / month'?></td>
        </tr>
        </tbody>
    </table>
    <?= Html::textarea('legal', $legalText, ['rows' => '6', 'style' => 'width: 100%;', 'readonly' => true]); ?>
    <?= $form->field($model, 'agree')->checkbox(['label' => 'I agree to the terms and conditions']);?>
    <div class="form-group text-right">
        <?= Html::submitButton('Purchase Products', ['class' => 'btn btn-primary', 'name' => 'purchase-confirm-btn']) ?>
    </div>
<?php ActiveForm::end(); ?>
<br>
<br>
