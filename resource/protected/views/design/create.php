<?php
/* @var $this DesignController */
/* @var $model Design */

$this->breadcrumbs=array(
	'Designs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Design', 'url'=>array('index')),
	array('label'=>'Manage Design', 'url'=>array('admin')),
);
?>

<h1>Create Design</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>