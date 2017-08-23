<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Class ModalFormAsset
 */
class ModalFormAsset extends AssetBundle
{
    public $sourcePath = '@common/assets';

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/modal-form.js',
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'css/modal-colors.css',
    ];

//    /**
//     * @inheritdoc
//     */
//    public function init()
//    {
//        $this->sourcePath = __DIR__ . "/assets";
//        parent::init();
//    }
}