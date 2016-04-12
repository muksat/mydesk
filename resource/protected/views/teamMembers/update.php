<?php
/* @var $this TeamMembersController */
/* @var $model TeamMembers */

$this->breadcrumbs=array(
	'Team Members'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TeamMembers', 'url'=>array('index')),
	array('label'=>'Create TeamMembers', 'url'=>array('create')),
	array('label'=>'View TeamMembers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TeamMembers', 'url'=>array('admin')),
);
?>

<h1>Update TeamMembers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>