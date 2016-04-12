<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("SSO Login");
?>

<h1><?php echo UserModule::t("SSO Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<div class="form">

<form id="login-form" method="post" action="http://sso.brac.net/auth/isoap/login">

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'user'); ?>
		<?php //echo CHtml::activeTextField($model,'user') ?>
		<input class="required" type="text" id="user" name="user"/>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php //echo CHtml::activePasswordField($model,'password') ?>
		<input class="required password" type="password" id="password" name="password"/>
	</div>

	<div class="row">
		<p class="hint">
		<?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Login")); ?>
	</div>
	<input type="hidden" id="site" name="site" value="<?php echo Yii::app()->params['sso']['site']; ?>" />
</form>
</div>
