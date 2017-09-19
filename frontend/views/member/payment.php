<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\bootstrap\ToggleButtonGroup;
use yii\widgets\MaskedInput;

$this->title = 'Payment Information';

$this->render('_leftnav');


?>

    <h1>Payment Information</h1>
    <p>&nbsp;</p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Current Payment Method</h3>
        </div>
        <div class="panel-body">
            <dl class="dl-horizontal">
                <dt>Payment Type</dt>
                <dd><?= $model->payTypeText ?></dd>
                <dt>Name On Account</dt>
                <dd><?= $model->accountName ?></dd>
            </dl>
            <?php if ($model->pay_type == 1) { ?>
                <dl class="dl-horizontal">
                    <dt>Account Type</dt>
                    <dd><?= $model->acctTypeText ?></dd>
                    <dt>Routing Code</dt>
                    <dd><?= $model->routingText ?></dd>
                    <dt>Account Number</dt>
                    <dd><?= $model->accountText ?></dd>
                </dl>
            <?php } elseif ($model->pay_type == 2) { ?>
                <dl class="dl-horizontal">
                    <dt>Card Number</dt>
                    <dd><?= $model->panText ?></dd>
                    <dt>Expiration Date</dt>
                    <dd><?= $model->exp ?></dd>
                </dl>
            <?php } ?>
        </div>
    </div>
