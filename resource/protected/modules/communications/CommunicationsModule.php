<?php

class CommunicationsModule extends CWebModule
{

    public $appModule = true;

    public $name;

    public $description;

    public $image;

    public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'communications.models.*',
			'communications.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			return true;
		}
		else
			return false;
	}
}
