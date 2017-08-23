<?php
use common\models\Product;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/* @var $this \yii\web\View */
/* @var $products Product[] */

$this->render('_leftnav');

$form = ActiveForm::begin();

$js = "$('.table-hover tr').click(function() {
        $(this).find('td input[type=radio]').prop('checked', true);
    })";

$this->registerJs($js,View::POS_READY);?>

<h1>Edit Member Products</h1>
<p>Select products and coverage levels below, and click Save to continue.</p>
<?=$this->render('_member_panel', ['member'=>$member]);?>

<?php foreach($products as $product) { ?>
    <input type="hidden" name="ProductForm[<?=$product->id?>][product_option_id]" value="0">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?=$product->name?></h3>
        </div>
        <table class="table table-hover" id="productform-<?=$product->id?>-product_option_id">
            <thead>
                <tr>
                    <th>Coverage</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php if(empty($models[$product->id]->product_option_id)) { ?>
                <tr class="radio" style="display: table-row;" role="button">
                    <td>
                        <label><input type="radio" name="ProductForm[<?=$product->id?>][product_option_id]" value="0" <?=(0==$models[$product->id]->product_option_id?'checked':null)?>>None</label>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr>
        <?php   }?>
            <?php foreach($product->productOptionGroups as $optionGroup => $optionSet) { ?>
                <tr class="no-hover">
                    <td><?=$optionGroup?></td>
                    <td></td>
                </tr>
                <?php foreach($optionSet as $optionId => $option) {
                    $itemLabel = explode('--', $option->optionText);
                ?>
                    <tr class="radio" style="display: table-row;" role="button">
                        <td>
                            <label><input type="radio" name="ProductForm[<?=$product->id?>][product_option_id]" value="<?=$optionId?>" <?=($optionId==$models[$product->id]->product_option_id?'checked':null)?>><?=$itemLabel[0]?></label>
                        </td>
                        <td>
                            <?=$itemLabel[1]?>
                        </td>
                    </tr>
            <?php   }
                } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary pull-right', 'name' => 'product-button']) ?>
    </div>
<?php
ActiveForm::end();
?>