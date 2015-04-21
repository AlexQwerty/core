<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
//    'bootstrap' => ['log'],
    'name' => 'Hello World',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'rMPMk-1deqDOKNj0aFAqBC4Qf-iwohRP',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
            'loginUrl' => '/login',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'kudesniks@gmail.com',
                'password' => 'qwisenationm1',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'users/login',
                'registration' => 'users/registration',
                'logout' => 'users/logout',
                'forgot' => 'users/forgot',
                'reset/<key>' => 'users/reset',
                'activate/<key>' => 'users/activate',
                'page/<token>' => 'pages/index',
                'image/<key>' => 'images/view',
            ],
        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD', //GD or Imagick
        ],
        'assetManager' => [
            'assetMap' => [
                'jquery.js' => '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
                'bootstrap.js' => '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js',
                'bootstrap.css' => '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'
            ],
//            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null,
//                    'js' => [
//                        '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'
//                    ]
//                ],
//            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
