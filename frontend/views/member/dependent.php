<?php

use Yii;

$this->title = 'Dependent Information';

$this->render('_leftnav');


?>

<h1>Update Dependent Information</h1>
<p>Update dependent information below and click Save to continue</p>

<?=$this->render('_dependent_form', ['model' => $model]);?>