<div class="column1-page-wrapper">
    <?php $this->pageTitle = Yii::app()->name . ' Home'; ?>
    <div class="ui page grid">        
        <h2 class="ui header custom">Communication Services</h2>        
    </div>    
    <div class="ui page grid">
        <column>
            <div class="five column doubling ui grid">
                <div class="column">
                    <a href="<?php echo Yii::app()->baseUrl . '/communications/photography/create' ?>" class="ui segment home-block comm" style="display: block">
                        <img style="margin: auto" class="rounded ui image" src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/images/photohraphy.png">
                        <div class="content">
                            <div class="ui teal ribbon label"> Photography Service Request</div>
                        </div>
                    </a>
                </div>
                <div class="column">
                    <a href="<?php echo Yii::app()->baseUrl . '/communications/design/create' ?>" class="ui segment home-block comm" style="display: block">
                        <img style="margin: auto" class="rounded ui image" src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/images/design.png">
                        <div class="content">
                            <div class="ui teal ribbon label">Design Service Request</div>
                        </div>
                    </a>
                </div>
                <div class="column">
                    <a href="<?php echo Yii::app()->baseUrl . '/communications/audiovisual/create' ?>" class="ui segment home-block comm" style="display: block">
                        <img style="margin: auto" class="rounded ui image" src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/images/audiovisual.png">
                        <div class="content">
                            <div class="ui teal ribbon label">Audiovisual Service Request</div>
                        </div>
                    </a>
                </div>
                <div class="column">
                    <a href="<?php echo Yii::app()->baseUrl . '/communications/printing/create' ?>" class="ui segment home-block comm" style="display: block">
                        <img style="margin: auto" class="rounded ui image" src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/images/print.png">
                        <div class="content">
                            <div class="ui teal ribbon label">Print Service Request</div>
                        </div>
                    </a>
                </div>
                
                <?php if(Supervisor::model()->isSpecialSupervisor()) { ?>
                <div class="column" style="opacity: 0">
                    <a href="#" class="ui segment home-block comm" style="display: block">
                        
                        <div class="content">
                            
                        </div>
                    </a>
                </div>
                <div class="column">
                    <a href="<?php echo Yii::app()->baseUrl . '/communications/settings/admin' ?>" class="ui segment home-block comm" style="display: block">
                        <img style="margin: auto" class="rounded ui image" src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/images/settings.png">
                        <div class="content">
                            <div class="ui teal ribbon label">Application Settings</div>
                        </div>
                    </a>
                </div>
                <div class="column">
                    <a href="<?php echo Yii::app()->baseUrl . '/communications/supervisor/admin' ?>" class="ui segment home-block comm" style="display: block">
                        <img style="margin: auto" class="rounded ui image" src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/images/supervisor.png">
                        <div class="content">
                            <div class="ui teal ribbon label">Manage Supervisors</div>
                        </div>
                    </a>
                </div>
                <div class="column">
                    <a href="<?php echo Yii::app()->baseUrl . '/communications/teams/admin' ?>" class="ui segment home-block comm" style="display: block">
                        <img style="margin: auto" class="rounded ui image" src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/images/team.png">
                        <div class="content">
                            <div class="ui teal ribbon label">Manage Teams</div>
                        </div>
                    </a>
                </div>
                <div class="column">
                    <a href="<?php echo Yii::app()->baseUrl . '/communications/teammembers/admin' ?>" class="ui segment home-block comm" style="display: block">
                        <img style="margin: auto" class="rounded ui image" src="<?php echo Yii::app()->theme->baseUrl; ?>/custom/css/images/team-member.png">
                        <div class="content">
                            <div class="ui teal ribbon label">Manage Team Members</div>
                        </div>
                    </a>
                </div>
             
                <?php } ?>
            </div>
        </column>
    </div>
    <br />
</div>
<script type="text/javascript">
    $('.desk-wrapper span.desk').transition('pulse');
    $(function () {
        $('a.home-block').hover(function () {
            $(this).find('.ui.ribbon.label').removeClass('teal');
            $(this).find('.ui.ribbon.label').addClass('red');
            $(this).find('.ui.image').removeClass('rounded');
            $(this).find('.ui.image').addClass('circular');
        }, function () {
            $(this).find('.ui.ribbon.label').removeClass('red');
            $(this).find('.ui.ribbon.label').addClass('teal');
            $(this).find('.ui.image').removeClass('circular');
            $(this).find('.ui.image').addClass('rounded');
        })
    });
</script>