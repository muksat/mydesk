<?php
/* @var $this DesignController */
/* @var $model Design */

$this->breadcrumbs=array(
	'Designs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Design', 'url'=>array('index')),
	array('label'=>'Create Design', 'url'=>array('create')),
	array('label'=>'Update Design', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Design', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Design', 'url'=>array('admin')),
);
?>

<h1>View Design #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'qty',
		'est_delivery_date',
		'brief',
		'est_total',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
		'status',
	),
)); ?>
