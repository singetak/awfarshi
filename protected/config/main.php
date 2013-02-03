<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	//'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR,
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'AwfarShi',
	'theme'=>'kroft',
	// preloading 'log' component
	'preload'=>array('log'),
    'language' => 'en',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/**/
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			//tell the application to use your WebUser class instead of the default CWebUser
			'class'=>'application.components.EWebUser',//class used for the roles permision
		),
		'image'=>array(//the image extention for croping and resizing    
			'class'=>'application.extensions.image.CImageComponent',           
			'driver'=>'GD',
		),
		'coreMessages'=>array('basePath'=>'protected/messages',),
        //'assetManager' => array('linkAssets' => false,),
        //'cache' => array('class' => 'system.caching.CFileCache',),//To refresh caching Yii::app()->cache->flush() 
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'site/page/<view:\w+>'=>'site/page',
				'promotion/<id:\d+>/<title:.*?>'=>'promotion/view',
				'featuredpromotion/<id:\d+>/<title:.*?>'=>'featuredpromotion/view',
				'promotions/'=>'promotion/',
				'featuredpromotions/'=>'featuredpromotion/',
				'promotions/<category:.*?>'=>'promotion/index',
				'featuredpromotions/<category:.*?>'=>'featuredpromotion/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				
			),
			'showScriptName'=>false,//Remove the added index.php after links
		),
		'cache'=>array(
            //'class'=>'CDbCache',
            'class'=>'CDummyCache',
        ),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		/**/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=awfarshi_yii',
			'emulatePrepare' => true,
			'username' => 'amer',
			'password' => '1234',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(//comment this on live production
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
	),
	'defaultController' => 'site/index',
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).DIRECTORY_SEPARATOR.'params.php'),
	
);