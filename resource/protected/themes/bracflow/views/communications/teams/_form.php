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
    'id' => 'teams-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'ui form')
        ));
?>
<div class="ui fluid form segment" style="background: rgba(0, 0, 0 , 0.1); margin-top: 0">
    <?php echo $form->errorSummary($model, '', '', array('class' => 'ui error message', 'style' => 'display:block; border: 1px solid; margin-top:0')); ?>
    <div class="field">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 145)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="field">
        <?php echo $form->labelEx($model, 'service_tag'); ?>
        <?php echo $form->dropDownList($model, 'service_tag', $model->service_tags, array('class' => 'ui mini selection dropdown')); ?>
        <?php echo $form->error($model, 'service_tag'); ?>
    </div>
    <div class="field">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 300)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <div class="row buttons">
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <div class="ui right small submit teal labeled icon button">
            <i class="right arrow icon"></i>
            Save
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
