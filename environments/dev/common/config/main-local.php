<?php
return [
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'cache' => [
//            'class' => 'yii\redis\Cache',
//        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=192.168.127.5;dbname=nahcdev',
            'username' => 'nahcdev',
            'password' => '8XTZWXEwQULcRamrzpaScZtV',
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
