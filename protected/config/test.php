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

	'language'=>'zh_cn',
	'sourceLanguage'=>'en_us',

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
			'tablePrefix' => 'yxz_',
		),

		//Yii RBAC 用户角色权限控制配置
		'authManager'=>array(
			'class' => 'CDbAuthManager',//认证类名称
			'defaultRoles' => array('guest'),//默认角色
			'itemTable' => 'yxz_auth_item',//认证项表名称
			'itemChildTable' => 'yxz_auth_item_child',//认证项父子关系
			'assignmentTable' => 'yxz_auth_assignment',//认证项赋权关系
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path',
			'showScriptName'=>true,    //是否显示URL中的index.php
        	'rules'=>array(
						//Gii启用所需规则
						'gii'=>'gii',
						'gii/<controller:\w+>'=>'gii/<controller>',
						'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
						// REST patterns
						array('search', 'pattern'=>'search/<keyword:\w+>', 'verb'=>'GET'),
						array('recycle/act', 'pattern'=>'recycle/<model:\w+>', 'verb'=>'GET'),
						
						array('user/list', 'pattern'=>'user/<model:\w+>', 'verb'=>'GET'),
						array('user/post', 'pattern'=>'user/<model:\w+>', 'verb'=>'POST'),
						array('user/get', 'pattern'=>'user/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('user/update', 'pattern'=>'user/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('user/delete', 'pattern'=>'user/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						array('user/resource/list', 'pattern'=>'user/<model:\w+>/<act:\w+>', 'verb'=>'GET'),
						
						array('company/list', 'pattern'=>'company/<model:\w+>', 'verb'=>'GET'),
						array('company/post', 'pattern'=>'company/<model:\w+>', 'verb'=>'POST'),
						array('company/view', 'pattern'=>'company/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('company/update', 'pattern'=>'company/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('company/delete', 'pattern'=>'company/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						
						array('file/list', 'pattern'=>'file/<model:\w+>', 'verb'=>'GET'),
						array('file/post', 'pattern'=>'file/<model:\w+>', 'verb'=>'POST'),
						array('file/view', 'pattern'=>'file/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('file/update', 'pattern'=>'file/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('file/delete', 'pattern'=>'file/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						
						array('folder/list', 'pattern'=>'folder/<model:\w+>', 'verb'=>'GET'),
						array('folder/post', 'pattern'=>'folder/<model:\w+>', 'verb'=>'POST'),
						array('folder/get', 'pattern'=>'folder/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('folder/update', 'pattern'=>'folder/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('folder/delete', 'pattern'=>'folder/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						array('folder/resource/list', 'pattern'=>'folder/<model:\w+>/<act:\w+>', 'verb'=>'GET'),
						
						array('group/list', 'pattern'=>'group/<model:\w+>', 'verb'=>'GET'),
						array('group/post', 'pattern'=>'group/<model:\w+>', 'verb'=>'POST'),
						array('group/get', 'pattern'=>'group/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('group/update', 'pattern'=>'group/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('group/delete', 'pattern'=>'group/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						array('group/resource/list', 'pattern'=>'group/<model:\w+>/<act:\w+>', 'verb'=>'GET'),
						
						array('order/list', 'pattern'=>'order/<model:\w+>', 'verb'=>'GET'),
						array('order/post', 'pattern'=>'order/<model:\w+>', 'verb'=>'POST'),
						array('order/view', 'pattern'=>'order/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('order/update', 'pattern'=>'order/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('order/delete', 'pattern'=>'order/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						
						array('pref/list', 'pattern'=>'pref/<model:\w+>', 'verb'=>'GET'),
						array('pref/post', 'pattern'=>'pref/<model:\w+>', 'verb'=>'POST'),
						array('pref/view', 'pattern'=>'pref/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('pref/update', 'pattern'=>'pref/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('pref/delete', 'pattern'=>'pref/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						
						array('share/list', 'pattern'=>'share/<model:\w+>', 'verb'=>'GET'),
						array('share/post', 'pattern'=>'share/<model:\w+>', 'verb'=>'POST'),
						array('share/get', 'pattern'=>'share/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('share/update', 'pattern'=>'share/<model:\w+>', 'verb'=>'PUT'),
						array('share/delete', 'pattern'=>'share/<model:\w+>', 'verb'=>'DELETE'),
						
						array('workspace/list', 'pattern'=>'workspace/<model:\w+>', 'verb'=>'GET'),
						array('workspace/post', 'pattern'=>'workspace/<model:\w+>', 'verb'=>'POST'),
						array('workspace/get', 'pattern'=>'workspace/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('workspace/update', 'pattern'=>'workspace/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
						array('workspace/delete', 'pattern'=>'workspace/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
						array('workspace/resource/list', 'pattern'=>'workspace/<model:\w+>/<act:\w+>', 'verb'=>'GET'),
						
						array('favorite/list', 'pattern'=>'favorite/<model:\w+>', 'verb'=>'GET'),
						array('favorite/post', 'pattern'=>'favorite/<model:\w+>', 'verb'=>'POST'),
						array('favorite/get', 'pattern'=>'favorite/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
						array('favorite/update', 'pattern'=>'favorite/<model:\w+>', 'verb'=>'PUT'),
						array('favorite/delete', 'pattern'=>'favorite/<model:\w+>', 'verb'=>'DELETE'),
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
