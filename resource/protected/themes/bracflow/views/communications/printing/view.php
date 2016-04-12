<?php
$this->layout = "//layout/main";
?>
<i class="top-close-button close red icon" style="top: 1em; right: 1em"></i>
<div class="ui header" style="padding: 1rem">
    Printing  Service Request # <?php echo $model->id; ?>
</div>
<div class="content" style="background: #eee; padding: 0.5em">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'ui table segment view-table'),
        'attributes' => array(
            'item_id',
            array(
                'name' => 'design_id',
                'type' => 'raw',
                'value' => Settings::model()->findByPk($model->design_id)->type,
            ),
            'qty',
            'brief',
            'est_total'
        ),
    ));
    ?>
</div>
<div class="actions" style="padding: 0.5rem">
    <div class="ui button close small red labeled icon">
        <i class="remove circle icon"></i>
        Close
    </div>
</div>