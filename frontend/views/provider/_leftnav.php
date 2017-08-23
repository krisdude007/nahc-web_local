<?php
use yii\helpers\Url;

$this->params['leftNav'] = [
    ['label' => 'Provider Home',    'url' => ['provider/index'],       'action' => 'index'],
    ['label' => 'Provider Details', 'url' => ['provider/details'],     'action' => 'details'],
    ['label' => 'Verify Member',    'url' => ['provider/verify'],      'action' => 'verify'],
    ['label' => 'Agents',           'url' => ['provider/agents'],      'action' => 'agents'],
    ['label' => 'Members',          'url' => ['provider/members'],     'action' => 'members'],
];

//$this->params['leftNav'] = "<div class=\"list-group\">
//<a href=\"".Url::to(['provider/index'])."\" class=\"list-group-item ".($this->context->action->id == 'index'?'active':null)."\">Provider Home</a>
//<a href=\"".Url::to(['provider/details'])."\" class=\"list-group-item ".($this->context->action->id == 'details'?'active':null)."\">Provider Details</a>
//<a href=\"".Url::to(['provider/verify'])."\" class=\"list-group-item ".($this->context->action->id == 'details'?'active':null)."\">Verify Member</a>
//</div>
//<div class=\"list-group\">
//<a href=\"".Url::to(['provider/agents'])."\" class=\"list-group-item ".($this->context->action->id == 'agents'?'active':null)."\">Agents</a>
//<a href=\"".Url::to(['provider/members'])."\" class=\"list-group-item ".($this->context->action->id == 'members'?'active':null)."\">Members</a>
//</div>";