<?php
/* @var $this CommFlowSupervisorController */
/* @var $model Supervisor */

$this->breadcrumbs=array(
	'Comm Flow Supervisors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CommFlowSupervisor', 'url'=>array('index')),
	array('label'=>'Create CommFlowSupervisor', 'url'=>array('create')),
	array('label'=>'Update CommFlowSupervisor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CommFlowSupervisor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CommFlowSupervisor', 'url'=>array('admin')),
);
?>

<h1>View CommFlowSupervisor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pin',
		'name',
		'designation',
		'dept',
		'status',
		'special',
	),
)); ?>
