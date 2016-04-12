<?php
/* @var $this TransportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Transports',
);

$this->menu=array(
	array('label'=>'Create Transport', 'url'=>array('create')),
	array('label'=>'Manage Transport', 'url'=>array('admin')),
);
?>

<h1>Transports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
