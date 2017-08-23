<?php
use yii\bootstrap\Collapse;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'NAHC Membership';

$this->render('_leftnav');

$benefitItems = [];
$productItems = [];

foreach($benefits as $benefit) {
    $content = '<h3>'.$benefit->provider->name.'</h3><div class="row">';

    if(empty($benefit->url) || empty($benefit->phone)) {
        $content .= '<div class="col-sm-12">';
    }
    else
    {
        $content .= '<div class="col-sm-6">';
    }

    if(!empty($benefit->phone)) {
        $content .= '<h4>Direct Contact</h4>';

        if ($benefit->benefit_mem_id) {
            $content .= 'MemberID: <b>' . $member->ext_id . '</b><br>';
        }

        if (!empty($benefit->group_data)) {
            $content .= 'Group: <b>' . $benefit->group_data . '</b><br>';
        }

        if (!empty($benefit->other_ref)) {
            $content .= 'Secondary: <b>' . $benefit->other_ref . '</b><br>';
        }

        if (!empty($benefit->phone)) {
            $content .= 'Phone: <b><a href="tel:+1-' . $benefit->phone . '">'. $benefit->phone . '</a></b><br>';
        }

        if (!empty($benefit->email)) {
            $content .= 'Email: <b><a href="mailto:' . $benefit->email . '">' . $benefit->email . '</a></b><br>';
        }
    }

    if(empty($benefit->url)) {
        $content .= '</div></div>';
    } else {
        $content .= '</div><div class="col-sm-6"><h4>Online Access</h4>';

        $content .= 'Website: <a href="'.$benefit->url.'">Connect</a><br>';

        $content .= '</div></div>';
    }


    $benefitItems[] = [
        'label' => $benefit->name,
        'content' => $content,
//        'contentOptions' => [...],
//        'options' => [...],
    ];
}

foreach($upgradeBenefits as $ub) {
    $benefitItems[] = [
        'label' => $ub->name,
        'content' => 'Upgrade today to get access to '.$ub->name.'!',
        'options' => ['class' => 'upgrade'],
    ];
}

foreach($products as $product) {
    $productItems[] = [
        'label' => $product->product->name,
        'content' => 'Coverage Type: '.$product->coverageTypeText.'<br>Coverage Level: '.$product->coverage_level,
    ];

};
?>

<h1>My Membership</h1>
<div class="row indent-left">
    <div class="col-sm-12">

        <div class="well">
            <div class="row">
                <div class="col-sm-5">
                    <h3><?=$member->nameText?></h3>
                    Membership level: <b><?= (empty($member) || empty($member->membership))?'None':$member->membership->name;?></b><br>
                    Active Date: <?=$member->activeDateText?>
                </div>
                <div class="col-sm-7">
<!--                    <a href="--><?//=Url::to(['member/agent'])?><!--" class="btn btn-primary pull-right">Contact Agent</a>-->
                    <h4>My NAHC Agent</h4>
                    <?=$member->agent->nameText?><br>
                    <?=$member->agent->phoneText?><br>
                    <a href="mailto:<?=$member->agent->email?>"><?=$member->agent->email?></a><br>
                    <?php //$member->membership->id < \common\models\Membership::MEMBERSHIP_MAX ? Html::a('Upgrade', ['member/upgrade'], ['class' => 'btn btn-primary pull-right']) : '' ?>

                </div>
            </div>
        </div>
    </div>
</div>

<h3>Benefits</h3>
<div class="row indent-left">
    <div class="col-sm-12">
        <?= Collapse::widget([
//            'autoCloseItems' => false,
            'items' => $benefitItems,
        ]);?>
    </div>
</div>



<h3>Insurance Products</h3>
<div class="row indent-left">
    <div class="col-sm-12">
        <?= Collapse::widget([
//            'autoCloseItems' => false,
            'items' => $productItems,
        ]);?>
    </div>
</div>
<a id="prod" name="prod"></a>