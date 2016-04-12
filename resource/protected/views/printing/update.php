<?php
/* @var $this PrintingController */
/* @var $model Printing */

$this->breadcrumbs=array(
	'Printings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Printing', 'url'=>array('index')),
	array('label'=>'Create Printing', 'url'=>array('create')),
	array('label'=>'View Printing', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Printing', 'url'=>array('admin')),
);
?>

<h1>Update Printing <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>