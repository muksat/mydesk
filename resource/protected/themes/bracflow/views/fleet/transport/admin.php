<style>
    #transport-grid table th a{
        font-weight: bold; color: #999; border-bottom: 1px dashed #ccc;
    }
    .ui.message.warning {
        border: 1px dashed;
    }
</style>
<?php
    $this->renderPartial('_menu', array('active' => 'supervisor'));
?>
<h2 class="ui dividing header">Pending Requisitions</h2>
<?php
if($model->adminsearch($supervisor_id)->itemCount > 0 ) {
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'transport-grid',
    'itemsCssClass' => 'ui basic table segment',
    'dataProvider' => $model->adminsearch($supervisor_id),
    'filter' => $model,
    'filterPosition'=>'',
    'columns' => array(
        //'id',
        array(
            'name' => 'id',
            'type' => 'html',
            'value' => 'getIdLink($data)',
            'htmlOptions' => array('style'=>'font-weight:bold; text-decoration:underline')
        ),
        'pin',
        //'user_name',
        array(
            'name' => 'user_name',
            'header' => 'Name',
        ),
        'level',
        array(
            'name' => 'travel_type',
            'header' => 'Type',
            'type' => 'html',
            'value' => '($data->travel_type=="0")?"<span class=\"ui label small blue\">Official</span>":"<span class=\"ui label small orange\">Personal</span>"',
        ),


        array(
            'name' => 'travel_in_out',
            'header' => 'Out Dhaka?',
            'type' => 'html',
            //'value'=>'($data->travel_in_out=="0")?"No":"Yes"',
            'value' => 'getInOutStatus($data)',
        ),
        array(
            'name' => 'start_date',
            'header' => 'Start',
            //'value' => 'Yii::app()->dateFormatter->format("y-M-d",$data->start_date)'
            'value' => 'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->start_date))'
        ),
        //  'return_date',
        array(
            'name' => 'return_date',
            'header' => 'Return',
            //'value' => 'Yii::app()->dateFormatter->format("y-M-d",$data->return_date)'
            'value' => 'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->return_date))'
        ),
        //'status',
        array(
            'name' => 'status',
            'header' => 'Status',
            'type' => 'html',
            'value' => '"<span class=\"ui small orange label\">".Yii::app()->getModule("fleet")->status[$data->status]."</span>"'
        ),
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

        array(
            'class'=>'CButtonColumn',
            'template' => '{myApp}{myDec}',
            'buttons' => array(
                'myApp' => array(
                    'label' => CHtml::decode("<i class='checkmark icon'></i> Approve"),
                    'url' => 'Yii::app()->createUrl("fleet/transport/updateajax1", array("id" => $data->id))',
                    'options' => array(
                        'class'=> 'ui mini green button labeled icon',
                        'onclick' => 'js:function() {
                            $.fn.yiiGridView.update("transport-grid", {
                            type:"POST",
                            url:$(this).attr("href"),
                            success:function(text,status) {
                                $.fn.yiiGridView.update("transport-grid");
                                }
                            });
                            return false;
                            }'
                    )
                ),
                'myDec' => array(
                    'label' => CHtml::decode("<i class='remove icon'></i> Decline"),
                    'url' => 'Yii::app()->createUrl("fleet/transport/updateajax2", array("id"=>$data->id))',
                    'options' => array(
                        'class'=> 'ui mini red button labeled icon',
                        'onclick' => 'js:function() {
                            $.fn.yiiGridView.update("transport-grid", {
                            type:"POST",
                            url:$(this).attr("href"),
                            success:function(text,status) {
                                $.fn.yiiGridView.update("transport-grid");
                            }
                        });
                        return false;
                        }'
                    )
                )
            )
        )
    ),
));
} else {
    echo '<div class="ui message info"> No pending requisition</div>';
}

function getInOutStatus($data)
{
    if ($data->travel_in_out == "0") {
        return '<i class="remove sign large red icon"></i>';
    } else {
        return '<i class="checkmark sign teal large icon"></i>';
    }
}

function getIdLink($data) {
    return CHtml::link(CHtml::encode($data->id), array("view","id"=>$data->id), array('class'=>'open-view-modal'));
}

?>
<div id="view-modal" class="view ui modal" style="background: #eee">Loading...</div>
<script type="text/javascript">
    $(function(){
        $('#transport-grid td a.open-view-modal').on('click', function(e){
            $('#loading').show();
            $.ajax({
                url: $(e.target).attr('href'),
                success: function(data) {
                    $('#view-modal').html(data);
                    //$('.view.ui.modal').modal('show');
                    $('.view.ui.modal').modal('setting', 'transition', "vertical flip").modal('show');
                    $('.view.ui.modal').modal('attach events', '.ui.button.small.close', 'hide');
                    $('.view.ui.modal').modal('attach events', '.top-close-button', 'hide');
                    $('#loading').hide();
                }
            });
            return false;
        })

        if($('.ui.warning.message')) {
            $('.ui.warning.message').transition('pulse');
            $('.ui.warning.message').focus();
        }
    });
</script>


