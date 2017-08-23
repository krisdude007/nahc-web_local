<?php
use yii\helpers\Url;

$this->params['leftNav'] = [
    ['label' => 'My Benefits',      'url' => ['member/index'],      'action' => 'index'],
    ['label' => 'Member Info',      'url' => ['member/details'],    'action' => 'details'],
    ['label' => 'Update Login',     'url' => ['member/user'],       'action' => 'user'],
    ['label' => 'Payment Info',     'url' => ['member/payment'],    'action' => 'payment'],
    ['label' => 'Dependents',       'url' => ['member/dependents'], 'action' => 'dependents'],
    ['label' => 'Contact Agent',    'url' => ['member/contact'],    'action' => 'contact'],
];


