<?php $this->layout = '//layouts/login'; ?>
<div class="login-page-wrapper">       
    <div class="stackable ui grid">
        <div class="four wide column">

        </div>
        <div class="eight wide column">
            <div class="login-form-box">
                <div class="ui ribbon label" style="display: block; margin-bottom: 10px">
                    <i class="info circle icon"></i> Use BRAC PIN and BRAC Email Password to Login.  <a target='_blank' href="http://sso.brac.net/faces/signup.xhtml?site=mybrac" class="right aligned" style="color: #06c" ><i class="right arrow icon"></i>&nbsp; Signup</a>
                </div>
                <div id="loginMessage" class="ui message error" style="font-weight: bold; font-size: 11px; display: none; box-shadow: 0px 0px 2px #a95252">
                    <?php //echo Yii::app()->user->getFlash('loginMessage'); ?>
                </div>
                <form id="loginForm" method="post" action="http://sso.brac.net/auth/isoap/login" class="ui form">
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
        $('#loginForm').submit(function () {
            if ($('#user').val() == "" && $('#password').val() == "") {
                $('#loginMessage').text('Username & Password cannot be blank').show('normal');
                return false;
            } else if ($('#user').val() == "") {
                $('#loginMessage').text('Username cannot be blank').show('normal');
                return false;
            } else if ($('#password').val() == "") {
                $('#loginMessage').text('Password cannot be blank').show('normal');
                return false;
            } else {
                return true;
            }
        });
        $('.login-form-box').transition('pulse');
    </script>
</div>