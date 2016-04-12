<?php
$this->renderPartial('_menu', array('active' =>'supervisor'));
?>

<h2 class="ui dividing header">Pending Requisitions</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transport-grid',
    'itemsCssClass'=>'ui table segment',
	'dataProvider'=>$model->pemsearch($supervisor_id),
	'filter'=>$model,
	'columns'=>array(
		//'id',
        array(
            'name' => 'id',
            'type'=>'raw',
            'value' => 'CHtml::link(CHtml::encode($data->id),array("view","id"=>$data->id))',
        ),
        'pin',
        'user_name',
        'level',
	    array(
            'name' => 'travel_type',
            'header' => 'Type',
            'type'=> 'html',
            'value'=>'($data->travel_type=="0")?"<span class=\"ui label small blue\">Official</span>":"<span class=\"ui label small orange\">Personal</span>"',
        ),


        array(
            'name' => 'travel_in_out',
            'header' => 'In Dhaka?',
            'value'=>'($data->travel_in_out=="0")?"No":"Yes"',
         ),
		array(
            'name'=>'start_date',
            'header'=>'Start Date',
            //'value' => 'Yii::app()->dateFormatter->format("y-M-d",$data->start_date)'
            'value'=>'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->start_date))'
        ),
      //  'return_date',
        array(
            'name'=>'return_date',
            'header'=>'Return Date',
            //'value' => 'Yii::app()->dateFormatter->format("y-M-d",$data->return_date)'
            'value'=>'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->return_date))'
        ),
        //'status',
        array(
            'name'=> 'status',
            'header'=>'Status',
            'type'=>'html',
            'value' => '"<span class=\"ui label\">".Yii::app()->getModule("fleet")->status[$data->status]."</span>"'
        ),
     /*   array(
            'name' => 'transport_flow_supervisor_id',
            'header' => 'Supervisor',
            'value' => '$data->transport_flow_supervisor_id'
        ),*/

        //'transport_flow_supervisor_id',
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

		array(
			'class'=>'CButtonColumn',
		),*/

        array(  'class'=>'CButtonColumn',
            'template'=>'{myButton}',
            'buttons'=>array(
                'myButton'=>array(
                    'label'=>'Approve',
                    'url'=>'Yii::app()->createUrl("fleet/transport/updateajax1", array("id"=>$data->id))',
                    'click'=>"function() {
//if(!confirm('Approved the Requisition ?')) return false;
$.fn.yiiGridView.update('transport-grid', {
type:'POST',
url:$(this).attr('href'),
success:function(text,status) {
$.fn.yiiGridView.update('transport-grid');

}
});
return false;
}",
                    'options'=>array(
                        'id'=>'\'button_for_id_\'.$data->id',


                    ),
                ),
            ),
        ),

        array(  'class'=>'CButtonColumn',
            'template'=>'{myButton}',
            'buttons'=>array(
                'myButton'=>array(
                    'label'=>'Decline',
                    'url'=>'Yii::app()->createUrl("fleet/transport/updateajax2", array("id"=>$data->id))',
                    'click'=>"function() {
//if(!confirm('Decline the Requisition ?')) return false;
$.fn.yiiGridView.update('transport-grid', {
type:'POST',
url:$(this).attr('href'),
success:function(text,status) {
$.fn.yiiGridView.update('transport-grid');

}
});
return false;
}",
                    'options'=>array(
                        'id'=>'\'button_for_id_\'.$data->id',


                    ),
                ),
            ),
        ),


    ),
)); ?>
