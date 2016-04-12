<?php $this->beginContent('//layouts/main'); ?>
    <div class="ui page two stackable column grid middle aligned">
        <div class="middle aligned row" style="border-bottom: 1px solid #eee">
            <div class="column">
                <div class="vertical fluid">
                    <div class="header item brac-logo">
                        BRAC
                    </div>
                </div>
            </div>
            <div class="column" style="padding-right: 0">
                <div class="vertical fluid" style="text-align: right">
                    <div class="ui secondary  menu" style="display: inline-block; margin: 0; padding: 3px 12px; list-style: none outside none; background-color: #FFF;border-radius: 0px;box-shadow: 0px 1px 2px #ccc;font-size: 0.85em;text-transform: uppercase;font-weight: 600; border-bottom: 1px solid #ff007b">
                       <div class="header item" style="text-transform: uppercase;border-right: none;font-weight: bold;font-size: 13px;color: #888; text-shadow: 1px 1px 1px #fff;"><?php echo strtolower($this->bracUser['Fname'])." ".strtolower($this->bracUser['Mname'])." ".strtolower($this->bracUser['Lname']); ?> | <?php echo $this->bracUser['PIN']; ?>, <?php echo $this->bracUser['Project']; ?></div>
                    </div>
                    <div class="ui secondary  menu" style="display: inline-block; margin: 0">
                        <a class="item  " href="<?php echo Yii::app()->baseUrl; ?>/">
                            <i class="home teal icon"></i> Home</a>
                        <a class="item " href="<?php echo Yii::app()->createUrl("//user/profile"); ?>">
                            <i class="user teal icon"></i> Profile
                        </a>
                        <a class="item " href="<?php echo Yii::app()->params['sso']['ssoLogoutUrl'].'?site='.Yii::app()->params['sso']['appUrl'] ?>">
                            <i class="sign teal out icon"></i> logout
                        </a>
                    </div>
                    <div class="ui header item mydesk-logo">
                        <h2 style="margin-bottom: -18px;"><span class="desk-wrapper"><span class="desk a">my</span><span class="desk b">Desk</span></span></h2>
                    </div>
                </div>
            </div>
            <!--<div class="column" style="text-align: right; padding-bottom: 2em; padding-right: 0">
                <div class="ui blue  inverted menu" style="display: inline-block">
                    <a class="item active " href="<?php /*echo Yii::app()->createUrl("//"); */?>">
                        <i class="home icon"></i> Home</a>
                    <a class="item" href="<?php /*echo Yii::app()->createUrl("//user/profile"); */?>">
                        <i class="user icon"></i> Profile
                    </a>
                    <a class="item" href="<?php /*echo Yii::app()->createUrl("//user/logout"); */?>">
                        <i class="sign out icon"></i> logout
                    </a>
                </div>
            </div>-->
        </div>
    </div>
    </div>
<?php echo $content; ?>
<?php $this->endContent(); ?>