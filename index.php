<?php

// change the following paths if necessary
// 4office
$yii=dirname(__FILE__).'/framework/yii.php';
// 00584
// $yii='C:/Frameworks/yii/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
//global functions
$global=dirname(__FILE__).'/protected/extensions/globals.php';

// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
require_once($global);
Yii::createWebApplication($config)->run();
