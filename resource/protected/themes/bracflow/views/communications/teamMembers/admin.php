<style type="text/css">
    #transport-grid table th a{
        font-weight: bold; color: #999; border-bottom: 1px dashed #ccc;
    }
    .ui.message.warning {
        border: 1px dashed;
    }
</style>
<?php
$this->layout = "//layouts/column2_com";
?>
<h3 class="ui dividing header">Team Members</h3>
<?php $this->renderPartial('//communications/settings/_menu', array('active' => 'user')); ?>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'team-members-grid',
    'dataProvider' => $model->search(),
    'itemsCssClass' => 'ui basic table segment',
    //'filter' => $model,
    'columns' => array(
        //'id',
        // 'team_id',
        array(
            'name' => 'team_id',
            'type' => 'html',
            'value' => 'getTeamName($data->team_id)',
        ),        
        //'user_id',
        array(
            'name' => 'user_pin',
            'type' => 'raw',
        ),
        array(
            'name' => 'user_name',
            'type' => 'raw',
        ),
        array(
            'name' => 'team_lead',
            'type' => 'html',
            'value' => 'getTeamLead($data->team_lead)',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'updateButtonLabel' => CHtml::decode("<i title='edit' class='edit icon'></i>"),
            'updateButtonImageUrl' => false,
            'updateButtonOptions' => array(
            'class' => 'ui mini circular  green button icon',
            ),
            'deleteButtonLabel' => CHtml::decode("<i title='remove' class='remove icon'></i>"),
            'deleteButtonImageUrl' => false,
            'deleteButtonOptions' => array(
                'class' => 'ui mini circular  red button  icon',
            )
        ),
    ),
));
function getTeamName($teamId) {    
    $teamName =  Teams::model()->findByPk($teamId)->name;
    return $teamName;
}
function getTeamLead($check) {
    if($check == 1) 
        return '<i class="check circle outline icon"></i>';
    else 
        return '';
}
?>
