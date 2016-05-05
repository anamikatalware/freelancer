<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Freelancer',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.admin.models.*',
        'application.modules.user.models.*'
    ),
    'modules' => array(
        'admin' => array(),
        'user' => array(),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            'ipFilters' => array('127.0.0.1', '::1', $_SERVER['REMOTE_ADDR']),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                /* User Module Route */
                'log-in' => 'user/site/login',
                'log-out' => 'user/site/logout',
                'forgot-password' => 'user/site/forgotpassword',
                'register' => 'user/site/register',
                'post-a-project' => 'user/site/postproject',
                'dashboard' => 'user/site/index',
                'profile' => 'user/customer/index',
                'settings' => 'user/customer/settings',
                'portfolio' => 'user/portfolio/index',
                'portfolio/add' => 'user/portfolio/add',
                'portfolio/edit/<id:\d+>' => 'user/portfolio/edit',
                'portfolio/delete/<id:\d+>' => 'user/portfolio/delete',
                'membership' => 'user/membership/index',
                'inbox' => 'user/inbox/index',
                'projects-with-my-skills' => 'user/jobs/jobsbyskills',
                
                /* Admin Module Route */
                'admin' => 'admin/site/login', // ADD THIS
                //'dubai-tours' => 'site/index',
                //'dubai-visa' => 'site/visa',
                //'dubai-tours/<slug:[a-zA-Z0-9-]+>' => 'site/viewTour',
                '<action:\w+>/<id:\d+>' => 'site/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                /* User Module Route */
                'user/<controller:\w+>/view/<id:\d+>' => 'user/<controller>/view',
                'user/<controller:\w+>/<action:\w+>/<id:\d+>' => 'user/<controller>/<action>',
                'user/<controller:\w+>/<action:\w+>' => 'user/<controller>/<action>',
                /* Admin Module Route */
                'admin/<controller:\w+>/view/<id:\d+>' => 'admin/<controller>/view',
                'admin/<controller:\w+>/<action:\w+>/<id:\d+>' => 'admin/<controller>/<action>',
                'admin/<controller:\w+>/<action:\w+>' => 'admin/<controller>/<action>',
            ),
        ),
        'db' => require_once 'database.php',
//        'db' => array(
//            'class' => 'CDbConnection',
//            'tablePrefix' => 'tbl_',
//            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/admin.sqlite',
//        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
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
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
        //'theme' => 'freelancer',
);
