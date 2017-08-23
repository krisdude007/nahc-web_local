<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'cache' => [
                'class' => 'yii\redis\Cache',
        ],
        'e123' => [
            'class' => '\common\components\E123Api',
        ],
    ],
];
