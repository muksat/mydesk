<?php

class LoginController extends Controller {

    public $defaultAction = 'login';

    private function ssoSessionExists($key, $data){
        $cleanData = preg_replace('/[\x00-\x1F\x7F]/', '', $data);
        $cleanData = str_replace($key, '',  $cleanData);
        if( $cleanData == 'session:false' )
            return false;
        else
            return true;
    }

    private function getSetApplicationUser($user, $pass){

        $newpass = UserModule::encrypting($pass); // if pass has changed


        //$d = User::model()->findAll(array("select" => "id", "condition" => array("username=:username  && password=:password", array(':username'=>$user, ':password'=>$newpass)), "order" => "id"));
        $d = User::model()->find(array(
            'condition'=> 'username=:user AND password=:pass',
            'params'=> array(':user'=>$user, ':pass'=>$newpass),
        ));


        if (!$d) {
            $find = User::model()->findByAttributes(array('username'=>$user));
            if($find) {
                $find->password = $newpass;
                if ($find->update()) return true;
            } else {
                $b = new User;
                $b->username = $user;
                $b->password = UserModule::encrypting($pass);

            //CVarDumper::dump($b, 10, true);

                $hrdata = new HrdService;
                $model1 = $hrdata->getHrUser($user);
        //CVarDumper::dump($model1, 10, true);
                $b->email = $model1[0]['Email'];
                if(empty($b->email))
                {                        
                        throw new CHttpException(503, 'Your email id not updated in BRAC HRD System. Please contact with BRAC HRD.');
                    
                }
                $b->activkey = UserModule::encrypting(microtime() . $pass);
                $b->create_at = date('Y-m-d H:i:s');
                $b->lastvisit_at = date('Y-m-d H:i:s');
                $b->superuser = 0;
                $b->status = 1;
                $b->save();
                //CVarDumper::dump($b->getErrors());
                 //if($b->save()) {
                 //    CVarDumper::dump($b->id, 10, true);
                 //    $someModelObject->getErrors();
                   // $getuid = User::model()->findAll(array("condition" => "username = $user", "order" => "id"));
                    //$getuid = User::model()->find(array('condition'=> 'username=:user','params'=> array(':user'=>$user)));
                    $c = new Profile;
                   // $c->user_id = $getuid[0]['id'];
                    $c->user_id = $b->id;
                    $c->lastname = $user;
                    $c->firstname = $user;
                    $c->save();
                  //  if($c->save()) return true;
                return true;
                //}
            }
        } else {
            return true;
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $multipass = Yii::app()->request->getParam('multipass');
        $ssoSessionCheckUrl = Yii::app()->params['sso']['ssoSessionUrl'].'?site='.Yii::app()->params['sso']['appUrl'];

        if(!isset($multipass)) {
            Yii::app()->request->redirect($ssoSessionCheckUrl);
        }

        $key = Yii::app()->params['sso']['appKey'];
        $ssoSubject = base64_decode($multipass);
        $ssoSubjectDecode = $this->decrypt_data($ssoSubject,$key,$key);

        if($this->ssoSessionExists($key, $ssoSubjectDecode)) {
            $ssoInfo = explode("|",$ssoSubjectDecode);
            $username = explode(":",$ssoInfo[0]); // username:riad
            $password = explode(":",$ssoInfo[1]); // password:123456
            $auth = explode(":",$ssoInfo[3]);    // authorization:true
            if($auth[1]=="true") {
                if($this->getSetApplicationUser($username[1], $password[1])) {
                    if (!Yii::app()->user->isGuest) {
                        $this->redirect(Yii::app()->user->returnUrl);
                    } else {
                        $identity=new UserIdentity($username[1],$password[1]);
                        $identity->authenticate();
                        Yii::app()->user->login($identity);
                        $this->redirect(Yii::app()->user->returnUrl);
                    }
                }
            }
        }
        $model=new UserLogin;
        if(isset($username) && isset($password)) {
            $model->username = $username[1];
            $model->password = $password[1];

            if($model->validate()) {
                $this->lastViset();
                if (Yii::app()->user->returnUrl=='/index.php')
                    $this->redirect(Yii::app()->controller->module->returnUrl);
                else
                    $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('/user/login',array('model'=>$model));

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