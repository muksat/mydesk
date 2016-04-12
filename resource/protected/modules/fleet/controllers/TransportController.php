<?php

class TransportController extends Controller
{
    public $layout = '//layouts/column2';

    public $defaultAction = 'index';

    public $travel_type = Array(
        '0' => 'Official',
        '1' => 'Personal',
    );

    public $outside_dhaka = Array(
        '0' => 'No',
        '1' => 'Yes',
    );

    public $status = array();
    public $vehicleType = array();

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            // 'rights',
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
           array('allow',
                'actions' => array('approve', 'decline','confirm', 'alert' ,'review','UserReview','ManualIfleet'),
                'users' => array('*'),
            ),
            /*array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index'),
                'users' => array('@'),
            ),*/
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('user', 'delete', 'updateAjax1', 'updateAjax2','supervisor','index', 'create', 'view'),
                //'users'=>array('admin'),
                'users' => array('@'),
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
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionGetRequesterInfo($pin) {
        $hrData = new HrdService;
        $data = $hrData->getHrUser($pin);
        //CVarDumper::dump($data, 10, true);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Transport;        
        $model->travel_type = 0; // 0 => official, 1=> personal
        $model->travel_in_out = 0; // 0 => no, 1=>yes
        $model->start_date = date("Y-m-d h:m:s");
       // $model->start_point="BRAC Head Office";
       // $model->travel_reason = "Official";
        $hrdata = new HrdService;
        $model1 = $hrdata->getHrUser(Yii::app()->user->name); // sending PIN to HR
        $model->bill_dept = $this->bracUser['Project'];
        $vehicle_type = Yii::app()->getModule('fleet')->vehicleType;

/*      echo "<pre style='display: none'>";
        CVarDumper::dump($_POST,'10',true);
        echo "</pre>";*/

        if (isset($_POST['Transport'])) {
            $model->attributes = $_POST['Transport'];
            $model->user_name = $this->bracUser['Fname'].' '. $this->bracUser['Mname'].' '. $this->bracUser['Lname'];
            $model->level = $this->bracUser['Level'];
            $get_type = $_POST['Transport']['travel_type'];
            $outside_dhaka =  $_POST['Transport']['travel_in_out'];

            $user_type = TransportFlowSupervisor::isSupervisor();
            if($user_type){
                $userid =  Yii::app()->user->id;
                $get_user = User::model()->findAll(array("condition"=>"id =  $userid"));
                $get_pin = $get_user[0]['username'];
                $get_supervisor_id = TransportFlowSupervisor::model()->findAll(array("condition"=>"pin =  $get_pin"));
                $model->transport_flow_supervisor_id = $get_supervisor_id[0]['id'];

            }

            if ( $model->validate()){

            // Supervisor official and Outside Dhaka Yes
            if($get_type == 0 and $outside_dhaka == 1 and $user_type){
                $model->status = 3;
                //$this->sendDataIfleet($model);
            }
            // User official and Outside Dhaka Yes
            if($get_type == 0 and $outside_dhaka == 1 and !$user_type){
                $model->status = 2;
            }
            // Supervisor Official and Outside Dhaka No
            if($get_type == 0 and $outside_dhaka == 0 and $user_type){
                $model->status = 3;
             //   $this->sendDataIfleet($model);
            }
            // User official and Outside Dhaka No, waiting for supervisor approval
            if($get_type == 0 and $outside_dhaka == 0 and !$user_type){
                $model->status = 2;
            }
            // Supervisor Personal and Outside Dhaka Yes, waiting for PEMS approval
            if($get_type == 1 and $outside_dhaka == 1 and $user_type){
                $model->status = 4;
                $model->transport_flow_supervisor_id = 46; // Set Supervisor ID of PEMS

            }
            // User Personal and Outside Dhaka Yes, waiting for PEMS approval
            if($get_type == 1 and $outside_dhaka == 1 and !$user_type){
                $model->status = 4;
                $model->transport_flow_supervisor_id = 46; // Set Supervisor ID of PEMS
            }
            // Supervisor Personal and Outside Dhaka No
            if($get_type == 1 and $outside_dhaka == 0 and $user_type){
                $model->status = 3;
                //$data =  Transport::model()->find(array('select'=>'id','order' => 'id desc','limit'=>'1'));
                //$model->id = $data->id + 1;
                //$this->sendDataIfleet($model);
            }
            // User Personal and Outside Dhaka No
            if($get_type == 1 and $outside_dhaka == 0 and !$user_type){
                $model->status = 3;
               // $data =  Transport::model()->find(array('select'=>'id','order' => 'id desc','limit'=>'1'));
               // $model->id = $data->id + 1;
               // $this->sendDataIfleet($model);
            }
            }

            // Getting The Supervisor Email ID from HR Service for Email Service

            if(!empty($_POST['Transport']['transport_flow_supervisor_id'])){
                $get_supervisor_id = $_POST['Transport']['transport_flow_supervisor_id'];
                $get_supervisor_pin = TransportFlowSupervisor::model()->findAll(array("condition"=>"id =  $get_supervisor_id"));
                $model2 = $hrdata->getHrUser($get_supervisor_pin[0]['pin']);
            }

									
            $model->code = sha1(mt_rand(10000, 99999) . time() . $model1[0]['Email'] . $model->pin);


            if ($model->save()) {
                if($get_type == 0 and $outside_dhaka == 1 and $user_type){
                    $this->sendDataIfleet($model);
                }
                if($get_type == 0 and $outside_dhaka == 0 and $user_type){
                    $this->sendDataIfleet($model);
                }
                if($get_type == 1 and $outside_dhaka == 0 and $user_type){
                    $this->sendDataIfleet($model);
                }
                if($get_type == 1 and $outside_dhaka == 0 and !$user_type){
                    $this->sendDataIfleet($model);
                }

                if(!empty($model2[0]['Email']))
                {
                
                    $rec_mail = $model2[0]['Email'];
                    $this->sendMailIcress($model,$rec_mail);

                }
                Yii::app()->user->setFlash('green', 'A new transport requisition is submitted');
                $this->redirect("user");
            }
        }


        $this->render('create', array(
            'model' => $model,
            'model1' => $model1,
            'travel_type' => $this->travel_type,
            'outside_dhaka' => $this->outside_dhaka,
            'vehicle_type' => $vehicle_type
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Transport'])) {

//            Yii::app()->getModule('fleet')->status;

            $model->attributes = $_POST['Transport'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
        $hrdata = new HrdService;
        $model1 = $hrdata->getHrUser(Yii::app()->user->name);

        $this->render('update', array(
            'model' => $model,
            'model1' => $model1,
            'travel_type' => $this->travel_type,
            'outside_dhaka' => $this->outside_dhaka,
        ));
    }

    public function actionUpdateAjax1($id)
    {
     //   $supervisor = TransportFlowSupervisor::model()->find(array('condition' => 'pin=:pin', 'params' => array(':pin' => Yii::app()->user->name)));
     //   $supervisor_id = $supervisor['id'];
        $model = $this->loadModel($id);
       // $model->attributes = $_POST['Transport'];
        $model->status = 3;
        $model->code = "";

        $hrdata = new HrdService;
        $model1 = $hrdata->getHrUser($model->pin);
        $rec_mail = $model1[0]['Email'];
        $model->save();


         $this->sendDataIfleet($model);
        //die;
         $this->sendMailIcress($model,$rec_mail);

        Yii::app()->user->setFlash('success', "Requisition is approved!");
        $this->redirect('supervisor');
    }

    public function actionUpdateAjax2($id)
    {
        $model = $this->loadModel($id);
        //$model->attributes = $_POST['Transport'];
        $model->status = 5;
        $model->code = "";

        $hrdata = new HrdService;
        $model1 = $hrdata->getHrUser($model->pin);
        $rec_mail = $model1[0]['Email'];

        $model->save();
        $this->sendMailIcress($model,$rec_mail);
        Yii::app()->user->setFlash('error', "Requisition is not approved!");
        $this->redirect('supervisor');
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        if(TransportFlowSupervisor::model()->isSupervisor()) {
            $this->redirect("fleet/transport/supervisor");
        } else {
            $this->redirect("fleet/transport/user");
        }
    }

    /**
     * Manages all models.
     */
    public function actionUser()
    {
        $model = new Transport('search');
        $model->unsetAttributes();
        if (isset($_GET['Transport']))
            $model->attributes = $_GET['Transport'];
        $data = $model->search()->itemCount;

        $this->render('user', array(
            'model' => $model,
            'count' => $data
        ));


    }

    public function actionSupervisor()
    {
        // Condition for PEMS Director

        $supervisor = TransportFlowSupervisor::model()->find(array('condition' => 'pin=:pin and special=:special', 'params' => array(':pin' => Yii::app()->user->name, 'special' => 1)));

        if(Yii::app()->user->username == $supervisor['pin']){
            $supervisor_id = $supervisor['id'];
            $model = new Transport('pemsearch');
            $model->unsetAttributes();

            $data = $model->pemsearch($supervisor_id)->itemCount;

            Yii::app()->user->setFlash('warning', " " . $data . " requisitions pending for approval");

            $this->render('pems', array(
                'model' => $model,
                'supervisor_id' => $supervisor_id,
                'count' => $data
            ));
        }

        // Condition for All Supervisor except PEMS Director
        else {
        $supervisor = TransportFlowSupervisor::model()->find(array('condition' => 'pin=:pin', 'params' => array(':pin' => Yii::app()->user->name)));
        $supervisor_id = $supervisor['id'];
        $model = new Transport('adminsearch');
        $model->unsetAttributes();

        //$data = $model->adminsearch($supervisor_id)->itemCount;
        $data = Transport::model()->Count(array('condition' => 'transport_flow_supervisor_id=:id and status=:status', 'params' => array(':id' => $supervisor_id, ':status'=>'2')));

        Yii::app()->user->setFlash('warning', " " . $data . " requisitions pending for approval");

        $this->render('admin', array(
            'model' => $model,
            'supervisor_id' => $supervisor_id,
            'count' => $data
        ));
        }

    }

    public function actionManualIfleet($id){
        $data = Yii::app()->request->getParam('id');
        $model = $this->loadModel($data);
        $model->code = "";
        $model->save();
        $this->sendDataIfleet($model);
    }

    public function sendMailIcress($model,$rec_mail)
    {
        try{
            $soapClient = new SoapClient("http://172.25.100.41:8080/isoap.comm.imail/EmailWS?wsdl");

            $job = new jobs;

            //$job->subject='Transport Requisition Notification';
            $job->jobContentType='html';
            $job->fromAddress='mydesk@brac.net';
            $job->udValue1='myDesk';
            $job->requester='myDesk';

         //   $job->jobRecipients[0]=new jobRecipients;
         //   $job->jobRecipients[0]->recipientEmail="shouman.das@gmail.com";
            $job->jobRecipients[0]=new jobRecipients;
    	    $job->jobRecipients[0]->recipientEmail=$rec_mail;
 
 
            $hrdata = new HrdService;
            $model1 = $hrdata->getHrUser($model->pin);
            //$rec_mail = $model1[0]['Email'];

            if($model->status == '4'){
                $job->subject='Transport Requisition awaiting approval';
                $job->body = $this->renderPartial('_email_requisition_pending', array('model'=>$model,'model1'=>$model1,'rec_mail'=>$rec_mail), true);
            }
            if($model->status == '2'){
                $job->subject='Transport Requisition awaiting approval';
                $job->body = $this->renderPartial('_email_requisition_pending', array('model'=>$model,'model1'=>$model1,'rec_mail'=>$rec_mail), true);
            }
            if($model->status == '5'){
                $job->subject='Your Transport Request Declined';
                $job->body = $this->renderPartial('_email_requisition_declined', array('model'=>$model,'model1'=>$model1,'rec_mail'=>$rec_mail), true);
            }
            if($model->status == '6a'){
                $job->subject='Your Transport Request Reviewed and Approved';
                $job->body = $this->renderPartial('_email_requisition_review_approve', array('model'=>$model,'model1'=>$model1,'rec_mail'=>$rec_mail), true);
            }
            if($model->status == '6b'){
                $job->subject='Transport Request Review Notification';
                $job->body = $this->renderPartial('_email_requisition_review', array('model'=>$model,'model1'=>$model1,'rec_mail'=>$rec_mail), true);
            }
            
            if($model->status == '3'){
                $job->subject='Your Transport Request Approved';
                $job->body = $this->renderPartial('_email_requisition_approved', array('model'=>$model), true);
            }
            
          /*
           if($model->status == '2'){
            $job->subject='Transport Requisition awaiting approval';
            $job->body = $this->renderPartial('_email_requisition_pending', array('model'=>$model,'model1'=>$model1,'rec_mail'=>$rec_mail), true);
            }
           elseif($model->status == '3'){
                $job->subject='Your Transport Request Approved';
                $job->body = $this->renderPartial('_email_requisition_approved', array('model'=>$model), true);
            }
           elseif($model->status == '4'){
               $job->subject='Transport Requisition awaiting approval';
               $job->body = $this->renderPartial('_email_requisition_pending', array('model'=>$model,'model1'=>$model1,'rec_mail'=>$rec_mail), true);
           }
           elseif($model->status == '5'){
               $job->subject='Your Transport Request Declined';
               $job->body = $this->renderPartial('_email_requisition_declined', array('model'=>$model), true);
            }*/

            $jobs = array('jobs'=>$job);
            $send_email =$soapClient->__call('sendEmail',array($jobs));


        }
        catch (SoapFault $fault) {
            $error = 1;
            print($fault->faultcode."-".$fault->faultstring);
        }
    }

/*    public function generateCode($email, $pin) {
        return sha1(mt_rand(10000, 99999) . time() . $email . $pin);
    }*/

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Transport the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Transport::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Transport $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'transport-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function sendDataIfleet($model)
    {


        $hrdata = new HrdService;
        $hr_info = $hrdata->getHrUser($model->pin);

        if($model->transport_flow_supervisor_id){
        $supervisor = TransportFlowSupervisor::model()->find(array('condition' => 'id=:id', 'params' => array(':id' => $model->transport_flow_supervisor_id)));
        $supervisor_status = 'YES';
        }else{
            $supervisor['name'] = '';
            $supervisor['pin'] = '';
            $supervisor_status = '';
        }


        if($model->travel_type == 0){
            $travel = 1; // Official for Ifleet
        }elseif($model->travel_type == 1){
            $travel = 2; // Personal for Ifleet
        }


        $user_mail = $hr_info[0]['Email'];

        $start_date = explode(" ",$model->start_date);
        $return_date = explode(" ",$model->return_date);
        $pin = "$model->pin";
        $pin = ltrim($pin, '0');

        $host = Yii::app()->params['ifleetdb']['host'];
        $port = Yii::app()->params['ifleetdb']['port'];
        $user = Yii::app()->params['ifleetdb']['user'];
        $pass = Yii::app()->params['ifleetdb']['pass'];
        $dbname = Yii::app()->params['ifleetdb']['dbname'];

        $connectionString = 'mysql:host='.$host.';port='.$port.';dbname='.$dbname.'';

        $feelConn = new CDbConnection($connectionString, $user, $pass);


        $sql = "insert into tbl_requisitions (bpmt_ref_no,vehicletype_id, user_pin,user_name,user_level,dept_name,email,".
        "user_cell,user_address,start_point,end_point,start_date,end_date,start_time,end_time,passenger,supervisor_name,supervisor_pin,approve_status,remarks,dutytype_id)"
        ." values (:bpmt_ref_no, :vehicletype_id, :user_pin, :user_name, :user_level, :dept_name, :email,  :user_cell, :user_address, :start_point, :end_point, :start_date, :end_date, :start_time,:end_time, :passenger, :supervisor_name, :supervisor_pin, :approve_status, :remarks, :dutytype_id)";
        $parameters = array(':bpmt_ref_no' => $model->id, ':vehicletype_id' => $model->vehicle_type, ':user_pin' => $pin, ':user_name' => $model->user_name, ':user_level' => $hr_info[0]['Level'], ':dept_name' => $model->bill_dept,':email' => $hr_info[0]['Email'],':user_cell' => $hr_info[0]['Mobile'],':user_address' => $hr_info[0]['ContactAddress'],':start_point' => $model->start_point,':end_point' => $model->end_point,':start_date' => $start_date[0],':end_date' => $return_date[0],':start_time' => $start_date[1],':end_time' => $return_date[1],':passenger' => $model->passanger, ':supervisor_name' => $supervisor['name'], ':supervisor_pin' => $supervisor['pin'], ':approve_status' => $supervisor_status, ':remarks' => $model->travel_reason,':dutytype_id' => $travel);
        $feelConn->createCommand($sql)->execute($parameters);

        return;
    }

    public function actionApprove(){
        $key = Yii::app()->request->getParam('key');
        $email = Yii::app()->request->getParam('email');
        $id = Yii::app()->request->getParam('id');

        $model = User::model()->findByAttributes(array('email' => $email));
        if ($model === null) {
            throw new CHttpException(503, 'The requested User does not exists in our system.');
        }

        $transport = Transport::model()->findAllByPk($id);


        if(empty($transport[0]->code)) {
            Yii::app()->user->setFlash('error', "Link already used.");
            $this->redirect(array('alert'));
            //throw new CHttpException(503, 'Link already used');
        } else if ($transport[0]->code !== $key) {
            throw new CHttpException(503, 'Invalid activation code.');
        } else if ($transport[0]->status == 3){
            throw new CHttpException(503, 'Requisition already approved.');
        } else {
            $transport[0]->status = 3;
            $transport[0]->code = "";
            $transport[0]->update();
//            echo "<pre>";
//            print_r($transport[0]);
//            echo "</pre>";
//            die;
            $this->sendDataIfleet($transport[0]);  // Send Data iFleet
            $this->sendMailIcress($transport[0],$email);

            Yii::app()->user->setFlash('success', "Request Successfully Approved.");
            $this->redirect(array('confirm'));
        }
    }

    public function actionDecline(){
        $key = Yii::app()->request->getParam('key');
        $email = Yii::app()->request->getParam('email');
        $id = Yii::app()->request->getParam('id');

        $model = User::model()->findByAttributes(array('email' => $email));
        if ($model === null) {
            throw new CHttpException(503, 'The requested User does not exists in our system.');
        }

        $transport = Transport::model()->findAllByPk($id);

        if(empty($transport[0]->code)) {
            //throw new CHttpException(503, 'Link already used');
            Yii::app()->user->setFlash('error', "Link already used.");
            $this->redirect(array('alert'));
        } else if ($transport[0]->code !== $key) {
            throw new CHttpException(503, 'Invalid activation code.');
        } else if ($transport[0]->status == 5){
            throw new CHttpException(503, 'Requisition already declined.');
        } else {
            $transport[0]->status = 5;
            $transport[0]->code = "";
            $transport[0]->update();
            $this->sendMailIcress($transport[0],$email);
            Yii::app()->user->setFlash('success', "Request Successfully Declined.");
            $this->redirect(array('confirm'));
    }
    }

    public function actionConfirm(){
        $this->layout = "//layouts/confirm";
        $this->render('confirm');
    }
    public function actionAlert(){
        $this->layout = "//layouts/confirm";
        $this->render('alert');
    }

    public function actionReview(){

        /*echo "<pre style='display: none'>";
        CVarDumper::dump($_POST,'10',true);
        echo "</pre>";*/
        //Yii::app()->end();
        $key = Yii::app()->request->getParam('key');
        $email = Yii::app()->request->getParam('email');
        $id = Yii::app()->request->getParam('id');
        $vehicle_type = Yii::app()->getModule('fleet')->vehicleType;

        $user_model = User::model()->findByAttributes(array('email' => $email));
        if ($user_model === null) {
            throw new CHttpException(503, 'The requested User does not exists in our system.');
        }

        $transport = Transport::model()->findByPk($id);
        if(empty($transport->code)) {
            //throw new CHttpException(503, 'This request already reviewed');
            Yii::app()->user->setFlash('error', "This request already reviewed.");
            $this->redirect(array('alert'));
        }
        elseif ($transport->code !== $key) {
            throw new CHttpException(503, 'Invalid activation code.');
        }
        else if ($transport->status == 5){
            throw new CHttpException(503, 'Requisition already declined.');
        }
        else{
        if (isset($_POST['Transport'])) {
            unset($_POST['Transport']['travel_type']);
            unset($_POST['Transport']['travel_in_out']);
            $transport->attributes = $_POST['Transport'];
              // $transport->code = "";

            if(isset($_POST['button1'])) {
                $transport->status = 3;
            }
            if(isset($_POST['button2'])) {
                $transport->status = 6;
            }

            $transport->update();

            // Email
            if ($_POST['button1'] == 'Approve') {
                $transport->status = '6a'; //sending for email only, not for save in db
                $this->sendMailIcress($transport, User::model()->find('username=:pin', array(':pin' => $transport->pin))->email);
                Yii::app()->user->setFlash('success', "Requisition reviewed and approved");
                $this->sendDataIfleet($transport);
            } else {
                $transport->status = '6b'; //sending for email only, not for save in db
                $this->sendMailIcress($transport, User::model()->find('username=:pin', array(':pin' => $transport->pin))->email);
                Yii::app()->user->setFlash('success', "Requisition sent for user review");
            }
                $this->redirect($this->actionConfirm());
             }
        }

        $this->render('review', array(
            'model' => $transport,
            //'model1'=>$model1,
            'travel_type' => $this->travel_type,
            'outside_dhaka' => $this->outside_dhaka,
            'vehicle_type' => $vehicle_type
        ));
    }


    public function actionUserReview(){

        $key = Yii::app()->request->getParam('key');
        $email = Yii::app()->request->getParam('email');
        $id = Yii::app()->request->getParam('id');
        $vehicle_type = Yii::app()->getModule('fleet')->vehicleType;

        $user_model = User::model()->findByAttributes(array('email' => $email));
        if ($user_model === null) {
            throw new CHttpException(503, 'The requested User does not exists in our system.');
        }

        $transport = Transport::model()->findByPk($id);
        if(empty($transport->code)) {
            throw new CHttpException(503, 'This request already reviewed');
        }
        elseif ($transport->code !== $key) {
            throw new CHttpException(503, 'Invalid activation code.');
        }
        else if ($transport->status == 5){
            throw new CHttpException(503, 'Requisition already declined.');
        }
        else{
            if (isset($_POST['Transport'])) {
                unset($_POST['Transport']['travel_type']);
                unset($_POST['Transport']['travel_in_out']);
                $transport->attributes = $_POST['Transport'];
                //$transport->code = "";

                if(isset($_POST['button1'])) {
                    $transport->status = 2;
                }

                $transport->update();

                // Email
                if (isset($_POST['button1'])) {
                    $transport->status = '2'; //sending for email only, not for save in db

                    $supervisorId = Transport::model()->find(array('condition'=>'id=:id', 'params'=>array(':id'=>$transport->id)));
                    $get_supervisor_pin = TransportFlowSupervisor::model()->findAll(array("condition"=>"id=:sid", 'params'=>array(':sid'=>$supervisorId['transport_flow_supervisor_id'])));
                    $hrdata = new HrdService;
                    $model2 = $hrdata->getHrUser($get_supervisor_pin[0]['pin']);

                    $this->sendMailIcress($transport,$model2[0]['Email']);
                    Yii::app()->user->setFlash('success', "Requisition resubmitted successfully!");

                }
                $this->redirect($this->actionConfirm());
            }
        }

        $this->render('userreview', array(
            'model' => $transport,
            //'model1'=>$model1,
            'travel_type' => $this->travel_type,
            'outside_dhaka' => $this->outside_dhaka,
            'vehicle_type' => $vehicle_type
        ));
    }



}


class jobs {
    public $appUserId; // string
    public $attachments; // attachment
    public $bcc; // string
    public $body; // string
    public $caption; // string
    public $cc; // string
    public $complete; // boolean
    public $feedbackDate; // dateTime
    public $feedbackEmail; // string
    public $feedbackName; // string
    public $feedbackSent; // boolean
    public $fromAddress; // string
    public $fromText; // string
    public $gateway; // string
    public $jobContentType; // string
    public $jobId; // long
    public $jobRecipients; // jobRecipients
    public $mode; // string
    public $numberOfItem; // int
    public $numberOfItemFailed; // int
    public $numberOfItemSent; // int
    public $priority; // string
    public $requester; // string
    public $status; // string
    public $subject; // string
    public $toAddress; // string
    public $toText; // string
    public $udValue1; // string
    public $udValue2; // string
    public $udValue3; // string
    public $udValue4; // string
    public $udValue5; // string
    public $udValue6; // string
    public $udValue7; // string
    public $vtemplate; // string
}

class jobRecipients {
    public $failCount; // int
    public $image; // base64Binary
    public $job; // jobs
    public $jobDetailId; // long
    public $recipientEmail; // string
    public $sent; // boolean
    public $sentDate; // dateTime
    public $toText; // string
}
