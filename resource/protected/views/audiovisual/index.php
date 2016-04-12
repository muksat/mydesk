<?php
/* @var $this AudiovisualController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Audiovisuals',
);

$this->menu=array(
	array('label'=>'Create Audiovisual', 'url'=>array('create')),
	array('label'=>'Manage Audiovisual', 'url'=>array('admin')),
);
?>

<h1>Audiovisuals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
