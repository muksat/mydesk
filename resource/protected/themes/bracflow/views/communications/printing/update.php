<?php
$this->layout = "//layouts/column2_com";
?>
<h3 class="ui header dividing" style="margin-top: 0">Update Printing Request</h3>
<?php
$this->renderpartial('//communications/default/_menu', array('active'=>'form'));
$this->renderPartial('_form', array('model'=>$model,'packagelist'=>$packagelist, 'colorlist' => $color,)); 
?>
<script type="text/javascript">
    if(jQuery('.Printing_est_total').val()) {
        jQuery('.est_total_value').text($('.Printing_est_total').val());    
    }    
</script>