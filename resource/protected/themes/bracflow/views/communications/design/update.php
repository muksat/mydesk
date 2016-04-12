<?php
$this->layout = "//layouts/column2_com";
?>
<h3 class="ui header dividing" style="margin-top: 0">Update Design Request</h3>
<?php
$this->renderpartial('//communications/default/_menu', array('active'=>'form'));
$this->renderPartial('_form', array('model'=>$model,'packagelist'=>$packagelist,'colorlist'=>$colorlist,'sizelist'=>$sizelist)); 
$item_id_name = Settings::model()->findByPk($model->item_id)->item;
$item_id_size = $model->size;
?>
<script type="text/javascript">    
   jQuery(function(){
       jQuery('.item_update').val(<?php echo '"' .$item_id_name.'"';?>).trigger('change');
       setTimeout(function(){
            jQuery('.size_update').val(<?php echo '"' .$item_id_size.'"';?>);
        }, 1000);
   });
</script>

<script type="text/javascript">
    if($('.Design_est_total').val()) {
        $('.est_total_value').text($('.Design_est_total').val());    
    }    
</script>

  