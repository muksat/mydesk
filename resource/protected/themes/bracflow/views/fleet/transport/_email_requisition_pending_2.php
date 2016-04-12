Dear Concern<?php //echo $rec_mail ?><br /><br />

<b>Transport Requisition Request #<?php echo $model->id; ?> is waiting for your approval.</b>

<br /><br />
<b><?php echo CHtml::link('APPROVE', Yii::app()->createAbsoluteUrl('fleet/transport/approve', array('id'=>$model->id,'email'=>$model1[0]['Email'],'key'=>$model->code))); ?></b>
&nbsp;
<b><?php echo CHtml::link('DECLINE', Yii::app()->createAbsoluteUrl('fleet/transport/decline', array('id'=>$model->id,'email'=>$model1[0]['Email'],'key'=>$model->code))); ?></b>
&nbsp;
<b><?php echo CHtml::link('REVIEW', Yii::app()->createAbsoluteUrl('fleet/transport/review', array('id'=>$model->id,'email'=>$rec_mail,'key'=>$model->code))); ?></b>
<br /><br />
<br /><br />

<table border="1" width="100%" style="border-collapse: collapse" cellpadding="5" cellspacing="5">
    <tr>
        <td>Requester:</td>
        <td><?php  echo  $model->user_name; ?>, <?php echo $model->pin; ?>, <?php echo $model->level; ?>, <?php echo $model1[0]['Designation']; ?>, <?php  echo $model1[0]['Project']; ?></td>
    </tr>
    <tr>
        <td>Traveling Info:</td>
        <td>
            Date: <?php echo Yii::app()->dateFormatter->format("d MMM, y H:mm", $model->start_date) ?>  To   <?php echo Yii::app()->dateFormatter->format("d MMM, y H:mm", $model->return_date) ?> <br/>
            Location: <?php echo $model->start_point; ?>  To  <?php echo $model->end_point; ?><br/>
            Passenger: <?php echo $model->passanger; ?>
        </td>
    </tr>
    <tr>
        <td>Reason:</td>
        <td><?php echo $model->travel_reason;  ?></td>
    </tr>
</table>

<br />
Thanks,<br />
myDesk Team<br />