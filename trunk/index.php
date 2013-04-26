<?php
/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 * This can be set to anything, but default usage is:
 *     development
 *     testing
 *     production
 */
define('ENVIRONMENT', 'development');

if(defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			$config=dirname(__FILE__).'/protected/config/test.php';
		break;
		case 'testing':
		case 'production':
			$config=dirname(__FILE__).'/protected/config/main.php';
		break;
		default:
			exit('The application environment is not set correctly.');
	}
}
$yii=dirname(__FILE__).'/framework/yii.php';
$global=dirname(__FILE__).'/protected/extensions/globals.php';
// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);
require_once($yii);
require_once($global);
Yii::createWebApplication($config)->run();
