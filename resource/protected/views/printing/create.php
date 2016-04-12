<?php
/* @var $this PrintingController */
/* @var $model Printing */

$this->breadcrumbs=array(
	'Printings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Printing', 'url'=>array('index')),
	array('label'=>'Manage Printing', 'url'=>array('admin')),
);
?>

<h1>Create Printing</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>