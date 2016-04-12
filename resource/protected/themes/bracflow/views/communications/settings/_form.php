<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/smoothness/jquery-ui-1.10.4.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/jquery-ui-timepicker-addon.min.css">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'settings-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'ui form')
        ));
?>
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

<div class="ui fluid form segment" style="background: rgba(0, 0, 0 , 0.1); margin-top: 0">
    <?php echo $form->errorSummary($model, '', '', array('class' => 'ui error message', 'style' => 'display:block; border: 1px solid; margin-top:0')); ?>

    <div class="ui three fields">
        <div class="field">
            <?php echo $form->labelEx($model, 'item'); ?>
            <?php echo $form->textField($model, 'item', array('size' => 60, 'maxlength' => 127)); ?>
            <?php echo $form->error($model, 'item'); ?>
        </div>
        <div class="field">
            <?php echo $form->labelEx($model, 'price'); ?>
            <?php echo $form->textField($model, 'price', array('size' => 60, 'maxlength' => 127)); ?>
            <?php echo $form->error($model, 'price'); ?>
        </div>
        <div class="field">
            <?php echo $form->labelEx($model, 'category'); ?>
            <?php //echo $form->textField($model, 'category', array('size' => 60, 'maxlength' => 127)); ?>
            <?php echo $form->dropDownList($model,'category',array('photography' => 'Photography', 'design' => 'Design','audiovisual' => 'Audiovisual', 'printing' => 'Printing'),
                                          array('empty' => '--Select--','class' => 'ui mini selection dropdown')); ?>

            <?php echo $form->error($model, 'category'); ?>
        </div>	        
    </div>
    <div class="ui three fields">
        <div class="field">
            <?php echo $form->labelEx($model, 'size'); ?>
            <?php echo $form->textField($model, 'size', array('size' => 60, 'maxlength' => 127)); ?>
            <?php echo $form->error($model, 'size'); ?>
        </div>
        <div class="field">
            <?php echo $form->labelEx($model, 'color'); ?>
            <?php //echo $form->textField($model, 'color', array('size' => 60, 'maxlength' => 127)); ?>
             <?php echo $form->dropDownList($model,'color',array('Single' => 'Single', 'Bi-color' => 'Bi-color','4-color' => '4-color'),
                                          array('empty' => '--Select--','class' => 'ui mini selection dropdown')); ?>
            <?php echo $form->error($model, 'color'); ?>
        </div>
        
        
        
        <div class="field">
            <?php echo $form->labelEx($model, 'type'); ?> 
            <?php //echo $form->textField($model, 'type', array('size' => 60, 'maxlength' => 127)); ?>
            
             <?php echo $form->dropDownList($model,'type',array('A3-color' => 'A3-color', 'A4-Color' => 'A4-Color','A4-Black & White' => 'A4-Black & White'),
                                          array('empty' => '--Select--','class' => 'ui mini selection dropdown')); ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>
    </div>

    <div class="ui three fields">
<!--        <div class="field">
            <?php //echo $form->labelEx($model, 'status'); ?>
            <?php //echo $form->textField($model, 'status', array('size' => 60, 'maxlength' => 127)); ?>
            <?php //echo $form->error($model, 'status'); ?>
        </div>-->
    </div>

    <div class="row buttons">
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Submit',  array('class'=>'teal labeled icon ui button small'));  ?>
        <div class="ui right small submit teal labeled icon button">
            <i class="right arrow icon"></i>
            Save
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

