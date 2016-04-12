<?php

/**
 * This is the model class for table "comm_design".
 *
 * The followings are the available columns in table 'comm_design':
 * @property integer $id
 * @property integer $item_id
 * @property integer $user_id
 * @property integer $qty
 * @property string $size
 * @property string $bill_dept
 * @property integer supervisor_id
 * @property string $color
 * @property string $est_delivery_date
 * @property string $brief
 * @property integer $est_total
 * @property integer $team_id
 * @property integer $teamlead_remarks
 * @property integer $team_members
 * @property string $created_by
 * @property string $created_time
 * @property string $updated_by
 * @property string $updated_time
 * @property string $status
 * @property string $code
 * @property string $feedback_procecss
 * @property string $feedback_time
 * @property string $feedback_quality
 * The followings are the available model relations:
 * @property CommSettings $item
 */
class Design extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comm_design';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('qty,est_delivery_date,size,color, user_id,bill_dept,supervisor_id,', 'required'),
            array('est_total,qty', 'numerical', 'integerOnly' => true),
            array('brief,item_id', 'length', 'max' => 145),
            array('qty', 'length', 'max' => 8),
            array('team_id,code,teamlead_remarks,team_members,', 'safe'),
            array('created_by, created_time, updated_by, updated_time, status', 'length', 'max' => 45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id,est_total, item_id, qty, est_delivery_date, brief, created_by, created_time, updated_by, updated_time,status,feedback_procecss,feedback_time,feedback_quality,', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'item' => array(self::BELONGS_TO, 'CommSettings', 'item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Case ID',
            'item_id' => 'Item',
            'team_id' => 'Team',
            'qty' => 'Qty',
            'size' => 'size',
            'color' => 'color',
            'est_delivery_date' => 'Est. Delivery Date',
            'brief' => 'Brief',
            'est_total' => 'Est Total',
            'bill_dept' => 'Billing Department',
            'supervisor_id' => 'Supervisor',
            'teamlead_remarks' => 'Team Instruction',
            'team_members' => 'Team Members',
            'feedback_process' => 'Work Process',
            'feedback_time' => 'Working Time',
            'feedback_quality' => 'Work  Quality',
            'created_by' => 'Created By',
            'created_time' => 'Created Time',
            'updated_by' => 'Updated By',
            'updated_time' => 'Updated Time',
            'status' => 'Status',
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
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('qty', $this->qty);
        $criteria->compare('size', $this->size);
        $criteria->compare('size', $this->color);
        $criteria->compare('est_delivery_date', $this->est_delivery_date, true);
        $criteria->compare('brief', $this->brief, true);
        $criteria->compare('est_total', $this->est_total, true);
        $criteria->compare('bill_dept', $this->bill_dept, true);
        $criteria->compare('supervisor_id', $this->supervisor_id, true);
        $criteria->compare('teamlead_remarks', $this->teamlead_remarks, true);
        $criteria->compare('team_members', $this->team_members, true);
        
        $criteria->compare('feedback_process', $this->feedback_process, true);
        $criteria->compare('feedback_time', $this->feedback_time, true);
        $criteria->compare('feedback_quality', $this->feedback_quality, true);
        
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('created_time', $this->created_time, true);
        $criteria->compare('updated_by', $this->updated_by, true);
        $criteria->compare('updated_time', $this->updated_time, true);
        $criteria->compare('status', $this->status, true);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Design the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
