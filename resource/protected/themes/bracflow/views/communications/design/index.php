<style type="text/css">
    #communication-grid table th a{
        font-weight: bold; color: #999; border-bottom: 1px dashed #ccc;
    }
</style>

<?php $this->layout = "//layouts/column2_com"; ?>

<h3 class="ui dividing header" style="margin-top: 0" id='headerTop'>My Design Service Requests</h3>
<?php $this->renderPartial('//communications/default/_menu', array('active' => 'user')); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'communication-grid',
    'itemsCssClass' => 'ui basic table segment',
    'filter' => $model,
    'filterPosition' => '',
    'columns' => array(
        'id',
        array(
            'name' => 'item_id',
            'type' => 'raw',
            'value' => 'CHtml::link(Settings::model()->findByPk($data->item_id)->item,array("view","id"=>$data->id))',
            'htmlOptions' => array('class'=>'view', 'style' => 'font-weight:bold; text-decoration:underline')
        ),
        'size',
        'color',
        'qty',
        array(
            'name' => 'est_delivery_date',
            'value' => 'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->est_delivery_date))'
        ),
        'brief',
        array(
            'name' => 'status',
            'type' => 'html',
            'value' => 'getStatus($data->status)',
        ),
       array(
            'name' => 'est_total',
            'value' => '"BDT ".$data->est_total',
            'htmlOptions' => array('style' => 'font-weight:bold;'),
        ),
        
            array(
            'class' => 'CButtonColumn',
            'template' => '{feedback}',
            'buttons' => array(
                'feedback' => array(
                    'label' => "Feedback",
                    'url' => 'Yii::app()->createUrl("//communications/default/feedback", array("id" => $data->id,"service"=>"design"))',
                    'visible'=> 'TeamMembers::model()->isFeedbackGiven($data->id, "design")',
                    'options' => array(
                        'class' => 'ui mini green button icon',
                    )
                ),
            )
        ),
        
    ),
));
function getStatus($index) {
    if ($index == 0)
        return '<span class="ui small label">' . Settings::model()->status[$index] . '</span>';
    else if ($index == 1)
        return '<span class="ui small green label">' . Settings::model()->status[$index] . '</span>';
    else if ($index == 2)
        return '<span class="ui small orange label">' . Settings::model()->status[$index] . '</span>';
     else if ($index == 3)
        return '<span class="ui small blue label">' . Settings::model()->status[$index] . '</span>';      
    else if ($index == 4)
        return '<span class="ui small teal label">' . Settings::model()->status[$index] . '</span>';
      
}
?>
<div id="view-modal" class="view ui modal" style="background: #eee">Loading...</div>
<script type="text/javascript">
    $(function () {
        $('#communication-grid td.view a').on('click', function (e) {
            $('#loading').show();
            $.ajax({
                url: $(e.target).attr('href'),
                success: function (data) {
                    $('#view-modal').html(data);
                    $('.view.ui.modal').modal('setting', 'transition', "vertical flip").modal('show');
                    $('.view.ui.modal').modal('attach events', '.ui.button.small.close', 'hide');
                    $('.view.ui.modal').modal('attach events', '.top-close-button', 'hide');
                    $('#loading').hide();
                }
            });
            return false;
        })
        if ($('.ui.green.message')) {
            $('.ui.green.message').transition('pulse');
            $('.ui.green.message').focus();
        }
    });
</script> 