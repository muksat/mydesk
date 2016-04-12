<style type="text/css">
    .ui.selection.dropdown, .ui.selection.dropdown .menu {
        padding: .4em .5em; border: 1px solid #aaa; box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05) !important;
    }
    .ui-datepicker {
        font-size: 13px;
    }
    .required {
        color: #ff0000; font-weight: bold; font-size: 2em; line-height: 13px; vertical-align: text-bottom;
    }
</style>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'supervisor-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'ui form')
    ));
?>

<div class="ui fluid form segment" style="background: rgba(0, 0, 0 , 0.1); margin-top: 0">
    <?php echo $form->errorSummary($model, '', '', array('class' => 'ui error message', 'style' => 'display:block; border: 1px solid; margin-top:0')); ?>
    
    <div class="ui two fields">
        <div class="field">
            <?php echo $form->labelEx($model, 'pin'); ?>
            <?php echo $form->textField($model, 'pin'); ?>
            <?php echo $form->error($model, 'pin'); ?>
        </div>
        <div class="field">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('size' => 40, 'maxlength' => 40)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>      
    </div>
    <div class="ui two fields">
        <div class="field">
            <?php echo $form->labelEx($model, 'designation'); ?>
            <?php echo $form->textField($model, 'designation', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'designation'); ?>
        </div>
        <div class="field">
            <?php echo $form->labelEx($model, 'dept'); ?>
            <?php echo $form->textField($model, 'dept', array('size' => 60, 'maxlength' => 2555)); ?>
            <?php echo $form->error($model, 'dept'); ?>
        </div>        
    </div>
    <div class="field buttons">
            <?php //echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Submit',  array('class'=>'teal labeled icon ui button small')); ?>
            <div class="ui right small submit teal labeled icon button">
                <i class="right arrow icon"></i>
                Save
            </div>
        </div>    
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(function () {
        $('#Supervisor_pin').on('blur', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#loading').show();
            $.ajax({
                async: false,
                dataType:'json',
                /*url: $(e.target).attr('href'),*/
                url: 'userinfo?pin='+$(this).val(),
                success: function (data) {
                    $('#Supervisor_name').val(data['Fname']+ ' ' +data['Mname']+ ' ' +data['Lname']);
                    $('#Supervisor_dept').val(data['Project']);
                    $('#Supervisor_designation').val(data['Designation']);
                    $('#loading').hide();
                }
            });
            return false;
        });
    });
</script>