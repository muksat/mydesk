

<?php $this->layout = "//layouts/column2_com"; ?>

<h3 class="ui  dividing  header" style="margin-top: 0" id='headerTop'>Service Requests Feedback</h3>
<div id="view-modal" class="view ui modal " style="background: #eee">Loading...</div>
<?php $this->renderPartial('_menu', array('active' => 'user')); ?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'feedack-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'ui form')
        ));
?>

<div class="ui fluid form segment" style="background: rgba(0, 0, 0 , 0.1); margin-top: 0"> 


    <?php $service = Yii::app()->request->getParam('service'); ?>

    <?php if ($service == "photography") { ?>        
        <div style="background: white;" class="ui message">    
            <ul style="list-style: none;">
                <li>
                    <label class="ui label">Service Type: </label> 
                    <?php echo $service ?> 
                    <label class="ui label">Package: </label> 
                    <?php echo Settings::model()->findByPk($model->item)->item; ?> 
                    <label class="ui label">Days: </label>
                    <?php echo $model->days ?> ( <?php echo $model->fromdate ?> to <?php echo $model->todate ?> )<br/><br/>
                    <label class="ui label">Location: </label> 
                    <?php echo $model->location; ?>                
                    <label class="ui label">Estimated Total: </label> 
                    BDT <?php echo $model->est_total; ?><br/><br/>
                    <label class="ui label">Brief: </label> 
                    <?php echo $model->brief; ?>
                </li> 
            </ul>
        </div>

    <?php } ?>  




    <?php if ($service == "design") { ?> 
        <div style="background: white;" class="ui  message">    
            <ul style="list-style: none;">
                <li>
                    <label class="ui label">Service Type: </label> 
                    <?php echo $service ?> 
                    <label class="ui label">Package: </label> 
                    <?php echo Settings::model()->findByPk($model->item_id)->item; ?> 
                    <label class="ui label">size: </label> 
                    <?php echo $model->size; ?>
                    <label class="ui label">color: </label> 
                    <?php echo $model->color; ?> 
                    <label class="ui label">qty: </label> 
                    <?php echo $model->qty; ?><br><br/>
                    <label class="ui label">Estimated Total: </label>
                    BDT <?php echo $model->est_total; ?><br/><br/>
                    <label class="ui label">Brief: </label> 
                    <?php echo $model->brief; ?>            

                </li>                
            </ul>
        </div>
    <?php } ?>  


    <?php if ($service == "audiovisual") { ?>  
        <div style="background: white;" class="ui  message">   
            <ul style="list-style: none;">                  
                <li>                    
                    <label class="ui label">Service Type: </label> 
                    <?php echo $service ?> 
                    <label class="ui label">Package: </label> 
                    <?php echo Settings::model()->findByPk($model->item_id)->item; ?> 
                    <label class="ui label">duration: </label> 
                    <?php echo $model->duration; ?>             
                    <label class="ui label">Estimated Total: </label>
                    BDT <?php echo $model->est_total; ?><br/><br/>
                    <label class="ui label">Brief: </label> 
                    <?php echo $model->brief; ?>
                </li>                                   
            </ul>
        </div>
    <?php } ?>



    <?php if ($service == "printing") { ?>        
        <div style="background: white;" class="ui  message">      
            <ul style="list-style: none;">
                <li>
                    <label class="ui label">Service Type: </label> 
                    <?php echo $service ?> 
                    <label class="ui label">Package: </label> 
                    <?php echo $model->item_id; ?> 
                    <label class="ui label">Print Type:</label> 
                    <label class="ui label">Estimated Total: </label>
                    BDT <?php echo $model->est_total; ?>
                    <?php echo Settings::model()->findByPk($model->design_id)->type ?> <br/><br/> 
                    <label class="ui label">Brief: </label> 
                    <?php echo $model->brief; ?>  <br/><br/>              

                </li>                         
            </ul>
        </div>
    <?php } ?> 


    <div class="ui grid com-form">   
        <div class="five wide column">
            <div class="field">
                <?php echo $form->labelEx($model, 'feedback_procecss'); ?>
                <div class="ui mini input">   
                    <?php
//                    echo $form->dropDownList($model, 'feedback_procecss', array(
//                        '1' => 'One',
//                        '2' => 'Two',
//                        '3' => 'Three',
//                        '4' => 'Four',
//                        '5' => 'Five',), array('class' => 'ui mini selection dropdown', 'placeholder' => 'Select', 'empty' => 'Give a Rating(One to Five)'));
                     $this->widget('ext.dzraty.dzraty', array(
                        'model' => $model,
                        'attribute' => 'feedback_procecss',
                    ));
                    ?>             
                </div>
                <?php echo $form->error($model, 'feedback_procecss'); ?>
            </div>            
        </div>
        <div class="five wide column">
            <div class="field">
                <?php echo $form->labelEx($model, 'feedback_time'); ?>
                <div class="ui mini input">   
                    <?php
//                    echo $form->dropDownList($model, 'feedback_time', array(
//                        '1' => 'One',
//                        '2' => 'Two',
//                        '3' => 'Three',
//                        '4' => 'Four',
//                        '5' => 'Five',), array('class' => 'ui mini selection dropdown', 'placeholder' => 'Select', 'empty' => 'Give a Rating(One to Five)'));
                    $this->widget('ext.dzraty.dzraty', array(
                        'model' => $model,
                        'attribute' => 'feedback_time',
                    ));
                    ?>             
                </div>
                <?php echo $form->error($model, 'feedback_time'); ?>
            </div>            
        </div> 
        <div class="five wide column">
            <div class="field">
                <?php echo $form->labelEx($model, 'feedback_quality'); ?>
                <div class="ui mini input">   
                    <?php
//                    echo $form->dropDownList($model, 'feedback_quality', array(
//                        '1' => 'One',
//                        '2' => 'Two',
//                        '3' => 'Three',
//                        '4' => 'Four',
//                        '5' => 'Five',), array('class' => 'ui mini selection dropdown', 'placeholder' => 'Select', 'empty' => 'Give a Rating(One to Five)'));
                    $this->widget('ext.dzraty.dzraty', array(
                        'model' => $model,
                        'attribute' => 'feedback_quality',
                    ));
                    ?>

                </div>
                <?php echo $form->error($model, 'feedback_quality'); ?>
            </div>            
        </div>

    </div>

</div> 

<div class="four wide column middle column row">
    <div class="row buttons" style="text-align: right;">
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Submit',  array('class'=>'ui right small submit teal labeled icon button'));      ?>
        <div class="ui right small submit teal labeled icon button">
            <i class="right arrow icon"></i>
            Send
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

