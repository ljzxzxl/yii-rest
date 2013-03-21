<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii Blog Demo',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin',
	),

	'defaultController'=>'user',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'class' => 'system.db.CDbConnection',
			'connectionString' => 'mysql:host=192.168.100.108;dbname=rest',
			'emulatePrepare' => true,
			'username' => 'webconnect',
			'password' => '123456',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path',
			'showScriptName'=>false,    // 将代码里链接的index.php隐藏掉
        	'rules'=>array(
						'post/<id:\d+>/<title:.*?>'=>'post/view',
						'posts/<tag:.*?>'=>'post/index',
						//Gii启用所需规则
						'gii'=>'gii',
						'gii/<controller:\w+>'=>'gii/<controller>',
						'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
						// REST patterns
						array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
						array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
						array('user/list', 'pattern'=>'user/<model:\w+>', 'verb'=>'GET'),
						array('user/create', 'pattern'=>'user/<model:\w+>', 'verb'=>'POST'),
						array('user/view', 'pattern'=>'user/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('user/update', 'pattern'=>'user/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('user/delete', 'pattern'=>'user/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						// Other controllers
						'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
						//去除index.php后的新规则
						'<controller:\w+>/<id:\d+>'=>'<controller>/view',
						'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
						'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        	),
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);
