<?php
use yii\bootstrap\Html;

$this->title = 'Upgrade Membership';
?>

<h1>Upgrade Membership</h1>

<div class="well">
    <p class="lead">Contact your NAHC agent to upgrade your membership today!</p>
    <?=  Html::a('Contact Agent', ['member/contact'], ['class' => 'btn btn-success'])?>
</div>