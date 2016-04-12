<?php
/* @var $this TeamMembersController */
/* @var $model TeamMembers */

$this->breadcrumbs=array(
	'Team Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TeamMembers', 'url'=>array('index')),
	array('label'=>'Manage TeamMembers', 'url'=>array('admin')),
);
?>

<h1>Create TeamMembers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>