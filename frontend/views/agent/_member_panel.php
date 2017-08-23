<?php
/* @var \common\models\Member $member */
?>

<div class="well">
    <h3><?=$member->nameText?></h3>
    <div class="row">
        <div class="col-sm-5">
            <p><?=$member->address?><br><?=empty($member->address2)?'':$member->address2.'<br>'?><?=$member->city.', '.$member->state->two_letter.' '.$member->zip?></p>
        </div>
        <div class="col-sm-7">
            <?=$member->phoneText?><br>
            <a href="mailto:<?=$member->email?>"><?=$member->email?></a><br>
            <?php //$member->membership->id < \common\models\Membership::MEMBERSHIP_MAX ? Html::a('Upgrade', ['member/upgrade'], ['class' => 'btn btn-primary pull-right']) : '' ?>

        </div>
    </div>
</div>
