<?php
/* @var $this PrintingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Printings',
);

$this->menu=array(
	array('label'=>'Create Printing', 'url'=>array('create')),
	array('label'=>'Manage Printing', 'url'=>array('admin')),
);
?>

<h1>Printings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
