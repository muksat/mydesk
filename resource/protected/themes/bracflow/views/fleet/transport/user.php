<style type="text/css">
    #transport-grid table th a{
        font-weight: bold; color: #999; border-bottom: 1px dashed #ccc;
    }
</style>
<?php $this->renderPartial('_menu', array('active' =>'user')); ?>
<h2 class="ui header dividing">My Requisitions</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transport-grid',
        'itemsCssClass'=>'ui basic table segment',
        'dataProvider'=>$model->search(),
	'filter'=>$model,
        'filterPosition'=>'',
	'columns'=>array(
        array(
            'name' => 'id',
            'type'=>'raw',
            'value' => 'CHtml::link(CHtml::encode($data->id),array("view","id"=>$data->id))',
            'htmlOptions' => array('style'=>'font-weight:bold; text-decoration:underline')
        ),
            
        array(
            'name' => 'travel_type',
            'header' => 'Type',
            'type'=> 'html',
            'value'=>'($data->travel_type=="0")?"<span class=\"ui label small teal\">Official</span>":"<span class=\"ui label small blue\">Personal</span>"',
        ),
            //  'submit_date',
        array(
            'name' => 'create_time',
            'header' => 'Submission Date',            
            //'value' => 'Yii::app()->dateFormatter->format("y-M-d",$data->return_date)'
            'value' => 'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->create_time))'
        ),
        array(
            'name' => 'travel_in_out',
            'header' => 'Out Dhaka?',
            'type' => 'html',
            'value'=>'getInOutStatus($data)',
         ),
            
		array(
            'name'=>'start_date',
            'header'=>'Start',
            'value'=>'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->start_date))'
        ),
        array(
            'name'=>'return_date',
            'header'=>'Return',
            'value'=>'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->return_date))'
        ),
        array(
            'name' => 'status',
            'header' => 'Status',
            'type'=>'html',
            'value' => 'getStatusHtml($data)'
        ),
        array(
            'name' => 'transport_flow_supervisor_id',
            'header' => 'Supervisor',
            'type'=>'html',
            'value' => 'getSupervisorName($data)'
        ),
    ),
));
function getSupervisorName($data) {
    if($data->transportflowsupervisor)
    return '<span style="font-weight:600; font-size:0.95em">'.$data->transportflowsupervisor->name.'</span>';
    else
        return '';
}
function getStatusHtml($data){
    if($data->status == 5) {
        return '<span class="ui small red label">'.Yii::app()->getModule("fleet")->status[$data->status].'</span>';
    } else if ($data->status == 3) {
        return '<span class="ui small green label">'.Yii::app()->getModule("fleet")->status[$data->status].'</span>';
    } else if ($data->status == 2) {
        return '<span class="ui small orange label">'.Yii::app()->getModule("fleet")->status[$data->status].'</span>';
    } else if ($data->status == 4) {
        return '<span class="ui small purple label">'.Yii::app()->getModule("fleet")->status[$data->status].'</span>';
    }
    return '<span class="ui small black label">'.Yii::app()->getModule("fleet")->status[$data->status].'</span>';
}
function getInOutStatus($data){
    if($data->travel_in_out == "0") {
        return '<i class="remove sign large red icon"></i>';
    } else {
        return '<i class="checkmark sign teal large icon"></i>';
    }
}
?>
<div id="view-modal" class="view ui modal" style="background: #eee">Loading...</div>
<script type="text/javascript">
    $(function(){
        $('#transport-grid td a').on('click', function(e){
            $('#loading').show();
            $.ajax({
                url: $(e.target).attr('href'),
                success: function(data) {
                    $('#view-modal').html(data);
                    $('.view.ui.modal').modal('setting', 'transition', "vertical flip").modal('show');
                    $('.view.ui.modal').modal('attach events', '.ui.button.small.close', 'hide');
                    $('.view.ui.modal').modal('attach events', '.top-close-button', 'hide');
                    $('#loading').hide();
                }
            });
            return false;
        })
        if($('.ui.green.message')) {
            $('.ui.green.message').transition('pulse');
            $('.ui.green.message').focus();
        }
    });
</script>