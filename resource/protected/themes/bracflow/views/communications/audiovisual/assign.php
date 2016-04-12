<?php
$this->layout = "//layout/main";
?>
<i class="top-close-button close red icon" style="top: 1em; right: 1em"></i>
<div class="ui dividing header" style="padding: 1rem">
    Assign Requisition to Team
</div>

<div class="content" style="background: #eee; padding: 0.5em">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'team-assign-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'ui form')
    ));
    ?>

    <div class="ui fluid form segment" style="background: rgba(0, 0, 0 , 0.1); margin-top: 0">                   


        <div style="display: block; border: 1px solid; margin-top: 0px;" class="ui info message">
            <ul>
                <li>
                    <label class="ui label">Package: </label> 
                    <?php echo Settings::model()->findByPk($model->item_id)->item; ?> 
                    <label class="ui label">duration: </label> 
                    <?php echo $model->duration; ?> 
                </li>
                <li>
                    <label class="ui label">Estimated Total: </label>
                    BDT <?php echo $model->est_total; ?>
                    <label class="ui label">Brief: </label> 
                    <?php echo $model->brief; ?>
                </li>                
            </ul>
        </div> 

        <div class="field">
            <?php echo $form->labelEx($model, 'team_id'); ?>
            <?php echo $form->hiddenField($model, 'id'); ?>
            <?php echo $form->dropDownList($model, 'team_id', CHtml::listData(Teams::model()->findAll(), 'id', 'name'), array('type' => 'text', 'class' => 'ui mini selection dropdown', 'placeholder' => 'Select')); ?>
            <?php echo $form->error($model, 'team_id'); ?>
        </div>   

        <div class="field">
            <?php echo $form->labelEx($model, 'team_members'); ?>
            <?php echo $form->hiddenField($model, 'id'); ?>
            <?php echo $form->dropDownList($model, 'team_members', null, array('size' => '3', 'multiple' => 'true', 'type' => 'text', 'class' => 'ui mini selection dropdown', 'placeholder' => 'Select')); ?>
            <?php echo $form->error($model, 'team_members'); ?>
        </div>        
        <div class="field">
            <?php echo $form->labelEx($model, 'teamlead_remarks'); ?>
            <div class="ui mini input">   
                <?php echo $form->textField($model, 'teamlead_remarks'); ?>

            </div>
            <?php echo $form->error($model, 'teamlead_remarks'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<div class="actions" style="padding: 0.5rem">
    <div id="save-assign" class="ui right small submit teal labeled icon button">
        <i class="right arrow icon"></i>
        Save
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#Audiovisual_team_id').on('change', function (e) {
            $.ajax({
                url: "/mydesk/communications/teams/members?team_id=" + $('#Audiovisual_team_id').val(),
                type: "GET",
                success: function (data) {
                    console.log(data);
                    $('#Audiovisual_team_members').html(data);
                },
            });
            return false;
        });
        $('#save-assign').on('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({
                url: "/mydesk/communications/audiovisual/assignToTeam?id=" + $('#Audiovisual_id').val(),
                type: "POST",
                data: $('#team-assign-form').serializeArray(),
                success: function (data) {
                    $('.view.ui.modal').modal('hide');
                    //jQuery('#communication-grid').yiiGridView('update');
                }
            });
            return false;
        })
    });
</script>