<?php
return [
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=172.16.1.6;dbname=nahcbeta',
            'username' => 'nahcbeta',
            'password' => 'rDRVNXbpSHH84bAXW79d4tPU',
            'charset' => 'utf8',
        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@common/mail',
//            // send all mails to a file by default. You have to set
//            // 'useFileTransport' to false and configure a transport
//            // for the mailer to send real emails.
//            'useFileTransport' => true,
//        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                //'host' => 'smtp.office365.com',
                'host' => 'smtp.gmail.com',
                //'username' => 'webuser@nahc.co',
                'username' => 'webuser.nahc@gmail.com',
                'password' => '8mvMQsvbyWhdkCZ2',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'e123' => [
            'class' => '\common\components\E123Api',
        ],
    ],
];
