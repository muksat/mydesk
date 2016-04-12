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
$hrdService = new HrdService;
$teamUser = $hrdService->getProgrammeUsers("H76");

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'team-members-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'ui form')
        ));
?>          
<div class="ui fluid form segment" style="background: rgba(0, 0, 0 , 0.1); margin-top: 0">
    <?php echo $form->errorSummary($model, '', '', array('class' => 'ui error message', 'style' => 'display:block; border: 1px solid; margin-top:0')); ?>


    <div class="field">
        <?php echo $form->labelEx($model, 'team_id'); ?>
        <?php // echo $form->textField($model, 'team_id'); ?>
        <?php echo $form->dropDownList($model, 'team_id', CHtml::listData(Teams::model()->findAll(), 'id', 'name'), array('type' => 'text', 'class' => 'ui mini selection dropdown', 'placeholder' => 'Select')); ?>
        <?php echo $form->error($model, 'team_id'); ?>
    </div>


    <!--        <div class="field">
    <?php //echo $form->labelEx($model, 'user_id'); ?>
    <?php //echo $form->textField($model, 'user_id'); ?>
    <?php //echo $form->dropDownList($model,'user_id', CHtml::listData(User::model()->findAll(), 'id', 'username') , array( 'type'=>'text','class'=>'ui mini selection dropdown','placeholder'=>'Select')); ?>            
    <?php //echo $form->error($model, 'user_id'); ?>
            </div>-->

    <div class="field">
        <?php echo $form->labelEx($model, 'user_pin'); ?>
        <?php //echo $form->textField($model, 'user_id'); ?>
        <?php
        echo $form->dropDownList($model, 'user_pin', CHtml::listData($teamUser, 'PIN', function($item) {
                    return CHtml::encode($item['Fname'] . ' ' . $item['Mname'] . ' ' . $item['Lname']);
                }), array('type' => 'text', 'class' => 'ui mini selection dropdown', 'placeholder' => 'Select'));
        ?>
        <?php echo $form->hiddenField($model, 'user_name'); ?>        
        <?php echo $form->error($model, 'user_pin'); ?>
    </div>
    <div class="field">
        <?php echo $form->labelEx($model, 'team_lead'); ?>
        <?php echo $form->checkBox($model, 'team_lead'); ?>        
        <?php echo $form->error($model, 'team_lead');  ?>
    </div>

    <div class="row buttons">
<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');   ?>
        <div class="ui right small submit teal labeled icon button">
            <i class="right arrow icon"></i>
            Save
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#TeamMembers_user_pin').on('change', function(){
        $('#TeamMembers_user_name').val($('#TeamMembers_user_pin option:selected').text());
    })
</script>
<?php $this->endWidget(); ?>
