<?php
/* @var $this AudiovisualController */
/* @var $model Audiovisual */

$this->breadcrumbs=array(
	'Audiovisuals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Audiovisual', 'url'=>array('index')),
	array('label'=>'Manage Audiovisual', 'url'=>array('admin')),
);
?>

<h1>Create Audiovisual</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>