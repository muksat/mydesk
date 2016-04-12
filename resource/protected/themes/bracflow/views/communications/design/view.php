<?php
$this->layout = "//layout/main";
?>
<i class="top-close-button close red icon" style="top: 1em; right: 1em"></i>
<div class="ui header" style="padding: 1rem">
    Design  Service Request # <?php echo $model->id; ?>
</div>
<div class="content" style="background: #eee; padding: 0.5em">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'ui table segment view-table'),
        'attributes' => array(
            array(
                'name' => 'item_id',
                'type' => 'raw',
                'value' => Settings::model()->findByPk($model->item_id)->item,
            ),
            'qty',
            array(
                'name' => 'est_delivery_date',
                'value' => Yii::app()->dateFormatter->format("d MMM, y", strtotime($data->est_delivery_date))
            ),
            'brief',
            'est_total',
            array(
                'name' => 'supervisor_id',
                'type' => 'raw',
                'value' => Supervisor::model()->findByPk($model->supervisor_id)->name
            ),
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