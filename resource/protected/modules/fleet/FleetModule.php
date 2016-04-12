<?php

class FleetModule extends CWebModule
{

    public $appModule = true;

    public $name;

    public $description;

    public $image;

    public $status = array();

    public $vehicleType = array();

    public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'fleet.models.*',
			'fleet.components.*',
		));

        $this->defaultController = 'transport';
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
