<tr>
    <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Request Info:</font></td>
    <td>
        <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">
        <strong>Request Type: </strong> <?php echo $service; ?>, 
        <strong>Requested Service/Package: </strong><?php echo Settings::model()->findByPk($model->item)->item; ?>, 
        <strong>Location:</strong> <?php echo $model->location; ?>
        <strong>Brief:</strong> <?php echo $model->brief; ?>
        </font>
        <br/>
        <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><?php if ($model->days) { ?><strong>Number of Days: </strong> <?php echo $model->days;
}
?>, <strong>Date Range:</strong> <?php echo Yii::app()->dateFormatter->format("d MMM, y H:mm", $model->fromdate) ?> <strong> To</strong>   <?php echo Yii::app()->dateFormatter->format("d MMM, y H:mm", $model->todate) ?> </font><br/>            
        <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"><strong>Est. Total: </strong><?php echo $model->est_total; ?>  </font><br/>            
    </td>
</tr>

