<?php
/* @var $this AudiovisualController */
/* @var $model Audiovisual */

$this->breadcrumbs=array(
	'Audiovisuals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Audiovisual', 'url'=>array('index')),
	array('label'=>'Create Audiovisual', 'url'=>array('create')),
	array('label'=>'View Audiovisual', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Audiovisual', 'url'=>array('admin')),
);
?>

<h1>Update Audiovisual <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>