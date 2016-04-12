<?php
$supervisor = TransportFlowSupervisor::model()->find(array('condition' => 'pin=:pin', 'params' => array(':pin' => Yii::app()->user->name)));
$supervisorCount = false;
$reqCount = false;

if ($supervisor) {
    $supervisor_id = $supervisor->id;
    if($supervisor_id) {
        $supervisorCount = Transport::model()->Count(array('condition' => 'transport_flow_supervisor_id=:id and status=:status', 'params' => array(':id' => $supervisor_id, ':status'=>'2')));
    }
}
//$reqCount =  Transport::model()->find(array('condition' => 'pin=:pin and status=:status', 'params' => array('status'=>'2',':pin' => Yii::app()->user->name)));
$this->menu=array(
    array('itemOptions' => array( 'teal'=> ($supervisorCount) ? $supervisorCount : false ), 'label'=>'Supervisor Inbox', 'url'=>array('//fleet/transport/supervisor'), 'visible'=> TransportFlowSupervisor::model()->isSupervisor(), 'active'=> $active =='supervisor' ? 'active': '' ),
    array( 'label'=>'Requisitions', 'url'=>array('//fleet/transport/user'), 'visible'=> true, 'active'=> $active =='user' ? 'active': ''),
);
?>