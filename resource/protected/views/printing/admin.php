<?php
/* @var $this PrintingController */
/* @var $model Printing */

$this->breadcrumbs=array(
	'Printings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Printing', 'url'=>array('index')),
	array('label'=>'Create Printing', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#printing-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Printings</h1>

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
	'id'=>'printing-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'item_id',
		'design_id',
		'qty',
		'est_total',
		'brief',
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
