<?php
/* @var $this PhotographyController */
/* @var $model Photography */

$this->breadcrumbs=array(
	'Photographies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Photography', 'url'=>array('index')),
	array('label'=>'Create Photography', 'url'=>array('create')),
	array('label'=>'Update Photography', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Photography', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Photography', 'url'=>array('admin')),
);
?>

<h1>View Photography #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item',
		'days',
		'location',
		'fromdate',
		'todate',
		'deliverydate',
		'brief',
		'est_total',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
		'status',
	),
)); ?>
