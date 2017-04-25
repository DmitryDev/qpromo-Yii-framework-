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
    'components' => array(
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=qpromo',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),

    ),
);
