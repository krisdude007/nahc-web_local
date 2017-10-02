<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'join/<plan:[1-4]>' => 'site/join',
                'products/<product_id:([0-9]{1,2})>' => 'site/products',
                '<ctrl:(member|agent|provider)>' => '<ctrl>/index',
                'member/upgrade/<plan:[1-4]>' => 'member/upgrade',
                'member/purchase/<product_id:[0-9]{1,4}>' => 'member/purchase',
                'member/<action:(index|details|dependents|dependent|add-dependent|contact|user|payment|upgrade|purchase)>' => 'member/<action>',
                'agent/products/<member_id:[0-9]{1,10}>' => 'agent/products',
                'agent/member/<id:[0-9]{1,10}>' => 'agent/member',
                'agent/<action:(index|details|enroll|agents|members|member|member-detail|member-plan|products)>' => 'agent/<action>',
                'agent/dependents/<id:[0-9]{1,10}>' => 'agent/dependents',
                'agent/dependent/<id:[0-9]{1,10}>' => 'agent/dependent',
                'signup/<token:[A-Za-z0-9_-]{32}>' => 'site/signup',
                '<action:(index|membership|products|tools|agents|believe|about|contact|join|login|reset|request-password-reset|reset-password|legal)>' => 'site/<action>',
                'legal/<doc:(terms|privacy)>' => 'site/legal',
                '/' => 'site/index',
                '<id:[0-9]{4,10}>' => 'site/agent',
//                'page/<id:\d+>' => 'site/page',
            ],
        ],
    ],
    'params' => $params,
];
