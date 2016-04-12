<?php

/**
 * This is the model class for table "comm_flow_supervisor".
 *
 * The followings are the available columns in table 'comm_flow_supervisor':
 * @property integer $id
 * @property integer $pin
 * @property string $name
 * @property string $designation
 * @property string $dept
 * @property integer $status
 * @property integer $special
 */
class Supervisor extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comm_flow_supervisor';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pin, name', 'required'),
            array('name','unique', 'message'=>'This supervisor already exists.'),
            array('id, pin, status, special', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 40),
            array('designation', 'length', 'max' => 255),
            array('dept', 'length', 'max' => 255),
            array('id, pin, name, designation, dept, status, special', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'pin' => 'Pin',
            'name' => 'Name',
            'designation' => 'Designation',
            'dept' => 'Dept',
            'status' => 'Status',
            'special' => 'Special',
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
        $criteria->compare('pin', $this->pin);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('designation', $this->designation, true);
        $criteria->compare('dept', $this->dept, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('special', $this->special);

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

    public function isSupervisor() {
        $supervisorId = Supervisor::model()->find(array('condition' => 'pin=:pin', 'params' => array(':pin' => Yii::app()->user->name)));
        if ($supervisorId) return true;
        else return false;
    }
    
      
    public function isSpecialSupervisor() {
        $supervisorId = Supervisor::model()->find(array('condition' => 'pin=:pin and special=:sp', 'params' => array(':pin' => Yii::app()->user->name, ':sp' => '1')));
        if ($supervisorId) return true;
        else return false;
    }

}
