<?php
$this->renderPartial('_menu', array('active' => 'supervisor'));
?>
<h2 class="ui dividing header">New Supervisor</h2>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>