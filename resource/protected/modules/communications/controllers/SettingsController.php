<?php

class SettingsController extends Controller {

    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
                //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                //'actions'=>array('index','view'),
                'actions' => array('approve', 'decline', 'confirm', 'alert'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('complete'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'update', 'admin', 'delete'),
                //'users'=>array('admin'),
                'expression' => 'Supervisor::model()->isSupervisor()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
    
    public function actionApprove() {
        $key = Yii::app()->request->getParam('key');
        $email = Yii::app()->request->getParam('email');
        $id = Yii::app()->request->getParam('id');
        $service = Yii::app()->request->getParam('service');
        
        
        $model = User::model()->findByAttributes(array('email' => $email));        
        if ($model === null) {
            throw new CHttpException(503, 'The requested User does not exists in our system.');
        }

        if ($service == "Photography")
            $model = Photography::model()->findByPk($id);
        if ($service == "Design")
            $model = Design::model()->findByPk($id);
        if ($service == "Audiovisual")
            $model = Audiovisual::model()->findByPk($id);
        if ($service == "Printing")
            $model = Printing::model()->findByPk($id);                
        

        if (empty($model->code)) {
            Yii::app()->user->setFlash('error', "Link already used.");
            $this->redirect(array('alert'));
        } else if ($model->code !== $key) {
            throw new CHttpException(503, 'Invalid activation code.');
        } else if ($model->status > 1) {
            throw new CHttpException(503, 'Requisition already approved.');
        } else {
            $model->status = 1;
            $model->code = "";
       
            $model->save();

            // User notification of approval;
            Settings::model()->sendMail($model, $email, null, $service);
            
            $model->status = '1t';
            $teamLeadEmail = TeamMembers::model()->getServiceTeamLeadEmail($service);                
            Settings::model()->sendMail($model, $teamLeadEmail, null, $service);                        
            

            Yii::app()->user->setFlash('success', "Request Successfully Approved.");
            $this->redirect(array('confirm'));
        }
    }

    public function actionDecline() {
        $key = Yii::app()->request->getParam('key');
        $email = Yii::app()->request->getParam('email');
        $id = Yii::app()->request->getParam('id');
        $service = Yii::app()->request->getParam('service');

        $model = User::model()->findByAttributes(array('email' => $email));
        if ($model === null) {
            throw new CHttpException(503, 'The requested User does not exists in our system.');
        }

        if ($service == "Photography")
            $model = Photography::model()->findByPk($id);
        if ($service == "Design")
            $model = Design::model()->findByPk($id);
        if ($service == "Audiovisual")
            $model = Audiovisual::model()->findByPk($id);
        if ($service == "Printing")
            $model = Printing::model()->findByPk($id);

        if (empty($model->code)) {
            Yii::app()->user->setFlash('error', "Link already used.");
            $this->redirect(array('alert'));
        } else if ($model->code !== $key) {
            throw new CHttpException(503, 'Invalid activation code.');
        } else if ($model->status == 2) {
            throw new CHttpException(503, 'Requisition already declined.');
        } else {
            $model->status = 2;
            $model->code = "";
            $model->save();
                        
            Settings::model()->sendMail($model, $email, null, $service);
            
            Yii::app()->user->setFlash('success', "Request Successfully Declined.");
            $this->redirect(array('confirm'));
        }
    }
    
    public function actionComplete(){
        $id = Yii::app()->request->getParam('id');
        $service = Yii::app()->request->getParam('service');
                 //$this->loadModel($id)->delete();
        if ($service == "photography") 
            $model = Photography::model()->findByPk($id);            
        if ($service == "design")
            $model = Design::model()->findByPk($id);
        if ($service == "audiovisual")
            $model = Audiovisual::model()->findByPk($id);
        if ($service == "printing")
            $model = Printing::model()->findByPk($id);
        
        $model->status = '4';
        $model->update();
        
        // teamlead email
        $model->status = '4c';
        $teamLeadEmail = TeamMembers::model()->getServiceTeamLeadEmail($service);
        Settings::model()->sendMail($model, $teamLeadEmail, null, $service);
        
        // requister email
        $requisterEmail = User::model()->findByPk($model->user_id)->email;
                
        Settings::model()->sendMail($model, $requisterEmail, null, $service);

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('//communications/default/tasks'));
    }

    public function actionAlert() {
        $this->layout = "//layouts/confirm";
        $this->render('alert');
    }

    public function actionConfirm() {
        $this->layout = "//layouts/confirm";
        $this->render('confirm');
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Settings;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Settings'])) {
            $model->attributes = $_POST['Settings'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Settings'])) {
            $model->attributes = $_POST['Settings'];
            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Settings');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Settings('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Settings']))
            $model->attributes = $_GET['Settings'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Settings the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Settings::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Settings $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'settings-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
