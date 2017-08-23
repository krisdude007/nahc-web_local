<?php
namespace common\assets;

use yii\web\AssetBundle;

/**
 * Class InputMaskPhoneAsset
 *
 */
class InputMaskPhoneAsset extends AssetBundle
{
    /**
     * @var string the directory that contains the source asset files for this asset bundle
     */
    public $sourcePath = '@bower/jquery.inputmask/dist';
    /**
     * @var array list of JavaScript files that this bundle contains
     */
    public $js = [
        'inputmask/phone-codes/phone.js',
    ];

    public $depends = [
        'yii\widgets\MaskedInputAsset',
    ];
}