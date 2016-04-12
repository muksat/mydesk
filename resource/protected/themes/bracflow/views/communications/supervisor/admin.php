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
<h3 class="ui dividing header">Supervisors</h3>
<?php $this->renderPartial('//communications/settings/_menu', array('active' => 'user')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'comm-flow-supervisor-grid',
    'itemsCssClass' => 'ui basic table segment',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'columns' => array(
        //'id',
        'pin',
        'name',
        'designation',
        'dept',
        //'status',
        /*
          'special',
         */
        array(
           'class' => 'CButtonColumn',
           'template' => '{update}{delete}',
           'updateButtonLabel' => CHtml::decode("<i title='edit' class='edit icon'></i>"),
           'updateButtonImageUrl' => false,             
           'updateButtonOptions' => array(
               'class'=> 'ui mini circular  green button icon',
           ),
           'deleteButtonLabel' => CHtml::decode("<i title='remove' class='remove icon'></i>"),
           'deleteButtonImageUrl' => false,             
           'deleteButtonOptions' => array(
               'class'=> 'ui mini circular  red button  icon',
           )
        ), 
        
    ),
));
?>
