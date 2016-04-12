<?php
/* @var $this TransportFlowSupervisorController */
/* @var $model TransportFlowSupervisor */

$this->breadcrumbs=array(
	'Transport Flow Supervisors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TransportFlowSupervisor', 'url'=>array('index')),
	array('label'=>'Create TransportFlowSupervisor', 'url'=>array('create')),
	array('label'=>'Update TransportFlowSupervisor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TransportFlowSupervisor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TransportFlowSupervisor', 'url'=>array('admin')),
);
?>

<h1>View TransportFlowSupervisor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pin',
		'status',
	),
)); ?>
