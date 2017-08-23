<?php
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $content string */
/* @var \common\components\WizardModel $wm */

if(empty($this->params['modal-size']))
    $modalSize = '';
else
    $modalSize = $this->params['modal-size'];


$cancel_class = $wm->btnClassDisabled;

if($wm->step == 1)  {
    $prev_class = $wm->btnClassDisabled.' disabled';
} else { $prev_class = $wm->btnClass;}

if($wm->step === $wm->steps)    {
    $next_class = $wm->btnClassDisabled.' disabled';
    $finish_class = $wm->btnClass;
} else {
    $next_class = $wm->btnClass;
    $finish_class = $wm->btnClassDisabled.' disabled';
}

if($wm->step == 'finish') {
    $prev_class = $wm->btnClassDisabled.' disabled';
    $next_class = $wm->btnClassDisabled.' disabled';
    $cancel_class = $wm->btnClassDisabled.' disabled';
    $finish_class = $wm->btnClass;
}

$js_vars = "var form = $('#wm-form'), btnCancel = $('#wm-btn-cancel'), btnNext = $('#wm-btn-next'), btnPrev = $('#wm-btn-prev'), btnFinish = $('#wm-btn-finish'), btnStart = $('#wm-btn-start'), action = $('#wizardmodel-action'), step = $('#wizardmodel-step');".PHP_EOL;
$js = "btnCancel.click( function (e) { action.val('cancel'); e.preventDefault(); console.log('CANCEL!'); form.off('submit'); form.submit(); });";
$js2 = "btnPrev.click( function (e) { action.val('prev'); e.preventDefault(); console.log('PREV!'); form.off('submit'); form.submit(); });";
$js3 = "btnNext.click( function (e) { action.val('next'); e.preventDefault(); console.log('NEXT!'); form.submit(); });";

if($wm->step != 'finish')
    $js4 = "btnFinish.click( function (e) { action.val('finish'); e.preventDefault(); console.log('FINISH!'); form.off('submit'); form.submit(); });";
else
    $js4 = null;

$this->registerJs($js_vars.$js.$js2.$js3.$js4, $this::POS_READY, 'wm-btn-script');

?>
<div class="wizard-modal wizard-modal-block ">
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog <?=$modalSize?>" role="document">
            <div class="modal-content">
<?=$content?>
                <div class="modal-footer">
<div class="row">
    <div class="col-xs-3" style="text-align: left;">
        <?=Html::a('Cancel', [$wm->redirect], ['id'=>'wm-btn-cancel', 'class' => 'btn '.$cancel_class]);?>
    </div>
    <div class="col-xs-9" style="text-align:right;">
        <div class="btn-group" role="group">
            <?=Html::a('< Prev', [$wm->redirect], ['id'=>'wm-btn-prev', 'class' => 'btn '.$prev_class]);?>
            <?=Html::submitButton('Next >', ['id'=>'wm-btn-next', 'class' => 'btn '.$next_class, 'name' => 'action', 'val'=>'next', 'disabled' => ($wm->step === $wm->steps?true:false)]);?>
            &nbsp;
        </div>
        <?=Html::a('Finish', [$wm->redirect], ['id'=>'wm-btn-finish', 'class' => 'btn '.$finish_class]);?>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>