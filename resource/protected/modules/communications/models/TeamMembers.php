<?php

/**
 * This is the model class for table "comm_team_members".
 *
 * The followings are the available columns in table 'comm_team_members':
 * @property integer $id
 * @property integer $team_id
 * @property integer $user_id
 * @property string $user_pin
 * @property string $user_name
 * @property string $team_lead
 *
 * The followings are the available model relations:
 * @property Teams $team
 */
class TeamMembers extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comm_team_members';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('team_id', 'required'),
            array('team_id, user_id', 'numerical', 'integerOnly' => true),
            array('user_pin, user_name, team_lead', 'safe'),
            array('id, team_id, user_id, user_pin', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'team' => array(self::BELONGS_TO, 'Teams', 'team_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'team_id' => 'Team',
            'user_id' => 'User',
            'user_pin' => 'User',
            'user_name' => 'Name',
            'team_lead' => 'Team Lead',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('team_id', $this->team_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('user_pin', $this->user_pin);
        $criteria->compare('user_name', $this->user_name);
        $criteria->compare('team_lead', $this->team_lead);
        $criteria->order = 'team_id ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Supervisor the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function isTeamLead() {
        $user = TeamMembers::model()->find(array('condition' => 'user_pin=:pin AND team_lead=:tl', 'params' => array(':pin' => Yii::app()->user->name, ':tl' => '1')));
        if ($user)
            return true;
        else
            return false;
    }
    public function isServiceTeamLead($service_tag) {
        
        $teamId = Teams::model()->find(array('condition'=>'service_tag=:st', 'params'=>array(':st'=>$service_tag)))->id;        
        $teamLead = TeamMembers::model()->find(array('condition' => 'user_pin=:pin AND team_lead=:tl AND team_id=:td', 'params' => array(':pin' => Yii::app()->user->name, ':tl' => '1', 'td' => $teamId)));
        if ($teamLead)
            return true;
        else
            return false;
    }

    public function getServiceTeamLeadEmail($service_tag) {
         CVarDumper::dump($teamLeadEmail);
        // yii::app()->end();
            
        $teamId = Teams::model()->find(array('condition' => 'service_tag=:st', 'params'=>array(':st'=>$service_tag)))->id;        
        $teamLeadPin = TeamMembers::model()->find(array('condition' => 'team_lead=:tl AND team_id=:t', 'params' => array(':tl' => '1', 't' => $teamId)))->user_pin;
        if ($teamLeadPin) {
            $teamLeadEmail = User::model()->find(array('condition' => 'username=:u', 'params' => array(':u' => $teamLeadPin)))->email;
        } else {
            $specialSupervisorPin = Supervisor::model()->find(array('condition' => 'special=:sp', 'params' => array(':sp' => '1')))->pin;
            $teamLeadEmail = User::model()->find(array('condition' => 'username=:u', 'params' => array(':u' => $specialSupervisorPin)))->email; 
        }
        return $teamLeadEmail;
        //return 'ekram.syed@brac.net';
    }

    public function isServiceTeamMember($service_tag) {
        
       // $teamId = Teams::model()->find(array('condition'=>'service_tag=:st', 'params'=>array(':st'=>$service_tag)))->id;
        
        //CVarDumper::dump($teamId, 10, true);
        
       // $teamMember = TeamMembers::model()->find(array('condition' => 'user_pin=:pin AND team_id=:t', 'params' => array(':pin' => Yii::app()->user->name, ':t'=> $teamId)));
        
       // CVarDumper::dump($teamMember, 10, true);
        
      //  if ($teamMember)
       //     return true;
      //  else
       //     return false;
        return true;
    } 
    public function isTeamMember() {        
        $teamMember = TeamMembers::model()->find(array('condition' => 'user_pin=:pin', 'params' => array(':pin' => Yii::app()->user->name)));
        if ($teamMember)
            return true;
        else
            return false;
    } 
    
    public function isFeedbackGiven($id, $service) {        
        
        if ($service == "photography")
            $model = Photography::model()->findByPk($id);
        if ($service == "design")
            $model = Design::model()->findByPk($id);
        if ($service == "audiovisual")
            $model = Audiovisual::model()->findByPk($id);
        if ($service == "printing")
            $model = Printing::model()->findByPk($id);
        
        if($model->feedback_procecss == "" && $model->feedback_quality=="" && $model->feedback_time=="" && $model->status=="4")
            return true;
        else
            return false;        
    } 
    
    public function isInvoiceVisible($id, $service){
       
       if ($service == "photography")
            $model = Photography::model()->findByPk($id);
        if ($service == "design")
            $model = Design::model()->findByPk($id);
        if ($service == "audiovisual")
            $model = Audiovisual::model()->findByPk($id);
        if ($service == "printing")
            $model = Printing::model()->findByPk($id); 
 
        if( $model->status=="4")
               return true ;
            else
                return false;
    }
}
