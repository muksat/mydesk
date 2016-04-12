<?php
/* @var $this TransportController */
/* @var $model Transport */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pin'); ?>
		<?php echo $form->textField($model,'pin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'travel_type'); ?>
		<?php echo $form->textField($model,'travel_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'travel_reason'); ?>
		<?php echo $form->textField($model,'travel_reason',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'travel_in_out'); ?>
		<?php echo $form->textField($model,'travel_in_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'return_date'); ?>
		<?php echo $form->textField($model,'return_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_point'); ?>
		<?php echo $form->textField($model,'start_point',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_point'); ?>
		<?php echo $form->textField($model,'end_point',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'passanger'); ?>
		<?php echo $form->textField($model,'passanger'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_type'); ?>
		<?php echo $form->textField($model,'vehicle_type',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bill_dept'); ?>
		<?php echo $form->textField($model,'bill_dept',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'onbehalf_pin'); ?>
		<?php echo $form->textField($model,'onbehalf_pin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flow_attachment_id'); ?>
		<?php echo $form->textField($model,'flow_attachment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transport_flow_supervisor_id'); ?>
		<?php echo $form->textField($model,'transport_flow_supervisor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'supervisor_remarks'); ?>
		<?php echo $form->textField($model,'supervisor_remarks',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->