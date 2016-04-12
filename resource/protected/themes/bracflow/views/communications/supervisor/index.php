
<style type="text/css">
    #communication-grid table th a{
        font-weight: bold; color: #999; border-bottom: 1px dashed #ccc;
    }
</style>

<?php $this->layout = "//layouts/column2_com";?>

<h3 class="ui header" style="margin-top: 0" id='headerTop'>Supervisor Area</h3>
<?php $this->renderPartial('//communications/settings/_menu', array('active' =>'user'));?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
