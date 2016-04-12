<?php
$this->renderPartial('_menu', array('active' => 'supervisor'));
HrdService::BRACProjects();
?>
<h2 class="ui dividing header">Manage Transport Flow Supervisors</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transport-flow-supervisor-grid',
    'itemsCssClass' => 'ui table segment',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'pin',
        'name',
		'status',
        'special',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
