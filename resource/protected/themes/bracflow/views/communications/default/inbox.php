<?php $this->layout = "//layouts/column2_com"; ?>

<h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Service Requests Administration</h3>
<div id="view-modal" class="view ui modal " style="background: #eee">Loading...</div>
<?php $this->renderPartial('_menu', array('active' => 'user')); ?>
<?php if (TeamMembers::isServiceTeamLead('photography')) { ?>
    <br/>
   
    
    <h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Photography</h3>
    <?php
    $packageitem = Settings::model()->findByPk($data->item)->item;

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'communication-grid',
        'dataProvider' => $dataPhotography,
        'itemsCssClass' => 'ui basic table segment',
        ///'enablePagination' => false,
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
                'name' => 'status',
                'type' => 'html',
                'value' => 'getStatus($data->status)',
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{assign}',
                'buttons' => array(
                    'assign' => array(
                        'label' => CHtml::decode("&nbsp;<i class='arrow right icon'></i>&nbsp;"),
                        'url' => 'Yii::app()->createUrl("communications/photography/assignToTeam", array("id" => $data->id))',
                        'options' => array(
                            'class' => 'ui mini circular blue button icon assign',
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
                        'url' => 'Yii::app()->createUrl("//communications/default/invoice", array("id" => $data->id,"service"=>"photography"))',
                        'visible'=> 'TeamMembers::model()->isInvoiceVisible($data->id, "photography")',
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
<?php if (TeamMembers::isServiceTeamLead('design')) { ?>
    <br />
    <h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Design</h3>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'communication-grid',
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
                        'label' => CHtml::decode("&nbsp;<i class='arrow right icon'></i>&nbsp;"),
                        'url' => 'Yii::app()->createUrl("communications/design/assignToTeam", array("id" => $data->id))',
                        'options' => array(
                            'class' => 'ui mini circular blue button icon assign',
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
                        'url' => 'Yii::app()->createUrl("//communications/default/invoice", array("id" => $data->id,"service"=>"design"))',
                        'visible'=> 'TeamMembers::model()->isInvoiceVisible($data->id, "design")',
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
<?php if (TeamMembers::isServiceTeamLead('audiovisual')) { ?>
    <br />
    <h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Audiovisual</h3>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'communication-grid',
        'dataProvider' => $dataAudiovisual,
        'itemsCssClass' => 'ui basic table segment',
        'columns' => array(
            'id',
            //'item_id',           
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
                        'label' => CHtml::decode("&nbsp;<i class='arrow right icon'></i>&nbsp;"),
                        'url' => 'Yii::app()->createUrl("communications/audiovisual/assignToTeam", array("id" => $data->id))',
                        'options' => array(
                            'class' => 'ui mini circular blue button icon assign',
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
                        'visible'=> 'TeamMembers::model()->isInvoiceVisible($data->id, "audiovisual")',
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
<?php if (TeamMembers::isServiceTeamLead('printing')) { ?>
    <br />
    <h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Printing</h3>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'communication-grid',
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
                        'label' => CHtml::decode("&nbsp;<i class='arrow right icon'></i>&nbsp;"),
                        'url' => 'Yii::app()->createUrl("communications/printing/assignToTeam", array("id" => $data->id))',
                        'options' => array(
                            'class' => 'ui mini circular blue button icon assign',
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
                        'url' => 'Yii::app()->createUrl("//communications/default/invoice", array("id" => $data->id,"service"=>"printing"))',
                        'visible'=> 'TeamMembers::model()->isInvoiceVisible($data->id, "printing")',
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
        $('td.button-column a.assign').on('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#loading').show();
            var tag = ($(e.target).attr('href')) ? $(e.target) : $(e.target).parent();
            $.ajax({
                async: false,
                url: tag.attr('href'),
                success: function (data) {
                    if ($('#view-modal')) {
                        $('#view-modal').html(data);
                        $('#view-modal').modal();
                        $('#view-modal').modal('hide', function () {
                            $('#view-modal').empty()
                        });
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

