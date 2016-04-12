<?php

/**
 * This is the model class for table "comm_photographies".
 *
 * The followings are the available columns in table 'comm_photographies':
 * @property integer $id
 * @property string $item
 * @property string $user_id
 * @property integer $days
 * @property string $location
 * @property string $fromdate
 * @property string $todate
 * @property string $deliverydate
 * @property string $brief
 * @property integer $est_total
 * @property string $bill_dept
 * @property integer $supervisor_id
 * @property integer $teamlead_remarks
 * @property integer $team_id
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 * @property string $status
 * @property string $code
 * @property string $feedback_procecss
 * @property string $feedback_time
 * @property string $feedback_quality
 */
class Photography extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comm_photographies';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('days, location, fromdate, todate,user_id,bill_dept,supervisor_id', 'required'),
            array('est_total, days', 'numerical', 'integerOnly' => true),
            array('item, brief', 'length', 'max' => 600),
            array('days, status', 'length', 'max' => 127),
            array('location, created_by, updated_by', 'length', 'max' => 300),
            array('created_time, updated_time, team_id, supervisor_id,code,teamlead_remarks,team_members,feedback_procecss,feedback_time,feedback_quality', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, item, days, location, fromdate, todate, deliverydate, brief, est_total, created_by, created_time, updated_by, updated_time, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'settings' => array(self::HAS_MANY, 'Settings', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Case ID',
            'team_id' => 'Team',
            'item' => 'Package',
            'days' => 'Day(s)',
            'location' => 'Location',
            'fromdate' => 'From Date',
            'todate' => 'To Date',
            'deliverydate' => 'Expected Delivery Date',
            'brief' => 'Brief',
            'est_total' => 'Est. Total',
            'bill_dept' => 'Billing Department',
            'supervisor_id' => 'Supervisor',
            'teamlead_remarks' => 'Team Instruction',
            
            'feedback_process' => 'Work Process',
            'feedback_time' => 'Working Time',
            'feedback_quality' => 'Work  Quality',
            
            'created_by' => 'Created By',
            'created_time' => 'Created Time',
            'updated_by' => 'Updated By',
            'updated_time' => 'Updated Time',
            'status' => 'Status',
            'code' => 'Code',
            'team_members' => 'Team Members',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('item', $this->item, true);
        $criteria->compare('days', $this->days, true);
        $criteria->compare('location', $this->location, true);
        $criteria->compare('fromdate', $this->fromdate, true);
        $criteria->compare('todate', $this->todate, true);
        $criteria->compare('deliverydate', $this->deliverydate, true);
        $criteria->compare('brief', $this->brief, true);
        $criteria->compare('est_total', $this->est_total);
        $criteria->compare('bill_dept', $this->bill_dept, true);
        $criteria->compare('supervisor_id', $this->supervisor_id, true);

        $criteria->compare('feedback_process', $this->feedback_process, true);
        $criteria->compare('feedback_time', $this->feedback_time, true);
        $criteria->compare('feedback_quality', $this->feedback_quality, true);


        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('created_time', $this->created_time, true);
        $criteria->compare('updated_by', $this->updated_by, true);
        $criteria->compare('updated_time', $this->updated_time, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('team_members', $this->team_members, true);
        //$criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Photography the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
