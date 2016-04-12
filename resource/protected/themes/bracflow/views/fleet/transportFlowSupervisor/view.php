<?php
/* @var $this TransportFlowSupervisorController */
/* @var $model TransportFlowSupervisor */

$this->breadcrumbs=array(
	'Transport Flow Supervisors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Supervisor', 'url'=>array('index')),
	array('label'=>'New Supervisor', 'url'=>array('create')),
	array('label'=>'Update wSupervisor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Supervisor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Supervisor', 'url'=>array('admin')),
);
?>

<h2>View Supervisor: <?php echo $model->id; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pin',
        'name',
		'status',
        'special',
	),
)); ?>
