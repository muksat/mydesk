<?php
class HomeController extends Controller {

    public function filters()
    {
        return array(
            // 'rights',
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'error'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }


	public function actionIndex() {
        $appModules = array();
        $data = Yii::app()->getModules();

        foreach ($data as $k => $v ) {
            $appModule = Yii::app()->getModule($k);

            if ( isset($appModule->appModule) )
                array_push($appModules, $appModule);

        }

		$this->render('index', array('modules' => $appModules));
	}

	public function actionError() {
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}