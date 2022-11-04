<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'URL Shortener',
    'timeZone' => 'Asia/Tashkent',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1234',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    'components' => array(
        'qrcode' => array(
            'class' => 'ext.qrcode.QRCode'
        ),
        'randstr' => array(
            'class' => 'ext.randstr.GeneratorString'
        ),
        'request' => array(
            'enableCsrfValidation' => true
        ),
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest')
        ),
        'JWT' => [
            'class' => 'ext.jwt.JWT',
            'secret' => 'my_secret_key'
        ],
        'user' => array(
            'class' => 'WebUser',
            'loginUrl' => '/auth/login',
            'allowAutoLogin' => true,
        ),
        'urlManager' => array(
//            'class' => 'ext.yii-multilanguage.MLUrlManager',
            'urlFormat' => 'path',
            'showScriptName' => false,
//            'languages' => array(
//                'uz',
//                'ru',
//                'en'
//            ),
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                'short/<url:\w+>' => 'short/view',
                'status/download/<url:\w+>' => 'status/download',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => array(
            'errorAction' => YII_DEBUG ? null : 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    'params' => array(
        'adminEmail' => 'nizomovasadbek1199@gmail.com',
    ),
);
