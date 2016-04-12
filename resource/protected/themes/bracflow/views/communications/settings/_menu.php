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
    
    
    array(
        'label' => 'Photography',
        'active' => (Yii::app()->controller->id == 'photography' ? 'active' : false ),
        'url' => array('#'),
        'visible' => true,
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
            )
        )
    ),
    array(
        'label' => 'Design',
        'active' => (Yii::app()->controller->id == 'design' ? 'active' : false ),
        'url' => array('#'),
        'visible' => true,
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
            )
        )
    ),
    array(
        'label' => 'Audiovisual',
        'active' => (Yii::app()->controller->id == 'audiovisual' ? 'active' : false ),
        'url' => array('#'),
        'visible' => true,
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
            )
        )
    ),
    array(
        'label' => 'Printing',
        'active' => (Yii::app()->controller->id == 'printing' ? 'active' : false ),
        'url' => array('#'),
        'visible' => true,
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
            )
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
        'visible' => (Supervisor::model()->isSpecialSupervisor() ? 'separator' : false)
    ),        
    array(
        'label' => 'Supervisors',
        'icon' => '<i class="user icon"></i>',
        'active' => (Yii::app()->controller->id == 'supervisor' ? 'active' : false ),
        'url' => array('#'),
        'visible' => Supervisor::model()->isSpecialSupervisor(),        
        'items' => array(
            array(
                'label' => 'New Supervisor',
                'url' => array('//communications/supervisor/create'),
                'visible' => true,
            ),
            array(
                'label' => 'Supervisor list',
                'url' => array('//communications/supervisor/admin'),
                'visible' => true,
            ),
        )
    ),        
    array(
        'label' => 'Preferences',
         'icon' => '<i class="settings icon"></i>',
        'active' => (Yii::app()->controller->id == 'settings' ? 'active' : false ),
        'url' => array('#'),
        'visible' => Supervisor::model()->isSpecialSupervisor(),
        'items' => array(
            array(
                'label' => 'New Preference',
                'url' => array('//communications/settings/create'),
                'visible' => true,
            ),
            array(
                'label' => 'Preference list',
                'url' => array('//communications/settings/admin'),
                'visible' => true,
            ),
        )
    ),
    
    
    
    array(
        'label' => 'Team',
         'icon' => '<i class="users icon"></i>',
        'active' => (Yii::app()->controller->id == 'teams' ? 'active' : false ),
        'url' => array('#'),
        'visible' => Supervisor::model()->isSpecialSupervisor(),        
        'items' => array(
            array(
                'label' => 'New Team',
                'url' => array('//communications/teams/create'),
                'visible' => true,
            ),
            array(
                'label' => 'Teams list',
                'url' => array('//communications/teams/admin'),
                'visible' => true,
            ),
        )
    ),
    
    
    
    array(
        'label' => 'Team Members',
         'icon' => '<i class="user icon"></i>',
        'active' => (Yii::app()->controller->id == 'teammembers' ? 'active' : false ),
        'url' => array('#'),
        'visible' => Supervisor::model()->isSpecialSupervisor(),        
        'items' => array(
            array(
                'label' => 'New Team Member',
                'url' => array('//communications/teamMembers/create'),
                'visible' => true,
            ),
            array(
                'label' => 'Team Members list',
                'url' => array('//communications/teamMembers/admin'),
                'visible' => true,
            ),
        )
    ),
);
?>
