<?php
$this->layout = "//layouts/column2_com";
?>
<h3 class="ui header dividing" style="margin-top: 0">Printing Service Request</h3>
<?php
$this->renderpartial('//communications/default/_menu', array('active'=>'form'));
$this->renderPartial('_form', array('model'=>$model,'packagelist'=>$packagelist,'typelist'=>$typelist));
?>