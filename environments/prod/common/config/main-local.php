<?php
return [
    'components' => [
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '10.2.2.5',
            'port' => 6379,
            'database' => 0,
        ],
        //        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=10.2.2.5;port=5432;dbname=nahcprod;sslmode=require',
            'username' => 'nahcprod',
            'password' => 'eFZtF4bKaZUfcEZTt3JtkUcG',
            'charset' => 'utf8',
            'queryCache' => 'cache',
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
                'host' => 'smtp.office365.com',
                'username' => 'webuser@nahc.co',
                'password' => '8mvMQsvbyWhdkCZ2',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
