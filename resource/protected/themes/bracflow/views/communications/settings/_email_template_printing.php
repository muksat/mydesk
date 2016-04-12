<tr>
    <td><font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">Request Info:</font></td>
    <td>
        <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">
        <strong>Request Type: </strong> <?php echo $service; ?>,
        <strong>Requested Service/Package:</strong> <?php echo $model->item_id; ?>,
        <strong> Print Type:</strong><?php echo Settings::model()->findByPk($model->design_id)->type; ?>,
        <strong> Quantity:</strong> <?php echo $model->qty; ?>
        </font>
        <br/>
        
        <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2"></font><br/>            
        
        <font face="Default Sans Serif,Verdana,Arial,Helvetica,sans-serif" size="2">
        <strong>Est. Total: </strong><?php echo $model->est_total; ?> 
        </font>
        <br/>
    </td>
</tr>

