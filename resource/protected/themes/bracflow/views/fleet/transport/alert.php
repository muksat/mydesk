<div class="ui red message" style="border: 1px solid; font-weight: bold; font-size: 12px;">
<?php
foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>";
}
?>
</div>