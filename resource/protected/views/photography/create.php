<?php
/* @var $this PhotographyController */
/* @var $model Photography */

$this->breadcrumbs=array(
	'Photographies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Photography', 'url'=>array('index')),
	array('label'=>'Manage Photography', 'url'=>array('admin')),
);
?>

<h1>Create Photography</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>