<?php
/* @var $this TransportController */
/* @var $model Transport */

$this->breadcrumbs=array(
	'Transports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Transport', 'url'=>array('index')),
	array('label'=>'Manage Transport', 'url'=>array('admin')),
);
?>

<h1>Create Transport</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'model1'=>$model1)); ?>