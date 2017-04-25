<?php

/**
 * @author Sergey Muzyka
 * @company Loginaut
 * @site http://loginaut.com
 * @created 9/12/12
 */


// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);


return array(
	'name' => 'Qpromo',
    'components' => array(
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=qpromo',
            'emulatePrepare' => true,
            'username' => 'qpromo',
            'password' => 'hYj67!hdtG',
            'charset' => 'utf8',
            'tablePrefix' => '',            
        ),
        
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                /*array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'error, warning',
                ),*/
            ),
        ),
    ),
    
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'dmitry@loginaut.com',
        'quoteEmail'=>'dmitry@loginaut.com',
        'contactEmail'=>'dmitry@loginaut.com',
                
        'paypal' => array(
	  'merchantId'=>'JC9USEVPKTJWE'
        ),
        
        'authorizeNet' => array(
			//'METHOD_TO_USE' => 'AIM',
			'AUTHORIZENET_API_LOGIN_ID' => '000000000',
			'AUTHORIZENET_TRANSACTION_KEY' => '00000000000',
			'AUTHORIZENET_SANDBOX' => true,
			'TEST_REQUEST' => false, // You may want to set to true if testing against production
			'AUTHORIZENET_MD5_SETTING' => '',
		),        
    ),
);