<?php

$this->render('_leftnav');

?>

<h1>Agent Dashboard</h1>
<div class="well">
    <h3><?=$model->nameText?></h3>
    <div class="row">
        <div class="col-sm-6">
            <address>
                <?=$model->address?><br>
                <?=(empty($model->address2)?'':$model->address2.'<br>')?>
                <?=$model->city?>,&nbsp;<?=$model->stateText?>&nbsp;<?=$model->zip?>
            </address>
        </div>
        <div class="col-sm-6">
            <p><?=$model->phoneText?><br>
                <?=$model->email?>
            </p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Members</h3>
            </div>
            <div class="panel-body" style="text-align: center;">
                <h1><?=$model->getMembers()->count()?></h1>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Agents</h3>
            </div>
            <div class="panel-body" style="text-align: center;">
                <h1><?=$model->getAgents()->count()?></h1>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Messages</h3>
    </div>
    <div class="panel-body" style="text-align: center;">
        <br>
        <br>
        <br>
    </div>
</div>