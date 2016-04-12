<?php
/* @var $this DesignController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Designs',
);

$this->menu=array(
	array('label'=>'Create Design', 'url'=>array('create')),
	array('label'=>'Manage Design', 'url'=>array('admin')),
);
?>

<h1>Designs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
