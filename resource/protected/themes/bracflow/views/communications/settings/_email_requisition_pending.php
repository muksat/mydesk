<font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Dear Concern</font><br /><br />
<b><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Communication Service Requisition Request #<?php echo $model->id; ?> is waiting for your approval.</font></b>
<br /><br />
<b><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php echo CHtml::link('APPROVE', Yii::app()->createAbsoluteUrl('communications/settings/approve', array('id'=>$model->id,'email'=>$requester['Email'],'key'=>$model->code, 'service'=> $service))); ?></font></b>
&nbsp; | &nbsp;
<b><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php echo CHtml::link('DECLINE', Yii::app()->createAbsoluteUrl('communications/settings/decline', array('id'=>$model->id,'email'=>$requester['Email'],'key'=>$model->code, 'service'=> $service))); ?></font></b>
<br /><br />
<table border="1" width="100%" style="border-collapse: collapse" cellpadding="5" cellspacing="5">
    <tr>
        <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Requester:</font></td>
        <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php  echo  $requester['Fname'].' '.$requester['Mname']. ' '. $requester['Lname']; ?>, <?php echo $requester['PIN']; ?>, <?php echo $requester['Level']; ?>, <?php echo $requester['Designation']; ?>, <?php  echo $requester['Project']; ?></font></td>
    </tr>
    <?php 
    if($service == "Photography")
    include_once '_email_template_photography.php'; 
    else if($service == "Design")
    include_once '_email_template_design.php'; 
    else if($service == "Audiovisual")
    include_once '_email_template_audiovisual.php'; 
    else if($service == "Printing")
    include_once '_email_template_printing.php'; 
    ?>
    <tr>
        <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Remarks: </font></td>
        <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php echo $model->brief;?></font></td>
    </tr>
</table>
<br />
<font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Thanks</font><br />
<font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">myDesk Team</font><br />