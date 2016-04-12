<?php
$this->layout = "//layouts/column2_com";
?>
<h3 class="ui header dividing" style="margin-top: 0">Request for photography</h3>
<?php $this->renderPartial('//communications/default/_menu', array('active' => 'form')); ?>
<?php $this->renderPartial('_form', array('model' => $model, 'packagelist' => $packagelist)); ?>
