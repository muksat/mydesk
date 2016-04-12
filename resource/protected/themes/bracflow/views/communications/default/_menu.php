<style>
@-moz-document url-prefix() { 
  .ui.vertical.menu .item > i.icon {
    float: right;
    margin: 0 0 0 -1.5em;
    width: 1.22em;
}
}
</style>


<?php

/* $this->menuButton = array(
  array('label' => 'New Requisition', 'url' => array('create'), 'visible' => true, 'class' => 'ui green fluid labeled icon button', 'icon' => 'add sign icon'),
  array('label' => 'All Requisitions', 'url' => array('admin'), 'visible' => Supervisor::model()->isSpecialSupervisor()),
  array('label' => 'All Requisitions', 'url' => array('index'), 'visible' => !Supervisor::model()->isSpecialSupervisor()),
  ); */
$this->menu = array(
    array(
        'label' => 'Services',
        'url' => '#',
        'visible' => 'separator',
    ),
    array(
        'label' => 'Services Home', 
        'url' => array('//communications'), 
        'visible' => true,
        'icon' => '<i class="home icon"></i>'
    ),
    array(
        'label' => 'Inbox',
        'active' => (Yii::app()->controller->id == 'default' && Yii::app()->controller->action->id == 'inbox' ? 'active' : false ),
        'url' => array('//communications/default/inbox'),
        'visible' => TeamMembers::model()->isTeamLead(),
        'icon' => '<i class="mail outline icon"></i>'
    ),
    array(
        'label' => 'Tasks',
        'url' => array('//communications/default/tasks'),
        'visible' => TeamMembers::model()->isTeamMember(),
        'active' => (Yii::app()->controller->id == 'default' && Yii::app()->controller->action->id == 'tasks'  ? 'active' : false ),
        'icon' => '<i class="tasks outline icon"></i>'
    ),
    array('label' => 'Photography', 'url' => array('#'),
        'visible' => true,
        'active' => (Yii::app()->controller->id == 'photography' ? 'active' : false ),
        'items' => array(
            array(
                'label' => 'New Requisition',
                'url' => array('//communications/photography/create'),
                'visible' => true,                
            ),
            array(
                'label' => 'Requisition list',
                'url' => array('//communications/photography/index'),
                'visible' => true,
            ),
//            array(
//                'label' => 'Requisition list',
//                'url' => array('//communications/photography/index'),
//                'visible' => true,
//            )
        )
    ),
    array(
        'label' => 'Design',
        'url' => array('#'),
        'visible' => true,
        'active' => (Yii::app()->controller->id == 'design' ? 'active' : false ),
        'items' => array(
            array(
                'label' => 'New Requisition',
                'url' => array('//communications/design/create'),
                'visible' => true,
            ),
            array(
                'label' => 'Requisition list',
                'url' => array('//communications/design/index'),
                'visible' => true,
            ),
//            array(
//                'label' => 'Requisition list',
//                'url' => array('//communications/design/index'),
//                'visible' => true,
//            )
        )
    ),
    array(
        'label' => 'Audiovisual',
        'url' => array('#'),
        'visible' => true,
        'active' => (Yii::app()->controller->id == 'audiovisual' ? 'active' : false ),
        'items' => array(
            array(
                'label' => 'New Requisition',
                'url' => array('//communications/audiovisual/create'),
                'visible' => true,
            ),
            array(
                'label' => 'Requisition list',
                'url' => array('//communications/audiovisual/index'),
                'visible' => true,
            ),
//            array(
//                'label' => 'Requisition list',
//                'url' => array('//communications/audiovisual/index'),
//                'visible' => true,
//            )
        )
    ),
    array(
        'label' => 'Printing',
        'url' => array('#'),
        'visible' => true,
        'active' => (Yii::app()->controller->id == 'printing' ? 'active' : false ),
        'items' => array(
            array(
                'label' => 'New Requisition',
                'url' => array('//communications/printing/create'),
                'visible' => true,
            ),
            array(
                'label' => 'Requisition list',
                'url' => array('//communications/printing/index'),
                'visible' => true,
            ),
//            array(
//                'label' => 'Requisition list',
//                'url' => array('//communications/printing/index'),
//                'visible' => true,
//            )
        )
    ),
    
    array(
        'label' => 'Reports',        
        'url' => '#',
        'visible' => (Supervisor::model()->isSpecialSupervisor() ||  TeamMembers::model()->isTeamMember() ? 'separator' : false)
    ),        
    array(
        'label' => 'Requisitions',
        'icon' => '<i class="user icon"></i>',
        'active' => (Yii::app()->controller->id == 'report' ? 'active' : false ),
        'url' => array('//communications/report/requisition'),
        'visible' => true,        
    ),
    array(
        'label' => 'Billing',
        'icon' => '<i class="user icon"></i>',
        'active' => (Yii::app()->controller->id == 'report' ? 'active' : false ),
        'url' => array('//communications/report/billing'),
        'visible' => true,        
    ),
    array(
        'label' => 'User Feedback',
        'icon' => '<i class="user icon"></i>',
        'active' => (Yii::app()->controller->id == 'report' ? 'active' : false ),
        'url' => array('//communications/report/feedback'),
        'visible' => true,        
    ),
    
    array(
        'label' => 'Settings',
        'url' => '#',
        'visible' => (Supervisor::model()->isSpecialSupervisor() ? 'separator' : false),
   
    ),
    array(
        'label' => 'Supervisors',
        'active' => (Yii::app()->controller->id == 'supervisor' ? 'active' : false ),
        'url' => array('//communications/supervisor/create'),
        'visible' => Supervisor::model()->isSpecialSupervisor(),
         'icon' => '<i class="user icon"></i>',
        ),
 
    
    
    array('label' => 'Preferences', 
        'url' => array('//communications/settings/create'),
        'visible' => Supervisor::model()->isSpecialSupervisor(),
        'icon' => '<i class="settings icon"></i>',
        ),
   
    array('label' => 'Team', 
        'url' => array('//communications/teams/create'),
        'visible' => Supervisor::model()->isSpecialSupervisor(),
        'icon' => '<i class="users icon"></i>',
        ),
    
    
    array('label' => 'Team Members', 
        'url' => array('//communications/teamMembers/create'),
        'visible' => Supervisor::model()->isSpecialSupervisor(),
        'icon' => '<i class="user icon"></i>',
        
        ),
);
?>
