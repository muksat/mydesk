<?php $this->layout = '//layouts/login'; ?>
<div class="login-page-wrapper">       
    <div class="stackable ui grid">
        <div class="four wide column">

        </div>
        <div class="eight wide column">
            <div class="login-form-box">
                <div class="ui ignored positive icon message">
                    <i class="info letter icon"></i>
                    <div class="content">
                        <h3 class="ui header">Use PIN and email Password to Login</h3>
                        <p style="font-style: italic; font-size: 11px">If you don't have BRAC email please <a target='_blank' class='ui blue teal small' href='http://sso.brac.net/faces/signup.xhtml?site=mybrac'>Click here to signup</a></p>
                    </div>
                </div>
                <?php if (Yii::app()->user->hasFlash('loginMessage')): ?>
                    <div class="ui message error" style="font-weight: bold; font-size: 12px">
                        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
                    </div>
                <?php endif; ?> 
                <form method="post" action="http://sso.brac.net/auth/isoap/login" class="ui form">
                    <?php echo CHtml::errorSummary($model, '<p class="ui header">Please fix the following input errors.</p>', null, array('class' => 'ui message red', 'style' => 'border:1px solid')); ?>
                    <div class="field">
                        <div class="ui left labeled icon input small">
                            <input class="form-control" type="text" id="user" name="user" placeholder="PIN"/>
                            <i class="user teal icon"></i>

                            <div class="ui corner red label">
                                <i class="icon asterisk"></i>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left labeled icon input small">
                            <input class="form-control" type="password" id="password" name="password" placeholder="PASSWORD"/>
                            <i class="key teal icon"></i>

                            <div class="ui corner red label">
                                <i class="icon asterisk"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row submit">
                        <div class="ui teal small right labeled icon animated button">
                            <i class="right arrow icon"></i>
                            Login
                        </div>
                    </div>
                    <input type="hidden" id="site" name="site" value="<?php echo Yii::app()->params['sso']['appUrl']; ?>"/>
                </form>
            </div>
        </div>
        <div class="four wide column">

        </div>
    </div>


    <script type="text/javascript">
        $('.login-form-box').transition('pulse');
    </script>
</div>