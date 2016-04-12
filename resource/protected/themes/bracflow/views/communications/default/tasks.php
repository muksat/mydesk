<?php $this->layout = "//layouts/column2_com"; ?>

<h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Service Requests Administration</h3>
<div id="view-modal" class="view ui modal " style="background: #eee">Loading...</div>
<?php $this->renderPartial('_menu', array('active' => 'user')); ?>
<?php if(TeamMembers::isServiceTeamMember('photography')) { ?>
<br/>
<h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Photography</h3>

<?php
$this->renderPartial('_menu', array('active' => 'user'));
$packageitem = Settings::model()->findByPk($data->item)->item;

$this->widget('zii.widgets.grid.CGridView', array(
    //'id' => 'communications-grid-photography',
    'dataProvider' => $dataPhotography,
    'itemsCssClass' => 'ui basic table segment',
    'columns' => array(
        'id',
        array(
            'name' => 'item',
            'type' => 'raw',
            'value' => 'Settings::model()->findByPk($data->item)->item',
        ),
        'days',
        'location',
        array(
            'name' => 'fromdate',
            'value' => 'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->fromdate))'
        ),
        array(
            'name' => 'todate',
            'value' => 'Yii::app()->dateFormatter->format("d MMM, y",strtotime($data->todate))'
        ),
        array(
            'name' => 'est_total',
            'value' => '"BDT-".$data->est_total',
            'htmlOptions' => array('style' => 'font-weight:bold;')
        ),
        array(
            'name' => 'team_id',
            'type' => 'html',
            'value' => 'getTeam($data->team_id)',
        ),
           array(
                'name' => 'status',
                'type' => 'html',
                'value' => 'getStatus($data->status)',
            ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{assign}',
            'buttons' => array(
                'assign' => array(
                    'label' => CHtml::decode("&nbsp;<i class='checkmark box icon'></i>&nbsp;"),
                    'url' => 'Yii::app()->createUrl("communications/settings/complete", array("id" => $data->id, "service" => "photography" ))',
                    'options' => array(
                        'class' => 'ui mini circular complete blue button icon',
                        'rel' => 'communications-grid-photography'
                    )
                ),
            )
        ),
        
              array(
            'class' => 'CButtonColumn',
            'template' => '{invoice}',
            'buttons' => array(
                'invoice' => array(
                    'label' => "Print Invoice",
                    //'url' => 'Yii::app()->createUrl("communications/photography/invoice?id=".$model->id."&service=".$service)',
                    'url' => 'Yii::app()->createUrl("//communications/default/invoice", array("id" => $data->id,"service"=>"photography"))',
                    'options' => array(
                     'class' => 'ui mini green button icon',
                    )
                ),
            )
        ),
        
        
        
    ),
));
?>

<hr />
<?php } ?>
<?php if(TeamMembers::isServiceTeamMember('design')) { ?>
<br />
<h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Design</h3>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    //'id' => 'communications-grid-design',
    'dataProvider' => $dataDesign,
    'itemsCssClass' => 'ui basic table segment',
    'columns' => array(
        'id',
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
        array(
            'name' => 'team_id',
            'type' => 'html',
            'value' => 'getTeam($data->team_id)',
        ),
           array(
                'name' => 'status',
                'type' => 'html',
                'value' => 'getStatus($data->status)',
            ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{assign}',
            'buttons' => array(
                'assign' => array(
                    'label' => CHtml::decode("&nbsp;<i class='check circle icon'></i>&nbsp;"),
                    'url' => 'Yii::app()->createUrl("communications/settings/complete", array("id" => $data->id, "service" => "design" ))',
                    'options' => array(
                        'class' => 'ui mini circular complete blue button icon',
                        'rel' => 'communications-grid-design'
                    ),
                ),
            )
        ),
        
               array(
                'class' => 'CButtonColumn',
                'template' => '{invoice}',
                'buttons' => array(
                    'invoice' => array(
                        'label' => "Print Invoice",
                        //'url' => 'Yii::app()->createUrl("communications/photography/invoice?id=".$model->id."&service=".$service)',
                        'url' => 'Yii::app()->createUrl("//communications/default/invoice", array("id" => $data->id,"service"=>"design"))',
                        'options' => array(
                            'class' => 'ui mini green button icon',
                        )
                    ),
                )
            ),
        
    ),
));
?>
<hr />
<?php } ?>
<?php if(TeamMembers::isServiceTeamMember('audiovisual')) { ?>
<br />
<h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Audiovisual</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
   // 'id' => 'communications-grid-audiovisual',
    'dataProvider' => $dataAudiovisual,
    'itemsCssClass' => 'ui basic table segment',
    //'filter'=>$model,
    'columns' => array(
        'id',            
        array(
            'name' => 'item_id',
            'type' => 'raw',
            'value' => 'Settings::model()->findByPk($data->item_id)->item',
        ),
        'duration',
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
        array(
            'name' => 'team_id',
            'type' => 'raw',
            'value' => 'Teams::model()->findByPk($data->team_id)->name',
        ),
           array(
                'name' => 'status',
                'type' => 'html',
                'value' => 'getStatus($data->status)',
            ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{assign}',
            'buttons' => array(
                'assign' => array(
                    'label' => CHtml::decode("&nbsp;<i class='check circle icon'></i>&nbsp;"),
                    'url' => 'Yii::app()->createUrl("communications/settings/complete", array("id" => $data->id, "service" => "audiovisual" ))',
                    'options' => array(
                        'class' => 'ui mini circular complete  blue button icon',
                        'rel' => 'communications-grid-audiovisual'
                    )
                ),
            )
        ),
    ),
));
?>
<hr />
<?php } ?>
<?php if(TeamMembers::isServiceTeamMember('printing')) { ?>
<br />
<h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Printing</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    //'id' => 'communications-grid-printing',
    'dataProvider' => $dataPrinting,
    'itemsCssClass' => 'ui basic table segment',
    'columns' => array(
        'id',
        'item_id',
        array(
            'name' => 'design_id',
            'type' => 'raw',
            'value' => 'Settings::model()->findByPk($data->design_id)->type',
        ),
        'qty',
        'brief',
        array(
            'name' => 'est_total',
            'value' => '"BDT-".$data->est_total',
            'htmlOptions' => array('style' => 'font-weight:bold;')
        ),
        array(
            'name' => 'team_id',
            'type' => 'raw',
            'value' => 'Teams::model()->findByPk($data->team_id)->name',
        ),
           array(
                'name' => 'status',
                'type' => 'html',
                'value' => 'getStatus($data->status)',
            ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{assign}',
            'buttons' => array(
                'assign' => array(
                    'label' => CHtml::decode("&nbsp;<i class='check circle icon'></i>&nbsp;"),
                    'url' => 'Yii::app()->createUrl("communications/settings/complete", array("id" => $data->id, "service" => "printing" ))',
                    'options' => array(
                        'class' => 'ui mini circular complete  blue button icon',
                        'rel' => 'communications-grid-printing'
                    )
                ),
            )
        ),
        
             array(
                'class' => 'CButtonColumn',
                'template' => '{invoice}',
                'buttons' => array(
                    'invoice' => array(
                        'label' => "Print Invoice",
                        //'url' => 'Yii::app()->createUrl("communications/photography/invoice?id=".$model->id."&service=".$service)',
                        'url' => 'Yii::app()->createUrl("//communications/default/invoice", array("id" => $data->id,"service"=>"audiovisual"))',
                        'options' => array(
                            'class' => 'ui mini green button icon',
                        )
                    ),
                )
            ),
    ),
));
?>
<hr />
<?php } ?>
<?php
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
function getTeam($data) {
    $team = Teams::model()->findByPk($data)->name;
    if ($team == "")
        return '<span class="ui label small ">N/A</span>';
    else
        return '<span class="ui label small green">' . $team . '</span>';
}
?>
<script type="text/javascript">
    $(function () {
        $('td.button-column a.complete').on('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            if (!confirm('Are you sure you want to mark this task as completed?'))
                return false;
            var tag = ($(e.target).attr('href')) ? $(e.target) : $(e.target).parent();
            $.ajax({
                url: tag.attr('href'),
                success: function (data) {
                    tag.replaceWith('<i class="checkmark box icon"></i>');
                    //var th = this, afterDelete = function () {};
                    //$(tag.attr('rel')).yiiGridView('update', {
                        
                    //});
                    //$.fn.yiiGridView.update(tag.attr('rel'));
                    //$.fn.yiiGridView.update('.grid-view');
                    return false;
                },
                complete: function (data) {
                    return false;
                },
                error: function (data) {
                    return false;
                }
            });
            return false;
        });
    });
</script>
<script type="text/javascript">

//    $(function() {
//    $(document).on('click', '.grid-view a.ui.mini.button.icon.complete', function(e) {
//        e.preventDefault();
//    alert('ho');
//            if (!confirm('Are you sure you want to mark this task as completed?')) return false;
  /*  var th = this,
            afterDelete = function () {
            };
    $('#communication-grid').yiiGridView('update', {
    type: 'POST',
            url: $(this).attr('href'),
            success: function (data) {
                $('#communication-grid').yiiGridView('update');
                afterDelete(th, true, data);
            },
            error: function(XHR) {
            return afterDelete(th, false, XHR);
            }*/
//    });
//            return false;
//    });
</script>

