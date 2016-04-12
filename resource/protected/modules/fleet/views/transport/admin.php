<?php
/* @var $this TransportController */
/* @var $model Transport */

$this->breadcrumbs=array(
	'Transports'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Transport', 'url'=>array('index')),
	array('label'=>'Create Transport', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#transport-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Transports</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transport-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'pin',
		'travel_type',
		'travel_reason',
		'travel_in_out',
		'start_date',
		/*
		'return_date',
		'start_point',
		'end_point',
		'passanger',
		'vehicle_type',
		'bill_dept',
		'onbehalf_pin',
		'flow_attachment_id',
		'remarks',
		'status',
		'transport_flow_supervisor_id',
		'supervisor_remarks',
		'create_time',
		'update_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
