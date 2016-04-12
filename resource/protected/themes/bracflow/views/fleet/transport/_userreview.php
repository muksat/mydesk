<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/smoothness/jquery-ui-1.10.4.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/jquery-ui-timepicker-addon.min.css">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'transport-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('class'=>'ui form', 'style'=>'margin-top: 20px')
)); ?>
<style type="text/css">
    .ui.selection.dropdown, .ui.selection.dropdown .menu {
        padding: .4em .5em; border: 1px solid #aaa; box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05) !important;
    }
    .ui-datepicker {
        font-size: 13px;
    }
    .required {
        color: #ff0000; font-weight: bold; font-size: 2em; line-height: 13px;
    }
    #request_type {
        font-size: .8em; text-transform: uppercase; color: #666;
    }
</style>
<div class="ui fluid form segment" style="background: rgba(0, 0, 0 , 0.1); margin-top: 0">
<?php echo $form->errorSummary($model,'','', array('class'=>'ui error message', 'style'=>'display:block; border: 1px solid; margin-top:0')); ?>

<h3 class="ui black header dividing" style="margin-top: 0">Travel Information</h3>

<div class="ui three fields">
    <div class="field">
        <?php echo $form->labelEx($model,'travel_type'); ?>
        <?php echo $form->radioButtonList($model,'travel_type',$travel_type, array( 'template'=> '{input}{label}', 'separator'=>'','encode'=> false,'type'=>'text','class'=>'','placeholder'=>'Travel Type', 'disabled'=>'disabled')); ?>
    </div>
    <div class="field">
        <?php echo $form->labelEx($model,'travel_in_out');?>
        <?php echo $form->radioButtonList($model,'travel_in_out',$outside_dhaka, array( 'template'=> '{input}{label}', 'separator'=>'','encode'=> false,'type'=>'text','class'=>'','placeholder'=>'Travel Type', 'disabled'=>'disabled')); ?>
    </div>
    <div class="field">
        <?php echo $form->labelEx($model,'passanger');?>
        <div class="ui mini input">
            <?php echo $form->textField($model,'passanger',array('type'=>'text','placeholder'=>'passenger')); ?>
        </div>
    </div>
</div>
<div class="ui three fields">
    <div class="field">
        <?php echo $form->labelEx($model,'vehicle_type');?>
        <div class="ui mini input">
            <?php  echo $form->dropDownList($model,'vehicle_type',$vehicle_type, array( 'type'=>'text','class'=>'ui mini selection dropdown','placeholder'=>'Select', 'disabled'=>'disabled')); ?>
        </div>
    </div>
    <div class="field">
        <?php echo $form->labelEx($model,'start_date'); ?>
        <div class="ui mini input">
            <?php echo $form->textField($model,'start_date'); ?>
        </div>
    </div>
    <div class="field">
        <?php echo $form->labelEx($model,'return_date'); ?>
        <div class="ui mini input">
            <?php echo $form->textField($model,'return_date'); ?>
        </div>
    </div>
</div>
<div class="ui two fields">
    <div class="field">
        <?php echo $form->labelEx($model,'start_point');?>
        <div class="ui mini input">
            <?php echo $form->textField($model,'start_point',array('type'=>'text')); ?>
        </div>
    </div>
    <div class="field">
        <?php echo $form->labelEx($model,'end_point');?>
        <div class="ui mini input">
            <?php echo $form->textField($model,'end_point'); ?>
        </div>
    </div>
</div>
<div class="field">
    <?php /*echo $form->labelEx($model,'travel_reason'); */?>
    <label for="Transport_travel_reason">Requister Reason of Travelling</label>
    <div class="ui mini input">
        <?php echo $form->textField($model,'travel_reason'); ?>
    </div>
</div>
<div class="field">
    <label for="Transport_remarks">Supervisor Remarks</label>
    <div class="ui mini input">
        <?php echo $form->textField($model,'remarks',array('type'=>'text')); ?>
    </div>
</div>
<div class="ui divider"></div>
<div class="ui two fields" id="for-personal">
<div class="field" id="departmentField">
    <?php  echo $form->labelEx($model,'bill_dept');?>
    <?php echo $form->dropDownList($model,'bill_dept', HrdService::getProjectsListData(),array('empty' => 'Select ...', 'class'=>'ui selection dropdown', 'disabled'=>'disabled')); ?>
</div>

<div class="field" id="supervisorField">
    <?php echo $form->labelEx($model,'transport_flow_supervisor_id');?>
    <?php  $sp_name = TransportFlowSupervisor::model()->findAll(array('select'=>'name, id','order' => 'name ASC'));
    echo $form->dropDownList($model,'transport_flow_supervisor_id', CHtml::listData($sp_name,'id',  'name'),array('empty' => 'Select Name...', 'class'=>'ui selection dropdown', 'disabled'=>'disabled')); ?>
</div>

<div class="field disabled" id="supervisorPMS" style="display: none">
    <?php echo $form->labelEx($model,'transport_flow_supervisor_id');?>
    <div class="ui mini input">
        <?php  $sp_name = TransportFlowSupervisor::model()->findAll(array('select'=>'name, id', 'condition'=>'special=1' ,'order' => 'name ASC'));
        echo $form->dropDownList($model,'transport_flow_supervisor_id', CHtml::listData($sp_name,'id',  'name'),array('disabled' => 'disabled', 'class'=>'ui selection dropdown')); ?>
    </div>
</div>
</div>
<div class="row buttons">
    <!--<div name="approve" class="ui right small submit orange labeled icon button">
        <i class="checkmark  icon"></i>
        Approve
    </div>
    <div name="review" class="ui right small submit teal labeled icon button" >
        <i class="right arrow icon"></i>
        Send for review
    </div>-->
    <?php echo CHtml::submitButton('Submit', array('name' => 'button1', 'class'=>'ui small orange button')); ?>
    <?php // echo '&nbsp;&nbsp;&nbsp;'; ?>
    <?php // echo CHtml::submitButton('Send for requester review', array('name' => 'button2', 'class'=>'ui small teal button')); ?>
<!--    -->
<!--    --><?php //echo "<input type='submit' name='Approve' class='ui submit button' value='approve'>"; ?>
<!--    --><?php //echo "<input type='submit' name='Review' class='ui submit button' value='review'>"; ?>
</div>
</div>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/jquery-ui-1.10.4.custom.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript">

    var myControl=  {
        create: function(tp_inst, obj, unit, val, min, max, step){
            $('<input class="ui-timepicker-input" value="'+val+'" style="width:50%">')
                .appendTo(obj)
                .spinner({
                    min: min,
                    max: max,
                    step: step,
                    change: function(e,ui){ // key events
                        // don't call if api was used and not key press
                        if(e.originalEvent !== undefined)
                            tp_inst._onTimeChange();
                        tp_inst._onSelectHandler();
                    },
                    spin: function(e,ui){ // spin events
                        tp_inst.control.value(tp_inst, obj, unit, ui.value);
                        tp_inst._onTimeChange();
                        tp_inst._onSelectHandler();
                    }
                });
            return obj;
        },
        options: function(tp_inst, obj, unit, opts, val){
            if(typeof(opts) == 'string' && val !== undefined)
                return obj.find('.ui-timepicker-input').spinner(opts, val);
            return obj.find('.ui-timepicker-input').spinner(opts);
        },
        value: function(tp_inst, obj, unit, val){
            if(val !== undefined)
                return obj.find('.ui-timepicker-input').spinner('value', val);
            return obj.find('.ui-timepicker-input').spinner('value');
        }
    };


    $(function(){
        if($('.ui.error.message')) {
            $('.ui.error.message').transition('pulse');
            $('.ui.error.message').focus();
        }

        $('#Transport_start_date, #Transport_return_date').datetimepicker({
            controlType: myControl,
            timeFormat: 'HH:mm',
            dateFormat: 'yy-mm-dd'
        });

        if($('#userType').val() == 'true' ){
            $('#supervisorField').hide('slow');

            $("#Transport_travel_type input, #Transport_travel_in_out input").change(function(){
                if(console) console.log($("#Transport_travel_type input:checked").val());
                if(console) console.log($("#Transport_travel_in_out input:checked").val());
                var key1 = $("#Transport_travel_type input:checked").val();
                var key2 = $("#Transport_travel_in_out input:checked").val();

                if(key1 == 1 && key2 == 1) {
                    $('#departmentField').hide('slow');
                    $('#supervisorField').hide('slow');
                    $('#supervisorPMS').show('slow');
                } else if (key1 == 1 && key2 == 0) {
                    $('#departmentField').hide('slow');
                    $('#supervisorField').hide('slow');
                    $('#supervisorPMS').hide('slow');
                } else if (key1 == 0 && key2 == 0) {
                    $('#departmentField').show('slow');
                    $('#supervisorField').hide('slow');
                    $('#supervisorPMS').hide('slow');
                } else if (key1 == 0 && key2 == 1) {
                    $('#departmentField').show('slow');
                    $('#supervisorField').hide('slow');
                    $('#supervisorPMS').hide('slow');
                }
            });
        } else {
            $("#Transport_travel_type input, #Transport_travel_in_out input").change(function(){
                if(console) console.log($("#Transport_travel_type input:checked").val());
                if(console) console.log($("#Transport_travel_in_out input:checked").val());
                var key1 = $("#Transport_travel_type input:checked").val();
                var key2 = $("#Transport_travel_in_out input:checked").val();

                if(key1 == 1 && key2 == 1) {
                    $('#departmentField').hide('slow');
                    $('#supervisorField').hide('slow');
                    $('#supervisorPMS').show('slow');
                } else if (key1 == 1 && key2 == 0) {
                    $('#departmentField').hide('slow');
                    $('#supervisorField').hide('slow');
                    $('#supervisorPMS').hide('slow');
                } else {
                    $('#departmentField').show('slow');
                    $('#supervisorField').show('slow');
                    $('#supervisorPMS').hide('slow');
                }
            });
        }
    });
</script>
