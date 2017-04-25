<?php
ini_set('error_reporting', 'E_ALL');
//header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

require_once(dirname(__FILE__).'/../app/components/system/Environment.php');
$yii=dirname(__FILE__).'/../yii/yii.php';
$config=dirname(__FILE__).'/../app/config/main.php';

//Choose the right config according the environment
$environment = new Environment();
$environment->setHost($_SERVER['HTTP_HOST']);
$environment->setConfigDir(dirname(__FILE__).'/../app/config/');
$config = $environment->getConfig();

require_once($yii);
Yii::createWebApplication($config)->run();


