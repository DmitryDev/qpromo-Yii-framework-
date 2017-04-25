<?php
// System class which provide a capability to know the runtime environment
// and to choose the appropriate configuration file.
require_once(dirname(__FILE__).'/components/system/Environment.php');

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../yii/yiic.php';
$config=dirname(__FILE__).'/config/console.php';

// Environment variable HOSTNAME must me set up on the server to provide
// the real server host name. This variable will be defined to localhost value
// if it's not provided.
isset($_SERVER['HOSTNAME']) or $_SERVER['HOSTNAME'] = 'localhost';

//Choose the right config according to the environment
$environment = new Environment();
$environment->setIsWebApp(false);
$environment->setHost($_SERVER['HOSTNAME']);
$environment->setConfigDir(dirname(__FILE__).'/config/');
$config = $environment->getConfig();

require_once($yiic);


