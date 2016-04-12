<?php
$this->layout = "//layout/main";
?>
<i class="top-close-button close red icon" style="top: 1em; right: 1em"></i>
<div class="ui header" style="padding: 1rem">
    Transport Requisition # <?php echo $model->id; ?>
</div>
<div class="content" style="background: #eee; padding: 0.5em">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'htmlOptions'=>array('class'=>'ui table segment view-table'),
        'attributes'=>array(
            'pin',
            'user_name',
            array(
                'name'=>'travel_type',
                'type'=>'raw',
                'value'=>($model->travel_type=="0")?"Official":"Personal",
            ),
            'travel_reason',
            array(
                'name'=>'travel_in_out',
                'type'=>'raw',
                'value'=>($model->travel_in_out=="0")?"No":"Yes",
            ),
            array(
                'name' => 'start_date',
                'value' => Yii::app()->dateFormatter->format("d MMM, y h:mm a", $model->start_date)
            ),
            array(
                'name' => 'return_date',
                'value' => Yii::app()->dateFormatter->format("d MMM, y h:mm a", $model->return_date)
            ),
            'start_point',
            'end_point',
            'passanger',
            array(
                'name'=>'vehicle_type',
                'type'=>'raw',
                'value'=>(!isset($model->vehicle_type))? "" : Yii::app()->getModule('fleet')->vehicleType[$model->vehicle_type],
            ),
            //'bill_dept',
            array(
                'name'=> 'bill_dept',
                'visible'=> $model->travel_type=="0"
            ),
            'remarks',
            array(
                'name'=>'status',
                'type'=>'raw',
                'value'=>(!isset($model->status))? "" : Yii::app()->getModule('fleet')->status[$model->status],
            ),
            array(
                'name'=>'Supervisor',
                'type'=>'raw',
                'value'=>(!isset($model->transportflowsupervisor->name))? "" : $model->transportflowsupervisor->name,
            ),
            'supervisor_remarks',
        ),
    )); ?>
</div>
<div class="actions" style="padding: 0.5rem">
    <div class="ui button close small red labeled icon">
        <i class="remove circle icon"></i>
        Close
    </div>
</div>