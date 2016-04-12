<?php

/**
 * This is the model class for table "comm_settings".
 *
 * The followings are the available columns in table 'comm_settings':
 * @property integer $id
 * @property string $item
 * @property string $price
 * @property string $category
 * @property string $size
 * @property string $color
 * @property string $type
 * @property string $status
 */
class Settings extends CActiveRecord {

    public $status = array(
        '0' => 'Requested',
        '1' => 'Approved',
        '2' => 'Rejected',
        '3' => 'Assigned',
        '4' => 'Completed',
    );

    public function getStatusCode($name) {
        return array_search($name, $this->status);
    }   

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comm_settings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('item, price, category', 'required'),
            array('item, price, category, size, color, type', 'length', 'max' => 127),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, item, price, category, size, color, type', 'safe', 'on' => 'search'),
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
            'item' => 'Item',
            'price' => 'Price',
            'category' => 'Category',
            'size' => 'Size',
            'color' => 'Color (For Design Only)',
            'type' => 'Type (For Printing Only)',
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
        $criteria->compare('item', $this->item, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('category', $this->category, true);
        $criteria->compare('size', $this->size, true);
        $criteria->compare('color', $this->color, true);
        $criteria->compare('type', $this->type, true);
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
     * @return Settings the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    
    public function sendMail($model, $sentTo, $requester, $service) {
        try {
            $soapClient = new SoapClient("http://172.25.100.41:8080/isoap.comm.imail/EmailWS?wsdl");

            $job = new jobs;
            $job->jobContentType = 'html';
            $job->fromAddress = 'mydesk@brac.net';
            $job->udValue1 = 'myDesk';
            $job->requester = 'myDesk';
            $job->jobRecipients[0] = new jobRecipients;
            $job->jobRecipients[0]->recipientEmail = $sentTo;                        
            
            if ($model->status == '0') {                
                $job->subject = 'Service Request to Communication Awaiting Approval';
                $job->body = Yii::app()->controller->renderPartial('//communications/settings/_email_requisition_pending', array('model' => $model, 'service'=>$service, 'requester' => $requester, 'sendTo' => $sentTo), TRUE, FALSE);
            }
            if ($model->status == '1') {            
                $job->subject = 'Communication Requisition Approved';
                $job->body = Yii::app()->controller->renderPartial('//communications/settings/_email_requisition_approved', array('model' => $model, 'service'=>$service, 'model1' => $requester, 'rec_mail' => $sentTo), TRUE, FALSE);
            }
            else if ($model->status == '1t') {
                $job->subject = 'New Communication Requisition Requested';
                $job->body = Yii::app()->controller->renderPartial('//communications/settings/_email_requisition_requested', array('model' => $model, 'service'=>$service, 'model1' => $requester, 'rec_mail' => $sentTo), TRUE, FALSE);
            }
            else if ($model->status == '2') {
                $job->subject = 'Communication Requisition Declined';
                $job->body = Yii::app()->controller->renderPartial('//communications/settings/_email_requisition_declined', array('model' => $model, 'service'=>$service, 'model1' => $requester, 'rec_mail' => $sentTo), TRUE, FALSE);
            }
            else if ($model->status == '3') {
                $job->subject = 'New Communication Requisition Assigned';
                $job->body = Yii::app()->controller->renderPartial('//communications/settings/_email_requisition_assigned', array('model' => $model, 'service'=>$service, 'model1' => $requester, 'rec_mail' => $sentTo), TRUE, FALSE);
            }
            else if ($model->status == '4') {
                $job->subject = 'New Communication Requisition Task Completed';
                $job->body = Yii::app()->controller->renderPartial('//communications/settings/_email_requisition_completed', array('model' => $model, 'service'=>$service, 'model1' => $requester, 'rec_mail' => $sentTo), TRUE, FALSE);
            }
            else if ($model->status == '4c') {
                $job->subject = 'Communication Requisition Completed';
                $job->body = Yii::app()->controller->renderPartial('//communications/settings/_email_requisition_completed', array('model' => $model, 'service'=>$service, 'model1' => $requester, 'rec_mail' => $sentTo), TRUE, FALSE);
            }
            
            $jobs = array('jobs' => $job);
            $send_email = $soapClient->__call('sendEmail', array($jobs));
        } catch (SoapFault $fault) {
            $error = 1;
            print($fault->faultcode . "-" . $fault->faultstring);
        }
        return TRUE;
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
