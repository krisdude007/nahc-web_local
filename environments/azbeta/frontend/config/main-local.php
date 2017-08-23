<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.office365.com',
                'username' => 'webuser@nahc.co',
                'password' => '8mvMQsvbyWhdkCZ2',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'traceLine' => '<a href="phpstorm://open?url={file}&line={line}">{file}:{line}</a>',
        // uncomment and adjust the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '172.21.*.*', '172.16.*.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '172.21.*.*', '172.16.*.*'],
    ];
}

return $config;
