<?php

class LoginController extends Controller {

    public $defaultAction = 'login';

    private function ssoSessionExists($key, $data) {
        $cleanData = preg_replace('/[\x00-\x1F\x7F]/', '', $data);
        $cleanData = str_replace($key, '', $cleanData);
        if ($cleanData == 'session:false')
            return false;
        else
            return true;
    }

    private function getSetApplicationUser($user) {
        $find = User::model()->findByAttributes(array('username' => $user));
        if ($find) {
            return true;
        } else {
            $b = new User;
            $b->username = $user;

            $b->password = UserModule::encrypting("br@c#1231321");

            $hrdata = new HrdService;
            $model1 = $hrdata->getHrUser($user);

            $b->email = $model1[0]['Email'];
            if (empty($b->email)) {
                Yii::app()->user->logout();                
                throw new CHttpException(503, 'Your email id not updated in BRAC HRD System. Please contact with BRAC HRD.');
            }
            $b->activkey = UserModule::encrypting(microtime() . $pass);
            $b->create_at = date('Y-m-d H:i:s');
            $b->lastvisit_at = date('Y-m-d H:i:s');
            $b->superuser = 0;
            $b->status = 1;
            $b->save();

            $c = new Profile;
            $c->user_id = $b->id;
            $c->lastname = $user;
            $c->firstname = $user;
            $c->save();
            return true;
        }
        return false;
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        
        $model = new UserLogin;        
        //Yii::app()->user->setFlash('loginMessage','Thank you for contacting us. We will respond to you as soon as possible.');        
        
        $multipass = Yii::app()->request->getParam('multipass');
        $ssoSessionCheckUrl = Yii::app()->params['sso']['ssoSessionUrl'] . '?site=' . Yii::app()->params['sso']['appUrl'];

        if (!isset($multipass)) {
            if (Yii::app()->user->isGuest) {
                Yii::app()->request->redirect($ssoSessionCheckUrl);
            } 
        } else {
            $key = Yii::app()->params['sso']['appKey'];
            $ssoSubject = base64_decode($multipass);
            $ssoSubjectDecode = $this->decrypt_data($ssoSubject, $key, $key);

            if ($this->ssoSessionExists($key, $ssoSubjectDecode)) {
                $ssoInfo = explode("|", $ssoSubjectDecode);
                $username = explode(":", $ssoInfo[0]); // username:riad
                //$password = explode(":", $ssoInfo[1]); // password:123456
                $auth = explode(":", $ssoInfo[3]);    // authorization:true
                if ($auth[1] == "true") {
                    if ($this->getSetApplicationUser($username[1])) { // user already exists in our database                      
                        $pass = User::model()->find(array('condition' => 'username=:u', 'params' => array(':u' => $username[1])))->password;
                        $identity = new UserIdentity($username[1], $pass);
                        $identity->authenticate();
                        if ($identity->errorCode === UserIdentity::ERROR_NONE) {
                            Yii::app()->user->login($identity, 0);
                            $this->redirect(Yii::app()->user->returnUrl);
                        } else {
                            echo $identity->errorCode;
                        }
                    }
                }
            }
        }

        //$model = new UserLogin;
        //if (isset($username) && isset($password)) {
        //    $model->username = $username[1];
        //    $model->password = $password[1];

        //    if ($model->validate()) {
        //        $this->lastViset();
        //        if (Yii::app()->user->returnUrl == '/index.php')
        //            $this->redirect(Yii::app()->controller->module->returnUrl);
        //        else
        //            $this->redirect(Yii::app()->user->returnUrl);
        //   }
        //}
        $this->render('/user/login', array('model' => $model));
        Yii::app()->end();
    }

    private function lastViset() {
        $lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
        $lastVisit->lastvisit = time();
        $lastVisit->save();
    }

    public function decrypt_data($data, $iv, $key) {
        $cypher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');

        if (is_null($iv)) {
            $ivlen = mcrypt_enc_get_iv_size($cypher);
            $iv = substr($data, 0, $ivlen);
            $data = substr($data, $ivlen);
        }

        // initialize encryption handle
        if (mcrypt_generic_init($cypher, $key, $iv) != -1) {
            // decrypt
            $decrypted = mdecrypt_generic($cypher, $data);

            // clean up
            mcrypt_generic_deinit($cypher);
            mcrypt_module_close($cypher);

            return $decrypted;
        }

        return false;
    }

}
