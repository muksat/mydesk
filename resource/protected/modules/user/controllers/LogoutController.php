<?php

class LogoutController extends Controller
{
    public $defaultAction = 'logout';

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function decrypt_data($data, $iv, $key)
    {
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

