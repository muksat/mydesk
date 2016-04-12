<?php

/**
 * This is the model class for table "transport_flow_supervisor".
 *
 * The followings are the available columns in table 'transport_flow_supervisor':
 * @property integer $id
 * @property integer $pin
 * @property integer $status
 */
class TransportFlowSupervisor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transport_flow_supervisor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pin', 'required'),
			array('pin, status, special', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pin, name, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'transport'=>array(self::HAS_MANY, 'Transport', 'transport_flow_supervisor_id'),
		);
	}

    public function isSupervisor(){
       // CVarDumper::dump(Yii::app()->user->name, 10, true);
//        CVarDumper::dump($bracPin, 10, true);

//        Yii::app()->end();
        $supervisorId = TransportFlowSupervisor::model()->find(array('condition' => 'pin=:pin', 'params' => array(':pin' => Yii::app()->user->name)));

       // CVarDumper::dump($supervisorId, 10, true);

        if($supervisorId )
            return true;
        else
            return false;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pin' => 'Pin',
            'name' => 'Name',
            'desig' => 'Designation',
            'dept' => 'Department',
			'status' => 'Status',
            'special' => 'Special Super',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('pin',$this->pin);
        $criteria->compare('name',$this->name);
        $criteria->compare('designation',$this->designation);
        $criteria->compare('dept',$this->dept);
		$criteria->compare('status',$this->status);
        $criteria->compare('special',$this->special);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TransportFlowSupervisor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
