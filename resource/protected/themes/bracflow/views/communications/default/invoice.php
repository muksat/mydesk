<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jq-datetime-picker/dist/smoothness/jquery-ui-1.10.4.custom.min.css">
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/javascript/jQuery.print.js"></script>

<?php $this->layout = "//layouts/column2_com"; ?>

<?php $this->renderPartial('//communications/default/_menu', array('active' => 'user')); ?>

<script type='text/javascript'>

            $(function() {
            $("#printable").find('.print-link').on('click', function() {
            //Print printable with default options
            $.print("#printable");
                    globalStyles : false,
                    //Add link with attrbute media=print
                    mediaPrint : false,
                    //Custom stylesheet
                    stylesheet : "<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/main.css">",
            });
            });        </script>


<div class="ui fluid form segment print-link" id="printable" style="background:white; margin-top: 0">  
    <div class="brac-logo-report" style="margin:20px 0px 15px 20px;">BRAC</div>
    <h3 class="ui  dividing  header" style="margin-top: 0; text-align: center;" id='headerTop'>Invoice</h3>

    <div style="height: 100px;"> 
        <div style="float: left"> 
            <table  class="ui table">
                <tr>
                    <td>To</td>
                </tr>
                <tr>
                    <td>Accounts Department</td>
                </tr>
                <tr>
                    <td>BRAC</td>
                </tr>
            </table>
        </div>

        <div style="float: right">  
            <table  class="ui table">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Date:<?php echo date('Y-m-d H:i:s') ?></td>
                </tr>

            </table>
        </div>
    </div>

    <?php $service = Yii::app()->request->getParam('service'); ?>
    <?php if ($service == "photography") { ?>        
        <div style="background: white;" class="ui message">                
            <table class="ui table">
                <thead>
                    <tr>
                        <th>Service Type</th>
                        <th>Package</th>
                        <th>Days</th>
                        <th>Location</th>
                        <th>Brief</th>
                        <th>Total Cost</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> <?php echo $service ?></td>
                        <td> <?php echo Settings::model()->findByPk($model->item)->item; ?> </td>
                        <td><?php echo $model->days ?> ( <?php echo $model->fromdate ?> to <?php echo $model->todate ?> )</td>
                        <td> <?php echo $model->location; ?></td>
                        <td> <?php echo $model->brief; ?> </td>
                        <td>BDT <?php echo $model->est_total; ?></td>

                    </tr>
                    <tr>
                        <td colspan="5" align="right"  ><strong>Total Amount</strong></td>
                        <td>BDT <?php echo $model->est_total; ?></td>

                    </tr>
                </tbody>
            </table>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <a class="print-link no-print" onclick="jQuery('#printable').print()" style="cursor:pointer; ">
                Print This Report
            </a>
        </div>

    <?php } ?>  




    <?php if ($service == "design") { ?> 


        <div style="background: white;" class="ui message">                
            <table class="ui table">
                <thead>
                    <tr>
                        <th>Service Type</th>
                        <th>Package</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Brief</th>
                        <th>Total Cost</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> <?php echo $service ?></td>
                        <td> <?php echo Settings::model()->findByPk($model->item_id)->item; ?> </td>
                        <td> <?php echo $model->size; ?></td>
                        <td>  <?php echo $model->color; ?> </td>
                        <td><?php echo $model->qty; ?> </td>
                        <td><?php echo $model->brief; ?> </td>
                        <td>BDT <?php echo $model->est_total; ?></td>

                    </tr>
                    <tr>
                        <td colspan="6" align="right"  ><strong>Total Amount</strong></td>
                        <td>BDT <?php echo $model->est_total; ?></td>

                    </tr>
                </tbody>
            </table>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>  
            <a class="print-link no-print" onclick="jQuery('#printable').print()" style="cursor:pointer; ">
                Print This Report
            </a>
        </div>
    <?php } ?>  


    <?php if ($service == "audiovisual") { ?>  
        <div style="background: white;" class="ui  message">   
            <table class="ui table">
                <thead>
                    <tr>
                        <th>Service Type</th>
                        <th>Package</th>
                        <th>Duration</th>
                        <th>Brief</th>                         
                        <th>Total Cost</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> <?php echo $service ?></td>
                        <td>  <?php echo Settings::model()->findByPk($model->item_id)->item; ?>  </td>
                        <td>  <?php echo $model->duration; ?>  </td>                        
                        <td><?php echo $model->brief; ?> </td>
                        <td>BDT <?php echo $model->est_total; ?></td>

                    </tr>
                    <tr>
                        <td colspan="4" align="right"  ><strong>Total Amount</strong></td>
                        <td>BDT <?php echo $model->est_total; ?></td>

                    </tr>
                </tbody>
            </table>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <a class="print-link no-print" onclick="jQuery('#printable').print()" style="cursor:pointer; ">
                Print This Report
            </a>
        </div>
    <?php } ?>



    <?php if ($service == "printing") { ?>        
        <div style="background: white;" class="ui  message">      
            <table class="ui table">
                <thead>
                    <tr>
                        <th>Service Type</th>
                        <th>Package</th>
                        <th>Print Type:</th>
                        <th>Brief</th>                         
                        <th>Total Cost</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> <?php echo $service ?></td>
                        <td><?php echo $model->item_id; ?>   </td>
                        <td><?php echo Settings::model()->findByPk($model->design_id)->type ?>  </td>                        
                        <td><?php echo $model->brief; ?> </td>
                        <td>BDT <?php echo $model->est_total; ?></td>

                    </tr>
                    <tr>
                        <td colspan="4" align="right"  ><strong>Total Amount</strong></td>
                        <td>BDT <?php echo $model->est_total; ?></td>

                    </tr>
                </tbody>
            </table>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <a class="print-link no-print" onclick="jQuery('#printable').print()" style="cursor:pointer; ">
                Print This Report
            </a>

        </div>
    <?php } ?> 


</div>


