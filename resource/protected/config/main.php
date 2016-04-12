<?php
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'myDesk',
    'language' => 'en',
    'theme' => 'bracflow',
    'preload' => array('log'),
    'timeZone' => 'Asia/Dhaka',

    'import' => array(
        'application.models.*',
        'application.components.*',

        'application.modules.user.models.*',
        'application.modules.user.components.*',

        'application.modules.rights.*',
        'application.modules.rights.components.*',
    ),

    'modules' => array(
        # Fleet Module
        'fleet' => array(
            'appModule' => true,
            'name' => 'Transport Requisition',
            'description' => 'Online requisition for vehicle',
            'image' => 'car.jpg',
            'status' =>  array(
                    '0'=>'Progress',
                    '1'=>'Self',
                    '2'=>'Pending',
                    '3'=>'Approved',
                    '4'=>'PEMS',
                    '5'=>'Declined',
                    '6'=>'Review',
                    '6a'=> 'Review Approved', // Use in sending email only. for database we'll use 3
                    '6b'=> 'Review Pending', // Use in sending email only. for database we'll use 3
        ),
            'vehicleType' =>  array(
                '1'=>'Jeep',
                '2'=>'Car',
                '3'=>'Microbus',
                '4'=>'Pickup/Delivery Van',
                '5'=>'Bus',
                '6'=>'Refrigerator Van',
                '7'=>'Ambulance',
            ),

        ),


        # Communication Module
        'communications' => array(
            'appModule' => true,
            'name' => 'Service request to Communication',
            'description' => 'Online service request to communication',
            'image' => 'b.png'
        ),

        # User Module
        'user' => array(
            'tableUsers' => 'tbl_users',
            'tableProfiles' => 'tbl_profiles',
            'tableProfileFields' => 'tbl_profiles_fields',
        ),

        # Rights Module
        'rights'=>array(
            'superuserName'=>'admin', // Name of the role with super user privileges.
            'authenticatedName'=>'authenticated',  // Name of the authenticated user role.
            'userIdColumn'=>'id', // Name of the user id column in the database.
            'userNameColumn'=>'username',  // Name of the user name column in the database.
            'enableBizRule'=>true,  // Whether to enable authorization item business rules.
            'enableBizRuleData'=>true,   // Whether to enable data for business rules.
            'displayDescription'=>true,  // Whether to use item description instead of name.
            'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages.
            'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.
            'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested.
            //'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights.
            //'appLayout'=>'application.views.layouts.main', // Application layout.
            #'cssFile'=>'rights.css', // Style sheet file to use for Rights.
            'install'=>false,  // Whether to enable installer.
            'debug'=>false,
        ),

        # Gii Module
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'pass123',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),

    ),
    'sourceLanguage' =>'en_US',
    'language' => 'en',

    # application components
    'components' => array(
        # Theme
        'themeManager' => array(
            'basePath' => dirname(__FILE__) . '/../themes',
        ),
        # User
        'user' => array(
            //'class' => 'RWebUser',
            'class' => 'WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        # AuthManager
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'connectionID' => 'db',
            'defaultRoles'=>array('authenticated', 'guest'),
        ),
        # Url Manager
        'urlManager' => array(
            'showScriptName' => false,
            'urlFormat' => 'path',
            'rules' => array(
                '<module:\w+>/<controller:\w+>' => '<module>/<controller>',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<view:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        # Database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=flowdb',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
           // 'enableParamLogging' => true,
            'persistent'=>true
        ),
        # Default Error Controller
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),

        # Application Log
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'trace, info',
                    'categories'=>'system.*',
                ),
                array(
                    'class'=>'CEmailLogRoute',
                    'levels'=>'error, warning',
                    'emails'=>'syed.ekramuddin@brac.net',
                ),
            ),
        ),
    ),

    // using Yii::app()->params['paramName']
    'params' => array(
        'adminEmail' => 'syed.ekramuddin@brac.net',
        'sso' => array(
            'ssoSessionUrl'  => 'http://sso.brac.net/auth/isoap/login/session',
            'ssoLoginUrl'    => 'http://sso.brac.net/auth/isoap/login',
            'ssoLogoutUrl'   => 'http://sso.brac.net/auth/isoap/logout',
            // Dev
            //'appUrl'         => 'http://192.168.20.52/flow',
            //'appLoginUrl'    => 'http://192.168.20.52/flow/user/login',
            //'appLogoutUrl'   => 'http://192.168.20.52/flow/user/logout',
            // Live
            'appUrl'         => 'http://mydesk.brac.net',
            'appLoginUrl'    => 'http://mydesk.brac.net/user/login',
            'appLogoutUrl'   => 'http://mydesk.brac.net/user/logout',
            'appKey'         => 'sso.my8r4c.l1234'
        ),
        'brand' => array(
            '0' => '#FFDD00',
            '1' => '#FBB034',
            '2' => '#7D4199',
            '3' => '#13B5EA',
            '4' => '#D6E03D',
            '5' => '#007161',
            '6' => '#97005E',
        ),
        //Local DB
        'ifleetdb' => array(
            'host' => 'localhost',
            'port' => '3306',
            'user' => 'root',
            'pass' => '',
            'dbname' => 'flowdb'
        ),
        //Live DB
//        'ifleetdb' => array(
//            'host' => '192.168.2.17',
//            'port' => '3306',
//            'user' => 'deskuser',
//            'pass' => 'desk@123',
//            'dbname' => 'ifleetdb'
//        ),
    ),
);