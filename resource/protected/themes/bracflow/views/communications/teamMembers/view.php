<?php
/* @var $this TeamMembersController */
/* @var $model TeamMembers */

$this->breadcrumbs=array(
	'Team Members'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TeamMembers', 'url'=>array('index')),
	array('label'=>'Create TeamMembers', 'url'=>array('create')),
	array('label'=>'Update TeamMembers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TeamMembers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TeamMembers', 'url'=>array('admin')),
);
?>

<h1>View TeamMembers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'team_id',
		'user_id',
	),
)); ?>
