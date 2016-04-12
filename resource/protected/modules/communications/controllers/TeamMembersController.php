<?php
class TeamMembersController extends Controller {

    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
         //   'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'update', 'admin', 'delete'),
                'expression' => 'Supervisor::model()->isSupervisor()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new TeamMembers;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TeamMembers'])) {
            $model->attributes = $_POST['TeamMembers'];
            $model->user_pin = ltrim($model->user_pin, 0);
            if($model->team_lead == 1) {
                TeamMembers::model()->updateAll(array('team_lead' => 0), 'team_id = '.$model->team_id);
            }
            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
    
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['TeamMembers'])) {
            $model->attributes = $_POST['TeamMembers'];
            $model->user_pin = ltrim($model->user_pin, 0);
            if($model->team_lead == 1) {
                TeamMembers::model()->updateAll(array('team_lead' => 0), 'team_id = '.$model->team_id);
            }
            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('TeamMembers');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new TeamMembers('search');
        $model->unsetAttributes();
        if (isset($_GET['TeamMembers']))
            $model->attributes = $_GET['TeamMembers'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = TeamMembers::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'team-members-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
