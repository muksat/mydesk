<?php
/* @var $this TransportController */
/* @var $data Transport */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pin')); ?>:</b>
	<?php echo CHtml::encode($data->pin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('travel_type')); ?>:</b>
	<?php echo CHtml::encode($data->travel_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('travel_reason')); ?>:</b>
	<?php echo CHtml::encode($data->travel_reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('travel_in_out')); ?>:</b>
	<?php echo CHtml::encode($data->travel_in_out); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('return_date')); ?>:</b>
	<?php echo CHtml::encode($data->return_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('start_point')); ?>:</b>
	<?php echo CHtml::encode($data->start_point); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_point')); ?>:</b>
	<?php echo CHtml::encode($data->end_point); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passanger')); ?>:</b>
	<?php echo CHtml::encode($data->passanger); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_type')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_dept')); ?>:</b>
	<?php echo CHtml::encode($data->bill_dept); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onbehalf_pin')); ?>:</b>
	<?php echo CHtml::encode($data->onbehalf_pin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flow_attachment_id')); ?>:</b>
	<?php echo CHtml::encode($data->flow_attachment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transport_flow_supervisor_id')); ?>:</b>
	<?php echo CHtml::encode($data->transport_flow_supervisor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supervisor_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->supervisor_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	*/ ?>

</div>