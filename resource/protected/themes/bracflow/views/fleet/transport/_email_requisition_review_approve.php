Dear Concern<?php //echo $rec_mail ?><br /><br />

<b>Transport Requisition Request #<?php echo $model->id; ?> approved with modifications as follows.</b>

<br /><br />
<?php echo CHtml::link('Approve', Yii::app()->createAbsoluteUrl('fleet/transport/approve', array('id'=>$model->id,'email'=>$model1[0]['Email'],'key'=>$model->code)), array('style'=>'padding: 3px 10px; background: green; color: white; text-transform: uppercase; text-decoration: none;border-radius: 15px;'));  ?>
&nbsp;
<?php echo CHtml::link('Decline', Yii::app()->createAbsoluteUrl('fleet/transport/decline', array('id'=>$model->id,'email'=>$model1[0]['Email'],'key'=>$model->code)), array('style'=>'padding: 3px 10px; background: red; color: white; text-transform: uppercase; text-decoration: none;border-radius: 15px;'));  ?>
&nbsp;
<?php echo CHtml::link('Review', Yii::app()->createAbsoluteUrl('fleet/transport/review', array('id'=>$model->id,'email'=>$rec_mail,'key'=>$model->code)), array('style'=>'padding: 3px 10px; background: #aaaaaa; color: white; text-transform: uppercase; text-decoration: none;border-radius: 15px;'));  ?>
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
            Location: <?php echo $model->start_point; ?>  To  <?php echo $model->end_point; ?>
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