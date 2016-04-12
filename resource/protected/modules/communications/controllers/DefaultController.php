<?php

class DefaultController extends Controller {

    public function filters() {
        return array(
            'accessControl'
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'feedback','invoice'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('inbox'),
                'expression' => 'Supervisor::model()->isSupervisor() || TeamMembers::model()->isTeamLead()',
            ),
            array('allow',
                'actions' => array('tasks'),
                'expression' => 'Supervisor::model()->isSupervisor() || TeamMembers::model()->isTeamMember()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionInbox() {
        $photographyCriteria = new CDbCriteria;
        $photographyCriteria->compare('status', 1, true, 'OR');
        $photographyCriteria->compare('status', 3, true, 'OR');
        $photographyCriteria->compare('status', 4, true, 'OR');
        $photographyCriteria->order = 'id DESC';

        $dataPhotography = new CActiveDataProvider('Photography', array('criteria' => $photographyCriteria));



        $designCriteria = new CDbCriteria;
        $designCriteria->compare('status', 1, true, 'OR');
        $designCriteria->compare('status', 1, true, 'OR');
        $designCriteria->compare('status', 3, true, 'OR');
        $designCriteria->compare('status', 4, true, 'OR');
        $designCriteria->order = 'id DESC';
        $dataDesign = new CActiveDataProvider('Design', array('criteria' => $designCriteria));


        $audiovisualCriteria = new CDbCriteria;
        $audiovisualCriteria->compare('status', 1, true, 'OR');
        $audiovisualCriteria->compare('status', 3, true, 'OR');
        $audiovisualCriteria->compare('status', 4, true, 'OR');
        $audiovisualCriteria->order = 'id DESC';
        $dataAudiovisual = new CActiveDataProvider('Audiovisual', array('criteria' => $audiovisualCriteria));

        $printingCriteria = new CDbCriteria;
        $printingCriteria->compare('status', 1, true, 'OR');
        $printingCriteria->compare('status', 3, true, 'OR');
        $printingCriteria->compare('status', 4, true, 'OR');
        $printingCriteria->order = 'id DESC';
        $dataPrinting = new CActiveDataProvider('Printing', array('criteria' => $printingCriteria));

        $this->render('inbox', array(
            'dataPhotography' => $dataPhotography,
            'dataDesign' => $dataDesign,
            'dataAudiovisual' => $dataAudiovisual,
            'dataPrinting' => $dataPrinting,
        ));
    }

    public function actionTasks() {

        $photographyCriteria = new CDbCriteria;
        $photographyCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members) AND status >= 3";
        $dataPhotography = new CActiveDataProvider('Photography', array('criteria' => $photographyCriteria));
        $photographyCriteria->order = 'id DESC';

        $designCriteria = new CDbCriteria;
        $designCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members) AND status >= 3";
        $dataDesign = new CActiveDataProvider('Design', array('criteria' => $designCriteria));
        $designCriteria->order = 'id DESC';

        $audiovisualCriteria = new CDbCriteria;
        $audiovisualCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members) AND status >= 3";
        $dataAudiovisual = new CActiveDataProvider('Audiovisual', array('criteria' => $audiovisualCriteria));
        $audiovisualCriteria->order = 'id DESC';

        $printingCriteria = new CDbCriteria;
        $printingCriteria->condition = " find_in_set('" . Yii::app()->user->name . "', team_members) AND status >= 3";
        $dataPrinting = new CActiveDataProvider('Printing', array('criteria' => $printingCriteria));
        $printingCriteria->order = 'id DESC';

        $this->render('tasks', array(
            'dataPhotography' => $dataPhotography,
            'dataDesign' => $dataDesign,
            'dataAudiovisual' => $dataAudiovisual,
            'dataPrinting' => $dataPrinting,
        ));
    }

    public function actionFeedback() {
        $id = Yii::app()->request->getParam('id');
        $service = Yii::app()->request->getParam('service');

        if ($service == "photography")
            $model = Photography::model()->findByPk($id);
        if ($service == "design")
            $model = Design::model()->findByPk($id);
        if ($service == "audiovisual")
            $model = Audiovisual::model()->findByPk($id);
        if ($service == "printing")
            $model = Printing::model()->findByPk($id);
             
        if (isset($_POST['Photography'])) {
            $model->feedback_procecss = $_POST['Photography']['feedback_procecss'];
            $model->feedback_time = $_POST['Photography']['feedback_time'];
            $model->feedback_quality = $_POST['Photography']['feedback_quality'];
            if ($model->update())
                $this->redirect(array('//communications/photography/index', 'id' => $model->id));
            else {
                print_r($model->getErrors());
            }
        }
        if (isset($_POST['Design'])) {
            $model->feedback_procecss = $_POST['Design']['feedback_procecss'];
            $model->feedback_time = $_POST['Design']['feedback_time'];
            $model->feedback_quality = $_POST['Design']['feedback_quality'];
            if ($model->update())
                $this->redirect(array('//communications/design/index', 'id' => $model->id));
            else {
                print_r($model->getErrors());
            }
        }        
        if (isset($_POST['Audiovisual'])) {
            $model->feedback_procecss = $_POST['Audiovisual']['feedback_procecss'];
            $model->feedback_time = $_POST['Audiovisual']['feedback_time'];
            $model->feedback_quality = $_POST['Audiovisual']['feedback_quality'];
            if ($model->update())
                $this->redirect(array('//communications/audiovisual/index', 'id' => $model->id));
            else {
                print_r($model->getErrors());
            }
        }
        
        if (isset($_POST['Printing'])) {
            $model->feedback_procecss = $_POST['Printing']['feedback_procecss'];
            $model->feedback_time = $_POST['Printing']['feedback_time'];
            $model->feedback_quality = $_POST['Printing']['feedback_quality'];
            if ($model->update())
                $this->redirect(array('//communications/printing/index', 'id' => $model->id));
            else {
                print_r($model->getErrors());
            }
        }


        $this->render('feedback', array(
            'model' => $model,
        ));
    }
    
    public function actionInvoice(){
                
          $id = Yii::app()->request->getParam('id');
        $service = Yii::app()->request->getParam('service');

        if ($service == "photography")
            $model = Photography::model()->findByPk($id);
        if ($service == "design")
            $model = Design::model()->findByPk($id);
        if ($service == "audiovisual")
            $model = Audiovisual::model()->findByPk($id);
        if ($service == "printing")
            $model = Printing::model()->findByPk($id);
        
        if (isset($_POST['Photography'])) {
            $model = new Photography;
            $model->attributes = $_POST['Photography'];

            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }
        
        
        $this->render('invoice', array(
            'model'=>$model,
        ));
    }

}
