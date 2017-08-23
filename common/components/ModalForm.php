<?php
/**
 * Copyright (c) 2016-2017 Michael Menefee / CBH
 */

namespace common\components;

use common\assets\ModalFormAsset;
use yii\base\InvalidConfigException;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Class ModalForm
 */
class ModalForm extends Modal
{
    const MODE_SINGLE = 'single';
    const MODE_MULTI = 'multi';

    /**
     * events
     */
    const EVENT_BEFORE_SHOW = 'mfBeforeShow';
    const EVENT_MODAL_SHOW = 'mfShow';
    const EVENT_BEFORE_SUBMIT = 'mfBeforeSubmit';
    const EVENT_MODAL_SUBMIT = 'mfSubmit';

    const EVENT_SHOW_BS_MODAL = 'show.bs.modal';

    /**
     * @var array
     */
    public $events = [];

    /**
     * The selector to get url request when modal is opened for multy mode
     * @var string
     */
    public $selector;

    /**
     * The url to request when modal is opened for single mode
     * @var string
     */
    public $url;

    /**
     * reload pjax container after ajaxSubmit
     * @var string
     */
    public $pjaxContainer;

    /**
     * Submit the form via ajax
     * @var boolean
     */
    public $ajaxSubmit = true;

    /**
     * Auto-close Modal
     * @var boolean
     */
    public $autoClose = false;

    /**
     * @var string
     */
    protected $mode = self::MODE_SINGLE;

    public $captureId;

    public $updateSelect;

    public $parameterId;

    /**
     * Renders the header HTML markup of the modal
     * @return string the rendering result
     */
    protected function renderHeader()
    {
        $button = $this->renderCloseButton();
        if ($button !== null) {
            $this->header = $button . "\n<span>" . $this->header . "</span>\n";
        }
        if ($this->header !== null) {
            Html::addCssClass($this->headerOptions, ['widget' => 'modal-header']);
            return Html::tag('div', "\n" . $this->header . "\n", $this->headerOptions);
        } else {
            return null;
        }
    }

    /**
     * @inheritdocs
     */
    public function init()
    {
        parent::init();
        if (!$this->url && !$this->selector) {
            throw new InvalidConfigException('Must specify one of "Url" or "Selector"');
        }

        if ($this->selector) {
            $this->mode = self::MODE_MULTI;
        }
    }

    /**
     * @inheritdocs
     */
    public function run()
    {
        parent::run();
        /** @var View */
        $view = $this->getView();
        $id = $this->options['id'];

        ModalFormAsset::register($view);

        switch ($this->mode) {
            case self::MODE_SINGLE:
                $this->registerSingleModal($id, $view);
                break;

            case self::MODE_MULTI:
                $this->registerMultiModal($id, $view);
                break;
        }

        if (!isset($this->events[self::EVENT_MODAL_SUBMIT])) {
            $this->defaultSubmitEvent();
        }

        if(isset($this->captureId))
            $this->addBsShowEvent();

        if(isset($this->updateSelect))
            $this->addUpdateSelectOnSubmitEvent();

//        if(isset($this->parameterId))
//            $this->url =

        $this->registerEvents($id, $view);
    }

    /**
     * @param $id
     * @param View $view
     */
    protected function registerSingleModal($id, $view)
    {
        $url = is_array($this->url) ? Url::to($this->url) : $this->url;

        $view->registerJs("
            jQuery('#$id').ModalForm({
                url: '$url',
                ajaxSubmit: $this->ajaxSubmit,
                paramId: '$this->parameterId',
                captureId: '$this->captureId'
            });
        ");
    }

    /**
     * @param $id
     * @param View $view
     */
    protected function registerMultiModal($id, $view)
    {
        $view->registerJs("
            jQuery('body').on('click', '$this->selector', function(e) {
                e.preventDefault();
                $(this).attr('data-toggle', 'modal');
                $(this).attr('data-target', '#$id');
                
                var bs_url = $(this).attr('href');
                var title = $(this).attr('title');
                
                if (!title) title = ' ';
                
                jQuery('#$id').find('.modal-header span').html(title);
                
                jQuery('#$id').ModalForm({
                    selector: $(this),
                    url: bs_url,
                    ajaxSubmit: $this->ajaxSubmit
                });
            });
        ");
    }

    /**
     * register pjax event
     */
    protected function defaultSubmitEvent()
    {
        $expression = [];

        if ($this->autoClose) {
            $expression[] = "$(this).modal('toggle');";
        }

        if ($this->pjaxContainer) {
            $expression[] = "$.pjax.reload({container : '$this->pjaxContainer'});";
        }

        $script = implode(PHP_EOL, $expression);

        $this->events = [
            self::EVENT_MODAL_SUBMIT => new JsExpression("
                function(event, data, status, xhr) {
                    if(status){
                        $script
                    }
                }
            ")
        ];
    }

    /**
     * @param $id
     * @param View $view
     */
    protected function registerEvents($id, $view)
    {
        $js = [];
        foreach ($this->events as $event => $expression) {
            $js[] = ".on('$event', $expression)";
        }

        if ($js) {
            $script = "jQuery('#$id')" . implode(PHP_EOL, $js);
            $view->registerJs($script);
        }
    }

    public function addBsShowEvent()
    {
//        $this->events[ModalForm::EVENT_SHOW_BS_MODAL] =  new JsExpression("function (event) {
////                            console.log('EVENT_SHOW_BS_MODAL');
////                            console.log(this);
//                            var button = $(event.relatedTarget); // Button that triggered the modal
//
//                            window['modal-$this->captureId'] = button.data('$this->captureId'); // Extract info from data-* attributes
//
////                            console.log(window['modal-fieldname']);
//                    }");
    }

    public function addUpdateSelectOnSubmitEvent()
    {
//        $this->events[ModalForm::EVENT_MODAL_SUBMIT] = new JsExpression("
//                        function(event, data, status, xhr, selector) {
//                            console.log(this);
//                            console.log($(this));
//
////                            console.log('EVENT_MODAL_SUBMIT');
////                            console.log(window['modal-fieldname']);
////                            s2Init = s2.data('krajee-select2');
////                            s2Opts = s2.data('s2-options');
//
//                            if(status) {
////                                console.log('EVENT_MODAL_SUBMIT status: '+status);
////                                console.log(data);
////                                console.log(data['uuid']);
//
//                                var sel = $('#'+window['modal-$this->captureId']);
//
//                                $.each(data['values'], function(id, text) {
//                                    var option = new Option(text, id);
////                                    console.log(option);
//                                    sel.append($(option));
//                                });
//
////                                console.log(data['new-val']);
//
//                                sel.val(data['new-val']).change();
//
////                                var s2 = $('#'+window['modal-fieldname']);
////                                s2.refreshDataSelect2(data['values']);
////                                console.log(s2.val());
////                                s2.val(data['uuid']);//.trigger('change');
////                                console.log(s2.val());
//
////                                var sel = document.getElementById(window['modal-fieldname']);
////                                sel.options[sel.options.length]= new Option(data['values'][0]['text'], data['values'][0]['id']);
////                                sel.value = data['new-val'];
//
//
//
//                                $(this).modal('toggle');
//                            } else {
//                                console.log('status == false');
//                            }
//                        }
//                    ");
    }
}