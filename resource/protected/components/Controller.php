<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    public $layout = '//layouts/column1';
    public $menu = array();
    public $menuButton = array();
    public $breadcrumbs = array();
    public $bracUser;

    public function init() {
        parent::init();
        if (!Yii::app()->user->isGuest) {
            $hrd = new HrdService();
            $hrdUser = $hrd->getHrUser(User::model()->findByPk(Yii::app()->user->id)->username);
            $this->bracUser = $hrdUser[0];
        }
    }

}
