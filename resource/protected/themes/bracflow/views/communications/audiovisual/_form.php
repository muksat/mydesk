<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/smoothness/jquery-ui-1.10.4.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/jquery-ui-timepicker-addon.min.css">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'audiovisual-form',
    'enableAjaxValidation' => ture,
    // 'enableClientValidation'=>true,
    'htmlOptions' => array('class' => 'ui form')
        ));
?>


<style>
    .ui.selection.dropdown, .ui.selection.dropdown .menu {
        padding: .4em .5em; border: 1px solid #aaa; box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05) !important;
    }
    .ui-datepicker {
        font-size: 13px;
    }
    .required {
        color: #ff0000; font-weight: bold; font-size: 2em; line-height: 13px; vertical-align: text-bottom;
    }
    form#audiovisual-form.ui.form div.ui.fluid.form.segment div.ui.five.fields div.field label{ font-size: .80em}
    form#audiovisual-form .ui.grid > .column {
        margin: 0
    }

</style>

<div class="ui fluid form segment" style="background: rgba(0, 0, 0 , 0.1); margin-top: 0">


    <input type="hidden" id="hrd-user-department-name" value="<?php echo $model1[0]['Project'] ?>">
    <?php echo $form->errorSummary($model, '', '', array('class' => 'ui error message', 'style' => 'display:block; border: 1px solid; margin-top:0')); ?>

    <div class="ui grid com-form">	

        <div class="six wide column">
            <div class="field">
                <?php echo $form->labelEx($model, 'item_id'); ?>
                <div class="ui mini input">   

                    <?php
                    echo $form->dropDownList($model, 'item_id', CHtml::listData($packagelist, 'id', function($item) {
                                return CHtml::encode($item->item . " [BDT " . $item->price . "/PER MIN]");
                            }), array('class' => 'ui mini selection dropdown', 'placeholder' => 'Select'));
                    ?>                                           
                </div>
                <?php echo $form->error($model, 'item_id'); ?>
            </div>            
        </div>


        <div class="three wide column">
            <div class="field">
                <?php echo $form->labelEx($model, 'duration'); ?>
                <div class="ui mini input">   
                    <?php echo $form->textField($model, 'duration', array('size' => 45, 'maxlength' => 45)); ?>
                </div>
                <?php //echo $form->error($model, 'duration'); ?>
            </div>            
        </div>



        <div class="three wide column">
            <div class="field">
                <?php echo $form->labelEx($model, 'est_delivery_date'); ?>
                <div class="ui mini input">   
                    <?php echo $form->textField($model, 'est_delivery_date'); ?>
                </div>
                <?php //echo $form->error($model, 'est_delivery_date'); ?>
            </div>            
        </div>


        




        <div class="six wide column">            
            <div class="field" id="supervisorField">
                <label for="supervisor_id">Supervisor <span class="required">*</span> <a id="supervisor-program" class="active" href="#">Program</a> | <a  id="supervisor-all" href="#">All</a> </label>
                <?php
                $hrdata = new HrdService;
                $model1 = $hrdata->getHrUser(Yii::app()->user->name);
                $sp_name = Supervisor::model()->findAll(array('select' => 'name, id', 'order' => 'name ASC'));
                $sp_name_dept = Supervisor::model()->findAll(array('select' => 'id, name', 'condition' => 'dept=:dept', 'params' => array(':dept' => $model1[0]['Project']), 'order' => 'name ASC'));
                echo $form->dropDownList($model, 'supervisor_id', CHtml::listData($sp_name_dept, 'id', 'name'), array('class' => 'ui selection dropdown supervisor-program'));
                echo $form->dropDownList($model, 'supervisor_id', CHtml::listData($sp_name, 'id', 'name'), array('disabled' => 'disabled', 'empty' => 'Select Name...', 'class' => 'ui selection dropdown supervisor-all', 'style' => 'display:none'));
                ?>                                                  
            </div>  
        </div>


        <div class="six wide column">
            <div class="field">
                <?php echo $form->labelEx($model, 'brief'); ?>
                <div class="ui mini input">   
                    <?php echo $form->textField($model, 'brief', array('size' => 60, 'maxlength' => 140)); ?>
                </div>
                <?php //echo $form->error($model, 'brief'); ?>
            </div>  
        </div>
        <div class="two wide column">
            <div class="field">
                <?php echo $form->labelEx($model, 'est_total'); ?>
                <div class="ui label">
                    <i class="money icon"></i> <span class="est_total_value" id="est_total_value"></span>
                </div>
                <?php echo $form->hiddenField($model, 'est_total', array('class' => 'Audiovisual_est_total')); ?>
            </div>
        </div> 

    </div>


    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/jquery-ui-timepicker-addon.min.js"></script>

    <script type="text/javascript">
        var myControl = {
            create: function (tp_inst, obj, unit, val, min, max, step) {
                $('<input class="ui-timepicker-input" value="' + val + '" style="width:50%">')
                        .appendTo(obj)
                        .spinner({
                            min: min,
                            max: max,
                            step: step,
                            change: function (e, ui) { // key events
                                // don't call if api was used and not key press
                                if (e.originalEvent !== undefined)
                                    tp_inst._onTimeChange();
                                tp_inst._onSelectHandler();
                            },
                            spin: function (e, ui) { // spin events
                                tp_inst.control.value(tp_inst, obj, unit, ui.value);
                                tp_inst._onTimeChange();
                                tp_inst._onSelectHandler();
                            }
                        });
                return obj;
            },
            options: function (tp_inst, obj, unit, opts, val) {
                if (typeof (opts) == 'string' && val !== undefined)
                    return obj.find('.ui-timepicker-input').spinner(opts, val);
                return obj.find('.ui-timepicker-input').spinner(opts);
            },
            value: function (tp_inst, obj, unit, val) {
                if (val !== undefined)
                    return obj.find('.ui-timepicker-input').spinner('value', val);
                return obj.find('.ui-timepicker-input').spinner('value');
            }
        };

        $('#Audiovisual_est_delivery_date').datetimepicker({
            controlType: myControl,
            timeFormat: 'HH:mm',
            dateFormat: 'yy-mm-dd'
        });

        $('#Audiovisual_duration').on('input', function () {
            var days = $(this).val();
            var serviceTotal = days * getPackagePrice($('#Audiovisual_item_id>option:selected').text());
            $('#est_total_value').text(serviceTotal);
            $('#Audiovisual_est_total').val(serviceTotal);
        });

        $('#Audiovisual_item_id').on('change', function () {
            if ($('#Audiovisual_duration').val() == "") {
                return true;
            } else {
                var days = $('#Audiovisual_duration').val();
                var serviceTotal = days * getPackagePrice($('#Audiovisual_item_id>option:selected').text());
                $('#est_total_value').text(serviceTotal);

            }
        });
        function getPackagePrice(data) {
            var selectedPackagePrice = data.substr(data.indexOf('['), data.indexOf(']'));
            selectedPackagePrice = selectedPackagePrice.replace('[BDT', '');
            selectedPackagePrice = selectedPackagePrice.replace('/PER MIN]', '');
            selectedPackagePrice = parseInt(selectedPackagePrice);
            return selectedPackagePrice;
        }
                    
        $('#supervisor-program').click(function(){
            $('#supervisor-program, #supervisor-all').removeClass('active');$('#supervisor-program').addClass('active');
            $('select.supervisor-all').attr('disabled','disabled').hide();
            $('select.supervisor-program').removeAttr('disabled').show();
            return false;
        });
        $('#supervisor-all').click(function(){
            $('#supervisor-program, #supervisor-all').removeClass('active');$('#supervisor-all').addClass('active');
            $('select.supervisor-program').attr('disabled','disabled').hide();
            $('select.supervisor-all').removeAttr('disabled').show();
            return false;
        });
        
    </script>

</div>
<div class="four wide column middle column row">
    <div class="row buttons" style="text-align: right;">
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Submit',  array('class'=>'teal labeled icon ui button small'));     ?>
        <div class="ui right small submit teal labeled icon button">
            <i class="right arrow icon"></i>
            Send
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

