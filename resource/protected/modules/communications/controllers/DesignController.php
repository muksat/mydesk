<?php

class DesignController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
                // 'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
//            array('allow', // allow all users to perform 'index' and 'view' actions
//                'actions' => array('index', 'view', 'admin', 'updatesize', 'calculatecost'),
//                'users' => array('*'),
//            ),

            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'delete', 'view', 'index', 'assignToTeam', 'updatesize', 'calculatecost'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
                //'users' => array('admin'),
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Design;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Design'])) {
            $model->attributes = $_POST['Design'];
            $model->user_id = Yii::app()->user->id;
            $model->item_id = Settings::model()->find(array('select' => 'id', 'condition' => 'item=:item and category=:cat and size=:size and color=:color', 'params' => array(':item' => $model->item_id, ':cat' => 'design', ':size' => $model->size, ':color' => $model->color)))->id;
            $model->created_by = Yii::app()->user->id;
            $model->created_time = date("Y-m-d h:m:s");
            $model->bill_dept = $this->bracUser['Project'];
            $model->status = Settings::model()->getStatusCode("Requested");
            $model->code = sha1(mt_rand(10000, 99999) . time() . $this->bracUser['Email'] . $this->bracUser['PIN']);

            if ($model->validate()) {
                if (!$model->save())
                   // print_r($model->getErrors());

                $supervisorPin = Supervisor::model()->findByPk($model->supervisor_id)->pin;
                $sentEmailToDepartmentSupervisor = User::model()->find('username=:pin', array(':pin' => $supervisorPin))->email;
                $requester = $this->bracUser;

                if (Settings::model()->sendMail($model, $sentEmailToDepartmentSupervisor, $requester, "Design")) {
                    $this->redirect(array('index', 'id' => $model->id));
                }
            }
        }

        $package = Settings::model()->findAll(array('select' => 'item', 'condition' => 'category=:cat', 'distinct' => 'true', 'params' => array(':cat' => 'design')));
        $color = Settings::model()->findAll(array('select' => 'color', 'condition' => 'category=:cat', 'distinct' => 'true', 'params' => array(':cat' => 'design')));

        $this->render('create', array(
            'model' => $model,
            'packagelist' => $package,
            'colorlist' => $color,
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

        if (isset($_POST['Design'])) {
            $model->attributes = $_POST['Design'];

            if ($model->user_id != null) {
                $model->user_id = Yii::app()->user->id;
            }
            $model->item_id = Settings::model()->find(array('select' => 'id', 'condition' => 'item=:item and category=:cat and size=:size and color=:color', 'params' => array(':item' => $model->item_id, ':cat' => 'design', ':size' => $model->size, ':color' => $model->color)))->id;

            if ($model->save()) {
//                if (Supervisor::model()->isSupervisor())
//                    $this->redirect(array('admin', 'id' => $model->id));
//                else
                $this->redirect(array('index', 'id' => $model->id));
            }
        }
        $package = Settings::model()->findAll(array('select' => 'item', 'condition' => 'category=:cat', 'distinct' => 'true', 'params' => array(':cat' => 'design')));
        $color = Settings::model()->findAll(array('select' => 'color', 'condition' => 'category=:cat', 'distinct' => 'true', 'params' => array(':cat' => 'design')));

        $this->render('update', array(
            'model' => $model,
            'packagelist' => $package,
            'colorlist' => $color,
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
        $dataProvider = new CActiveDataProvider('Design', array(
            'criteria' => array(
                'condition' => 'user_id=' . Yii::app()->user->id,
                'order' => 'id DESC',
        )));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Design('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Design']))
            $model->attributes = $_GET['Design'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionassignToTeam($id) {
        $model = Design::model()->findByPk($id);
        if (isset($_POST['Design'])) {
            $model->attributes = $_POST['Design'];
            $model->team_members = implode(",", $model->team_members);
            $model->status = 3;
            $model->save();

            $memberPINs = explode(',', $model->team_members);

            foreach ($memberPINs as $member) {
                $memberEmail = User::model()->find(array('condition' => 'username=:u', 'params' => array(':u' => $member)))->email;
                Settings::model()->sendMail($model, $memberEmail, null, "Design");
            }
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            Yii::app()->end();
//               $this->redirect(array('admin', 'id' => $model->id));
        }
        $this->render('assign', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Design the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Design::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Design $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'design-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /* update  size after selecting item */

    public function actionUpdatesize() {

        $changesize = $_REQUEST['Design']['item_id'];

        $size = Settings::model()->findAll(array('condition' => "item='$changesize'", 'select' => 'size', 'distinct' => 'true'));
        if (!empty($size)) {
            echo '<option value="">-Select Size-</option>';
        }

        foreach ($size as $value => $name) {
            echo CHtml::tag('option', array('value' => $name->size), CHtml::encode($name->size), true);
        }
    }

    /* update  size after selecting color */

    public function actionCalculatecost() {
        $changeitem = $_REQUEST['item_id'];
        $changesize = $_REQUEST['size'];
        $changecolor = $_REQUEST['color'];
        echo Settings::model()->find(array('select' => 'price', 'condition' => "category='design' AND item='$changeitem' AND size='$changesize' AND color='$changecolor'"))->price;
    }

}
