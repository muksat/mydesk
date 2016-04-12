<?php
/* @var $this AudiovisualController */
/* @var $model Audiovisual */

$this->breadcrumbs=array(
	'Audiovisuals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Audiovisual', 'url'=>array('index')),
	array('label'=>'Create Audiovisual', 'url'=>array('create')),
	array('label'=>'Update Audiovisual', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Audiovisual', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Audiovisual', 'url'=>array('admin')),
);
?>

<h1>View Audiovisual #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'duration',
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
