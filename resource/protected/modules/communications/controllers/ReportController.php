<?php

class ReportController extends Controller {

    public function filters() {
        return array(
            'accessControl'
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('requisition', 'billing', 'feedback'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionRequisition() {

        $bill_dept = "select  bill_dept  from comm_photographies 
                      union
                      select  bill_dept from comm_audiovisuals
                      union
                      select  bill_dept from  comm_design
                      union
                      select  bill_dept from comm_printings";
        $billingDept = Yii::app()->db->createCommand($bill_dept)->queryAll();
        
        $i = 0;
        foreach ($billingDept as $key => $val) {
            $bill[$billingDept[$i]['bill_dept']] = $billingDept[$i]['bill_dept'];
            $i++;
        }
        $billingDept = $bill;



        $bill_dept = Yii::app()->request->getParam('billingDept');
        $fromdate = Yii::app()->request->getParam('fromdate');      
        $todate = Yii::app()->request->getParam('todate');
        
        $photographyCriteria = new CDbCriteria;
        $photographyCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataPhotography = new CActiveDataProvider('Photography', array('criteria' => $photographyCriteria));
        $photographyCriteria->order = 'id DESC';

        $designCriteria = new CDbCriteria;        
        $designCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataDesign = new CActiveDataProvider('Design', array('criteria' => $designCriteria));
        $designCriteria->order = 'id DESC';

        $audiovisualCriteria = new CDbCriteria;
        $audiovisualCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataAudiovisual = new CActiveDataProvider('Audiovisual', array('criteria' => $audiovisualCriteria));
        $audiovisualCriteria->order = 'id DESC';

        $printingCriteria = new CDbCriteria;
        $printingCriteria->condition = "bill_dept='$bill_dept' AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataPrinting = new CActiveDataProvider('Printing', array('criteria' => $printingCriteria));
        $printingCriteria->order = 'id DESC';

        $this->render('requisition', array(
            'billingDept' => $billingDept,
            'dataPhotography' => $dataPhotography,
            'dataDesign' => $dataDesign,
            'dataAudiovisual' => $dataAudiovisual,
            'dataPrinting' => $dataPrinting,
        ));
    }

    public function actionBilling() {
        $this->render('billing');
    }

    public function actionFeedback() {
    
        $teamMembers = TeamMembers::model()->findAll(array('select'=>'user_pin, user_name','distinct'=>true,));
        
        $teamMember = Yii::app()->request->getParam('team_member');
        $fromdate = Yii::app()->request->getParam('fromdate');      
        $todate = Yii::app()->request->getParam('todate');
        
        //CVarDumper::dump($teamMember);
        
        
        $photographyCriteria = new CDbCriteria;
        $photographyCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members)  AND created_time>='$fromdate' AND created_time<='$todate'";      
        $dataPhotography = new CActiveDataProvider('Photography', array('criteria' => $photographyCriteria));
        $photographyCriteria->order = 'id DESC';

        $designCriteria = new CDbCriteria;        
        $designCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members)  AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataDesign = new CActiveDataProvider('Design', array('criteria' => $designCriteria));
        $designCriteria->order = 'id DESC';

        $audiovisualCriteria = new CDbCriteria;
       $audiovisualCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members)  AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataAudiovisual = new CActiveDataProvider('Audiovisual', array('criteria' => $audiovisualCriteria));
        $audiovisualCriteria->order = 'id DESC';

        $printingCriteria = new CDbCriteria;
        $printingCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members)  AND created_time>='$fromdate' AND created_time<='$todate'";
        $dataPrinting = new CActiveDataProvider('Printing', array('criteria' => $printingCriteria));
        $printingCriteria->order = 'id DESC';

        $this->render('feedback', array(
            'teamMembers' => $teamMembers,
            'dataPhotography' => $dataPhotography,
            'dataDesign' => $dataDesign,
            'dataAudiovisual' => $dataAudiovisual,
            'dataPrinting' => $dataPrinting,
        ));
        
        
        
        
   
    }

}
