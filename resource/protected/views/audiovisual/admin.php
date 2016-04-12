<?php
/* @var $this AudiovisualController */
/* @var $model Audiovisual */

$this->breadcrumbs=array(
	'Audiovisuals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Audiovisual', 'url'=>array('index')),
	array('label'=>'Create Audiovisual', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#audiovisual-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Audiovisuals</h1>

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
	'id'=>'audiovisual-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'item_id',
		'duration',
		'est_delivery_date',
		'brief',
		'est_total',
		/*
		'created_by',
		'created_time',
		'updated_by',
		'updated_time',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
