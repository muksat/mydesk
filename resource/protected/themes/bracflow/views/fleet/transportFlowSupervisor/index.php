<?php
/* @var $this TransportFlowSupervisorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Transport Flow Supervisors',
);

$this->menu=array(
	array('label'=>'Create TransportFlowSupervisor', 'url'=>array('create')),
	array('label'=>'Manage TransportFlowSupervisor', 'url'=>array('admin')),
);
?>

<h1>Transport Flow Supervisors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
