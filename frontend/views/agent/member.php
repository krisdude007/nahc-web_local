<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Member */
/* @var $productOptions common\models\ProductOption */

$this->title = 'Member Details';
//$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

$this->render('_leftnav');
?>
<div class="member-view">

    <h1>Member Details</h1>

    <p>
        <?= Html::a('Update', ['agent/member-detail', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Change Plan', ['agent/member-plan', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //=Html::a('Update Payment Info', ['agent/member-payment', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Add Products', ['agent/products', 'member_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update Dependents', ['agent/dependents', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Member Details</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <?= $model->f_name ?>
                </div>
                <div class="col-sm-3">
                    <?= $model->m_name ?>
                </div>
                <div class="col-sm-5">
                    <?= $model->l_name ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <?= ($model->gender == 'M'?'Male':'Female')?>
                </div>
                <div class="col-sm-4">
                    <?= $model->dobText ?>
                </div>
                <div class="col-sm-5">
                    <?= $model->ssnText ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Contact Information</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <?=$model->email?>
                </div>
                <div class="col-sm-6">
                    <?=$model->phoneText?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Mailing Address</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?= $model->address ?>
                </div>
                <div class="col-sm-12">
                    <?= $model->address2 ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <?= $model->city ?>
                </div>
                <div class="col-sm-3">
                    <?= $model->state->name ?>
                </div>
                <div class="col-sm-4">
                    <?= $model->zip ?>
                </div>
            </div>
        </div>
    </div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Membership & Products</h3>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Coverage</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total = $model->membership->price;
//        Yii::info('ProdOpts: '.print_r($productOptions, true));?>
        <tr>
            <td style="/*padding-left: 20px;*/">
                <h5>NAHC Membership</h5>
                <?=$model->membership->name?>
            </td>
            <td>
                <h5>&nbsp;</h5>
                <?=$model->membership->priceText?>
            </td>
        </tr>
<?php foreach($productOptions as $option) {
                $product = $option->product;
                $total += $option->price;
                ?>
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
                <?php
        } ?>
        <tr style="font-weight: 500;">
            <td>Total</td>
            <td><?='$'.($total/100).' / month'?></td>
        </tr>
        </tbody>
    </table>
</div>