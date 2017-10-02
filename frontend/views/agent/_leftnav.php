<?php
use yii\helpers\Url;

$this->params['leftNav'] = [
    ['label' => 'Agent Home',       'url' => ['agent/index'],       'action' => 'index'],
    ['label' => 'Agent Details',    'url' => ['agent/details'],     'action' => 'details'],
    ['label' => 'Update Login',     'url' => ['agent/user'],        'action' => 'user'],
    ['label' => 'Enroll Member',    'url' => ['agent/enroll'],      'action' => 'enroll'],
    ['label' => 'Active Members',   'url' => ['agent/members'],     'action' => 'members'],


];


//$this->params['leftNav'] = "<div class=\"list-group\">
//<a href=\"".Url::to(['agent/index'])."\" class=\"list-group-item ".($this->context->action->id == 'index'?'active':null)."\">Agent Home</a>
//<a href=\"".Url::to(['agent/details'])."\" class=\"list-group-item ".($this->context->action->id == 'details'?'active':null)."\">Agent Details</a>
//</div>
//<div class=\"list-group\">
//<a href=\"".Url::to(['agent/enroll'])."\" class=\"list-group-item ".($this->context->action->id == 'enroll'?'active':null)."\">Enroll Member</a>
//<a href=\"".Url::to(['agent/products'])."\" class=\"list-group-item ".($this->context->action->id == 'products'?'active':null)."\">Add Products</a>
//</div>
//<div class=\"list-group\">
//<a href=\"".Url::to(['agent/agents'])."\" class=\"list-group-item ".($this->context->action->id == 'agents'?'active':null)."\">Agents</a>
//<a href=\"".Url::to(['agent/members'])."\" class=\"list-group-item ".($this->context->action->id == 'members'?'active':null)."\">Members</a>
//</div>";