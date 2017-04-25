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
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'worpasds',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
    ),
    'components' => array(
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=qpromo',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
            //'schemaCachingDuration' => 0,
            //'enableParamLogging' => true,
            //'enableProfiling' => true,
            //'schemaCachingDuration' => 3600,
            //'schemaCacheID' => 'dbcache',
            //'queryCachingDuration' => 0,
            //'queryCachingCount' => 1000,
            //'queryCacheID' => 'queryCache',
        ),

        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'info, trace',
                    'logFile'=>'infoMessages.log',
                ),
				// uncomment the following to show log messages on web pages				
				//array(
                //    'class'=>'CWebLogRoute',
                //    'levels'=>'error,warning',
				//),                
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
    ),
);