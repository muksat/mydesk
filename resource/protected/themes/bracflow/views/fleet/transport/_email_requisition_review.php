Dear Concern<?php //echo $rec_mail ?><br /><br />

<b>Your transport requisition request #<?php echo $model->id; ?> has changed by supervisor. Please review the changes</b>

<br /><br />
<?php echo CHtml::link('Review', Yii::app()->createAbsoluteUrl('fleet/transport/userreview', array('id'=>$model->id,'email'=>$rec_mail,'key'=>$model->code)), array('style'=>'padding: 3px 10px; background: #aaaaaa; color: white; text-transform: uppercase; text-decoration: none;border-radius: 15px;'));  ?>
<br /><br />

<table border="1" width="100%" style="border-collapse: collapse" cellpadding="5" cellspacing="5">
    <tr>
        <td>Requester:</td>
        <td><?php  echo  $model->user_name; ?>, <?php echo $model->pin; ?>, <?php echo $model->level; ?>, <?php echo $model1[0]['Designation']; ?>, <?php  echo $model1[0]['Project']; ?></td>
    </tr>
    <tr>
        <td>Traveling Info:</td>
        <td>
            Date: <?php echo Yii::app()->dateFormatter->format("d MMM, y h:mm", $model->start_date) ?>  To   <?php echo Yii::app()->dateFormatter->format("d MMM, y h:mm", $model->return_date) ?> <br/>
            Location: <?php echo $model->start_point; ?>  To  <?php echo $model->end_point; ?><br/>
            Passenger: <?php echo $model->passanger; ?>
        </td>
    </tr>
    <tr>
        <td>Reason:</td>
        <td><?php echo $model->travel_reason;  ?></td>
    </tr>
    <tr>
        <td>Supervisor Remarks:</td>
        <td><?php echo $model->remarks;  ?></td>
    </tr>
</table>

<br />
Thanks<br />
myDesk Team<br />

