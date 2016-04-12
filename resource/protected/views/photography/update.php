<?php
/* @var $this PhotographyController */
/* @var $model Photography */

$this->breadcrumbs=array(
	'Photographies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Photography', 'url'=>array('index')),
	array('label'=>'Create Photography', 'url'=>array('create')),
	array('label'=>'View Photography', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Photography', 'url'=>array('admin')),
);
?>

<h1>Update Photography <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>