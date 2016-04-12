<?php
/* @var $this CommFlowSupervisorController */
/* @var $model Supervisor */

$this->breadcrumbs=array(
	'Comm Flow Supervisors'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CommFlowSupervisor', 'url'=>array('index')),
	array('label'=>'Create CommFlowSupervisor', 'url'=>array('create')),
	array('label'=>'View CommFlowSupervisor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CommFlowSupervisor', 'url'=>array('admin')),
);
?>

<h1>Update CommFlowSupervisor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>