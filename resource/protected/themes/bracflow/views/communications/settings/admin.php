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
<h3 class="ui dividing header">Settings</h3>
<?php $this->renderPartial('_menu', array('active' => 'user')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'settings-grid',
    'dataProvider' => $model->search(),
    'itemsCssClass' => 'ui basic table segment',
    //'filter' => $model,
    'columns' => array(
        //'id',
        'item',
        'price',
        //'category',
        array(
            'name' => 'category',
            'type' => 'html',
            'value' => 'getCategory($data->category)',
        ),
        'size',
        'color',
        'type',
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

function getCategory($data) {
    if ($data == "photography")
    return '<span class="ui label small blue">' . $data . '</span>';
    if ($data == "audiovisual")
    return '<span class="ui label small green">' . $data . '</span>';
    if ($data == "design")
    return '<span class="ui label small purple">' . $data . '</span>';
    if ($data == "printing")
    return '<span class="ui label small teal">' . $data . '</span>';
}
?>
