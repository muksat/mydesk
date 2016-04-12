<?php
$this->layout = "//layout/main";
?>
<i class="top-close-button close red icon" style="top: 1em; right: 1em"></i>
<div class="ui header" style="padding: 1rem">
    Photography  Service Request # <?php echo $model->id; ?>
</div>
<div class="content" style="background: #eee; padding: 0.5em">
    <?php
    $packageitem = Settings::model()->findByPk($data->item)->item;
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'ui table segment view-table'),
        'attributes' => array(
            array(
                'name' => 'item',
                'type' => 'raw',
                'value' => Settings::model()->findByPk($model->item)->item,
            ),
            'days',
            'location',
            // 'fromdate',
            array(
                'name' => 'fromdate',
                'value' => Yii::app()->dateFormatter->format("d MMM, y", strtotime($model->fromdate))
            ),
            //'todate',
            array(
                'name' => 'todate',
                'value' => Yii::app()->dateFormatter->format("d MMM, y", strtotime($model->todate)),
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