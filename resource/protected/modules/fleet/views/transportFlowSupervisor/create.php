<?php
/* @var $this TransportFlowSupervisorController */
/* @var $model TransportFlowSupervisor */

$this->breadcrumbs=array(
	'Transport Flow Supervisors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TransportFlowSupervisor', 'url'=>array('index')),
	array('label'=>'Manage TransportFlowSupervisor', 'url'=>array('admin')),
);
?>

<h1>Create TransportFlowSupervisor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>