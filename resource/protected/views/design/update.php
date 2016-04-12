<?php
/* @var $this DesignController */
/* @var $model Design */

$this->breadcrumbs=array(
	'Designs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Design', 'url'=>array('index')),
	array('label'=>'Create Design', 'url'=>array('create')),
	array('label'=>'View Design', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Design', 'url'=>array('admin')),
);
?>

<h1>Update Design <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>