<?php
/* @var $this TransportFlowSupervisorController */
/* @var $model TransportFlowSupervisor */

$this->breadcrumbs=array(
	'Transport Flow Supervisors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TransportFlowSupervisor', 'url'=>array('index')),
	array('label'=>'Create TransportFlowSupervisor', 'url'=>array('create')),
	array('label'=>'View TransportFlowSupervisor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TransportFlowSupervisor', 'url'=>array('admin')),
);
?>

<h1>Update TransportFlowSupervisor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>