<?php
$this->render('_leftnav');

$this->title = 'Add Dependent';

?>

<h1>Add Dependent</h1>
<p>Add dependent information below and click Save to add a new dependent</p>

<?=$this->render('_dependent_form', ['model' => $model]);?>
