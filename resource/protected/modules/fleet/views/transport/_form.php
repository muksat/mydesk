<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transport-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'pin'); ?>
		<?php echo $form->textField($model,'pin'); ?>
		<?php echo $form->error($model,'pin'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'travel_type'); ?>
		<?php echo $form->textField($model,'travel_type'); ?>
		<?php echo $form->error($model,'travel_type'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'travel_reason'); ?>
		<?php echo $form->textField($model,'travel_reason',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'travel_reason'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'travel_in_out'); ?>
		<?php echo $form->textField($model,'travel_in_out'); ?>
		<?php echo $form->error($model,'travel_in_out'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'return_date'); ?>
		<?php echo $form->textField($model,'return_date'); ?>
		<?php echo $form->error($model,'return_date'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'start_point'); ?>
		<?php echo $form->textField($model,'start_point',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'start_point'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'end_point'); ?>
		<?php echo $form->textField($model,'end_point',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'end_point'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'passanger'); ?>
		<?php echo $form->textField($model,'passanger'); ?>
		<?php echo $form->error($model,'passanger'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'vehicle_type'); ?>
		<?php echo $form->textField($model,'vehicle_type',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'vehicle_type'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'bill_dept'); ?>
		<?php echo $form->textField($model,'bill_dept',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'bill_dept'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'onbehalf_pin'); ?>
		<?php echo $form->textField($model,'onbehalf_pin'); ?>
		<?php echo $form->error($model,'onbehalf_pin'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'flow_attachment_id'); ?>
		<?php echo $form->textField($model,'flow_attachment_id'); ?>
		<?php echo $form->error($model,'flow_attachment_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'transport_flow_supervisor_id'); ?>
		<?php echo $form->textField($model,'transport_flow_supervisor_id'); ?>
		<?php echo $form->error($model,'transport_flow_supervisor_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
		<?php echo $form->error($model,'update_time'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>