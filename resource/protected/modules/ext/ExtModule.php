<?php

class ExtModule extends CWebModule {

    public $appModule = true;
    public $name;
    public $description;
    public $image;
    public $status = array();
    public $vehicleType = array();

    public function init() {
        $this->setImport(array(
            'ext.models.*',
            'ext.components.*',
        ));

        $this->defaultController = 'default';
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            return true;
        } else
            return false;
    }
}
