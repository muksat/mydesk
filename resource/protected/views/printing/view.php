<?php
/* @var $this PrintingController */
/* @var $model Printing */

$this->breadcrumbs=array(
	'Printings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Printing', 'url'=>array('index')),
	array('label'=>'Create Printing', 'url'=>array('create')),
	array('label'=>'Update Printing', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Printing', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Printing', 'url'=>array('admin')),
);
?>

<h1>View Printing #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'design_id',
		'qty',
		'est_total',
		'brief',
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
		'status',
	),
)); ?>
