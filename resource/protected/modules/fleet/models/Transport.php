<?php

/**
 * This is the model class for table "transport_flow".
 *
 * The followings are the available columns in table 'transport_flow':
 * @property integer $id
 * @property integer $pin
 * @property integer $travel_type
 * @property string $travel_reason
 * @property integer $travel_in_out
 * @property string $start_date
 * @property string $return_date
 * @property string $start_point
 * @property string $end_point
 * @property integer $passanger
 * @property string $vehicle_type
 * @property string $bill_dept
 * @property integer $onbehalf_pin
 * @property integer $flow_attachment_id
 * @property string $remarks
 * @property integer $status
 * @property integer $transport_flow_supervisor_id
 * @property string $supervisor_remarks
 * @property string $create_time
 * @property string $update_time
 * @property string $code
 */
class Transport extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transport_flow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('pin, travel_type, start_date, return_date, start_point, end_point, vehicle_type, bill_dept, status, transport_flow_supervisor_id', 'required'),
            array('travel_type, start_date, return_date,start_point, end_point, passanger, vehicle_type', 'required'),
			array('pin, travel_type, travel_in_out, passanger, onbehalf_pin, flow_attachment_id, transport_flow_supervisor_id', 'numerical', 'integerOnly'=>true),
			array('travel_reason, user_name, start_point, end_point, remarks, supervisor_remarks, status', 'length', 'max'=>255),
			array('vehicle_type, bill_dept', 'length', 'max'=>127),
			array('code, id, pin, travel_type, travel_in_out, start_date, return_date, start_point, end_point, passanger, vehicle_type, bill_dept, onbehalf_pin, flow_attachment_id, remarks, status, transport_flow_supervisor_id, supervisor_remarks, create_time, update_time', 'safe', 'on'=>'search'),
            array('create_time', 'default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false, 'on'=>'insert'),
            array('update_time', 'default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false, 'on'=>'update'),
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
            'transportflowsupervisor'=>array(self::BELONGS_TO, 'TransportFlowSupervisor', 'transport_flow_supervisor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pin' => 'PIN',
            'user_name' => 'Name',
            'level' => 'Level',
			'travel_type' => 'Type of Travel',
			'travel_reason' => 'Reason of Travelling',
			'travel_in_out' => 'Travel Outside Dhaka?',
			'start_date' => 'Start Date & Time',
			'return_date' => 'Return Date & Time',
			'start_point' => 'Pickup Location',
			'end_point' => 'Destinations',
			'passanger' => 'No of Passenger',
			'vehicle_type' => 'Vehicle Type',
			'bill_dept' => 'Billing Department',
			'onbehalf_pin' => 'Requester',
			'flow_attachment_id' => 'Flow Attachment',
			'remarks' => 'Remarks',
			'status' => 'Status',
			'transport_flow_supervisor_id' => 'Supervisor',
			'supervisor_remarks' => 'Supervisor Remarks',
			'create_time' => 'Create Date & Time',
			'update_time' => 'Update Date & Time',
			'code' => 'Key',
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		//$criteria->compare('t.pin',$this->pin);
		$criteria->compare('t.pin',Yii::app()->user->name);
		$criteria->compare('t.travel_type',$this->travel_type);
		$criteria->compare('t.travel_reason',$this->travel_reason,true);
		/*$criteria->compare('travel_in_out',$this->travel_in_out);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('return_date',$this->return_date,true);
		$criteria->compare('start_point',$this->start_point,true);
		$criteria->compare('end_point',$this->end_point,true);
		$criteria->compare('passanger',$this->passanger);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('bill_dept',$this->bill_dept,true);
		$criteria->compare('onbehalf_pin',$this->onbehalf_pin);
		$criteria->compare('flow_attachment_id',$this->flow_attachment_id);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('status',$this->status);
		$criteria->compare('transport_flow_supervisor_id',$this->transport_flow_supervisor_id);
		$criteria->compare('supervisor_remarks',$this->supervisor_remarks,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);*/

        $criteria->order = 't.id desc';

        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function adminsearch($supervisor_id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('pin',$this->pin);
        //$criteria->compare('t.pin',Yii::app()->user->name);
        $criteria->compare('travel_type',$this->travel_type);
        $criteria->compare('travel_reason',$this->travel_reason);
        $criteria->compare('transport_flow_supervisor_id',$supervisor_id);
        $criteria->compare('status', '2');
        /*$criteria->compare('travel_in_out',$this->travel_in_out);
        $criteria->compare('start_date',$this->start_date,true);
        $criteria->compare('return_date',$this->return_date,true);
        $criteria->compare('start_point',$this->start_point,true);
        $criteria->compare('end_point',$this->end_point,true);
        $criteria->compare('passanger',$this->passanger);
        $criteria->compare('vehicle_type',$this->vehicle_type,true);
        $criteria->compare('bill_dept',$this->bill_dept,true);
        $criteria->compare('onbehalf_pin',$this->onbehalf_pin);
        $criteria->compare('flow_attachment_id',$this->flow_attachment_id);
        $criteria->compare('remarks',$this->remarks,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('transport_flow_supervisor_id',$this->transport_flow_supervisor_id);
        $criteria->compare('supervisor_remarks',$this->supervisor_remarks,true);
        $criteria->compare('create_time',$this->create_time,true);
        $criteria->compare('update_time',$this->update_time,true);*/

        //$criteria->addCondition('status = 2');
        $criteria->order = 'id desc';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function pemsearch($supervisor_id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('pin',$this->pin);
        $criteria->compare('travel_type',$this->travel_type);
        $criteria->compare('travel_reason',$this->travel_reason);
        $criteria->compare('transport_flow_supervisor_id',$supervisor_id);
        $criteria->compare('status',$this->status);
        /*$criteria->compare('travel_in_out',$this->travel_in_out);
        $criteria->compare('start_date',$this->start_date,true);
        $criteria->compare('return_date',$this->return_date,true);
        $criteria->compare('start_point',$this->start_point,true);
        $criteria->compare('end_point',$this->end_point,true);
        $criteria->compare('passanger',$this->passanger);
        $criteria->compare('vehicle_type',$this->vehicle_type,true);
        $criteria->compare('bill_dept',$this->bill_dept,true);
        $criteria->compare('onbehalf_pin',$this->onbehalf_pin);
        $criteria->compare('flow_attachment_id',$this->flow_attachment_id);
        $criteria->compare('remarks',$this->remarks,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('transport_flow_supervisor_id',$this->transport_flow_supervisor_id);
        $criteria->compare('supervisor_remarks',$this->supervisor_remarks,true);
        $criteria->compare('create_time',$this->create_time,true);
        $criteria->compare('update_time',$this->update_time,true);*/
        $criteria->order = 'id desc';

        $criteria->addCondition('status = 2' or 'status = 4');

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }




	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
