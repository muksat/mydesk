<?php
$this->layout = "//layouts/public";

$this->renderPartial('_userreview',
    array(
        'model'=>$model,
        //'model1'=>$model1,
        'travel_type'=>$travel_type,
        'outside_dhaka'=>$outside_dhaka,
        'vehicle_type'=>$vehicle_type
    )
);
?>