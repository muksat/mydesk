<?php
$this->layout = "//layouts/column2_com";
?>
<h3 class="ui header dividing" style="margin-top: 0">Update Photography Request </h3>
<?php
$this->renderpartial('//communications/default/_menu', array('active'=>'form'));
$this->renderPartial('_form', array('model' => $model, 'packagelist' => $packagelist)); 
?>
<script type="text/javascript">
    if(jQuery('.Photography_est_total').val()) {
        jQuery('.est_total_value').text($('.Photography_est_total').val());    
    }    
</script>
