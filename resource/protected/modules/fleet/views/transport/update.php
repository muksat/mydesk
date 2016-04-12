<?php
/* @var $this TransportController */
/* @var $model Transport */

$this->breadcrumbs=array(
	'Transports'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Transport', 'url'=>array('index')),
	array('label'=>'Create Transport', 'url'=>array('create')),
	array('label'=>'View Transport', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Transport', 'url'=>array('admin')),
);
?>

<h1>Update Transport <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>