<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use \yii\helpers\ArrayHelper;

/* @var $products common\models\Product[] */
/* @var $models frontend\models\ProductForm[] */

$this->title = 'Product Confirmation';

$this->render('_leftnav');

$total = 0;
$form = ActiveForm::begin();

//Yii::info('Changed: '.print_r($changed, true));
//Yii::info('Products: '.print_r($products, true));
?>

<h1>Product Confirmation</h1>
<p>Please double check product selections below, and click Purchase to finalize product selections.</p>
<?=$this->render('_member_panel', ['member'=>$member]);?>
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
        foreach($existing as $prod_id => $ext_opt) {
            $product = $products[$prod_id];
            $options = $product->getProductOptions()->indexBy('id')->all();

            Yii::info('Options: '.print_r($options, true));
            Yii::info('ID: '.$prod_id.' - '.print_r($ext_opt, true));

            $option = ArrayHelper::getValue($options, $ext_opt->product_option_id,null);
            if(!empty($option)) {
                $total += $option->price; ?>
                <input type="hidden" name="ProductForm[<?=$prod_id?>][product_option_id]" value="<?=$ext_opt->product_option_id?>">
                <tr>
                    <td style="/*padding-left: 20px;*/">
                        <h5><?=$product->name?></h5>
                        <?=$option->coverageTypeText.' - '.$option->coverage_level?>
                    </td>
                    <td>
                        <h5>&nbsp;</h5>
                        <?=$option->priceText?>
                    </td>
                </tr>
            <?php       }
        } ?>
    <?php } ?>
    <tr>
        <td><h3>New Products</h3></td>
        <td></td>
    </tr>
<?php
    foreach($changed as $prod_id => $mod_opt) {
            $product = $products[$prod_id];
            $options = $product->getProductOptions()->indexBy('id')->all();

            Yii::info('Options: '.print_r($options, true));
            Yii::info('ID: '.$prod_id.' - '.print_r($mod_opt, true));

            $option = ArrayHelper::getValue($options, $mod_opt->product_option_id,null);
            if(!empty($option)) {
                $total += $option->price; ?>
                <input type="hidden" name="ProductForm[<?=$prod_id?>][product_option_id]" value="<?=$mod_opt->product_option_id?>">
                <tr>
                    <td style="/*padding-left: 20px;*/">
                        <h5><?=$product->name?></h5>
                        <?=$option->coverageTypeText.' - '.$option->coverage_level?>
                    </td>
                    <td>
                        <h5>&nbsp;</h5>
                        <?=$option->priceText?>
                    </td>
                </tr>
<?php       }
    } ?>
    <tr style="font-weight: 500;">
        <td>Total</td>
        <td><?='$'.($total/100).' / month'?></td>
    </tr>
    </tbody>
</table>
<div class="form-group">
    <?= Html::submitButton('Purchase', ['class' => 'btn btn-primary pull-right', 'name' => 'product-summary-btn']) ?>
</div>
<?php ActiveForm::end(); ?>