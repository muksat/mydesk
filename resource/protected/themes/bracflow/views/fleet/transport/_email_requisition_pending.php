<font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Dear Concern</font><br /><br />
<b><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Transport Requisition Request #<?php echo $model->id; ?> is waiting for your approval.</font></b>
<br /><br />
<b><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php echo CHtml::link('APPROVE', Yii::app()->createAbsoluteUrl('fleet/transport/approve', array('id'=>$model->id,'email'=>$model1[0]['Email'],'key'=>$model->code))); ?></font></b>
&nbsp; | &nbsp;
<b><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php echo CHtml::link('DECLINE', Yii::app()->createAbsoluteUrl('fleet/transport/decline', array('id'=>$model->id,'email'=>$model1[0]['Email'],'key'=>$model->code))); ?></font></b>
&nbsp; | &nbsp;
<b><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php echo CHtml::link('REVIEW', Yii::app()->createAbsoluteUrl('fleet/transport/review', array('id'=>$model->id,'email'=>$rec_mail,'key'=>$model->code))); ?></font></b>
<br /><br />
<table border="1" width="100%" style="border-collapse: collapse" cellpadding="5" cellspacing="5">
    <tr>
        <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Requester:</font></td>
        <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php  echo  $model->user_name; ?>, <?php echo $model->pin; ?>, <?php echo $model->level; ?>, <?php echo $model1[0]['Designation']; ?>, <?php  echo $model1[0]['Project']; ?></font></td>
    </tr>
    <tr>
        <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Traveling Info:</font></td>
        <td>
            <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Date: <?php echo Yii::app()->dateFormatter->format("d MMM, y H:mm", $model->start_date) ?>  To   <?php echo Yii::app()->dateFormatter->format("d MMM, y H:mm", $model->return_date) ?></font> <br/>
            <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Location: <?php echo $model->start_point; ?>  To  <?php echo $model->end_point; ?></font><br/>
            <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Passenger: <?php echo $model->passanger; ?></font>
        </td>
    </tr>
    <tr>
        <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Reason:</font></td>
        <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php echo $model->travel_reason;  ?></font></td>
    </tr>
</table>
<br />
<font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Thanks</font><br />
<font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">myDesk Team</font><br />