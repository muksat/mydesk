<?php
/* @var $this CommFlowSupervisorController */
/* @var $model Supervisor */

$this->breadcrumbs=array(
	'Comm Flow Supervisors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CommFlowSupervisor', 'url'=>array('index')),
	array('label'=>'Manage CommFlowSupervisor', 'url'=>array('admin')),
);
?>

<h1>Create CommFlowSupervisor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>