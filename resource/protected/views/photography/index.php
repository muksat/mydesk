<?php
/* @var $this PhotographyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Photographies',
);

$this->menu=array(
	array('label'=>'Create Photography', 'url'=>array('create')),
	array('label'=>'Manage Photography', 'url'=>array('admin')),
);
?>

<h1>Photographies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
