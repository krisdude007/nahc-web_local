<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'cache' => [
                'class' => 'yii\redis\Cache',
                'redis' => [
                    'hostname' => '10.2.2.5',
                    'port' => 6379,
                    'database' => 0,
                ]
        ],
        'e123' => [
            'class' => '\common\components\E123Api',
        ],
    ],
];
