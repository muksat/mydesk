<?php $this->layout = "//layouts/column2_com"; ?>

<h3 class="ui dividing  header" style="margin-top: 0" id='headerTop'>Design Service Requests Administration</h3>
<div id="view-modal" class="view ui modal " style="background: #eee">Loading...</div>
    <?php $this->renderPartial('//communications/default/_menu', array('active' => 'user')); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'communication-grid',
    'dataProvider' => $model->search(),
    'itemsCssClass' => 'ui basic table segment',
    //'filter'=>$model,
    'columns' => array(
        array(
            'name' => 'item_id',
            'type' => 'raw',
            'value' => 'Settings::model()->findByPk($data->item_id)->item',
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
            'name' => 'est_total',
            'value' => '"BDT-".$data->est_total',
            'htmlOptions' => array('style' => 'font-weight:bold;')
        ),
        'team_id',
        array(
            'name' => 'team_id',
            'type' => 'raw',
            'value' => '(Teams::model()->findByPk($data->team_id)->name != "") ? Teams::model()->findByPk($data->team_id)->name : "N/A"',
        ),
        'user_id',
        /*
          'created_by',
          'created_time',
          'updated_by',
          'updated_time',
          'status',
         */
     array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}{assign}',
            'updateButtonLabel' => CHtml::decode("<i title='edit' class='edit icon'></i>"),
            'updateButtonImageUrl' => false,
            'updateButtonOptions' => array(
            'class' => 'ui mini circular  green button icon',
            ),
            'deleteButtonLabel' => CHtml::decode("<i title='remove' class='remove icon'></i>"),
            'deleteButtonImageUrl' => false,
            'deleteButtonOptions' => array(
                'class' => 'ui mini circular  red button  icon',
            ),
            'buttons' => array(
                'assign' => array(
                    'label' => CHtml::decode("&nbsp;<i class='arrow right icon'></i>&nbsp;"),
                    'url' => 'Yii::app()->createUrl("communications/design/assignToTeam", array("id" => $data->id))',
                    'options' => array(
                        'class'=> 'ui mini circular blue button icon assign',                        
                    )
                ),             
            )
        ),
        
        
    ),
));
?>
<script type="text/javascript">
    $(function () {
        $('td.button-column a.assign').on('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#loading').show();
            $.ajax({
                async: false,
                url: $(e.target).attr('href'),
                success: function (data) {
                    if ($('#view-modal')) {
                        $('#view-modal').html(data);
                        $('#view-modal').modal();                        
                        $('#view-modal').modal('hide', function(){$('#view-modal').empty()});
                        $('#view-modal').modal('setting', 'transition', "vertical flip");
                        $('#view-modal').modal('attach events', '.top-close-button', 'hide');                        
                        $('#view-modal').modal('show');                        
                        $('#loading').hide();
                    }
                }
            });
            return false;
        });
    });
</script>
