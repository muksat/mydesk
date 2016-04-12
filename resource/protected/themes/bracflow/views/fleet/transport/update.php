<?php
$this->renderPartial('_menu', array('active' =>'form'));

$this->renderPartial('_formU',
    array(
        'model'=>$transport
//        'model1'=>$model1,
//        'travel_type'=>$travel_type,
//        'outside_dhaka'=>$outside_dhaka,
//        'vehicle_type'=>$vehicle_type
    )
);
?>