<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=nahc-beta-db1.postgres.database.azure.com;port=5432;dbname=nahcazbeta;sslmode=require',
            'username' => 'nahcbeta@nahc-beta-db1',
            'password' => 'UncgzE3LAbKvYEHaNPhB3wss',
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
                'host' => 'smtp.office365.com',
                'username' => 'webuser@nahc.co',
                'password' => '8mvMQsvbyWhdkCZ2',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
