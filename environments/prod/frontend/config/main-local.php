<?php
return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
    ],
];
