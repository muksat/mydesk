<?php
$this->layout = "//layouts/column2_com";
?>
<h3 class="ui header dividing" style="margin-top: 0">Update Team</h3>
<?php
$this->renderpartial('//communications/settings/_menu', array('active'=>'form'));
$this->renderPartial('_form', array('model'=>$model)); 
?>