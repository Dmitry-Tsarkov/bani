<?php

use mihaildev\elfinder\Controller;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'На сайт',

    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        \app\bootstrap\SetUp::class,
        \app\modules\user\Bootstrap::class,
        'log',
        'admin',
        'api',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => Controller::class,
            'access' => ['@', '?'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl' => '@web',
                    'basePath' => '@webroot',
                    'path' => 'uploads/images',
                    'name' => 'Изображения'
                ],
                [
                    'baseUrl' => '@web',
                    'basePath' => '@webroot',
                    'path' => 'uploads/files',
                    'name' => 'Файлы'
                ],
            ]
        ]
    ],

    'modules' => [
        'gridview' => \kartik\grid\Module::class,
        'admin' => [
            'class' => \app\modules\admin\Module::class,
            'modules' => [
                'category' => \app\modules\category\UI\admin\Module::class,
                'menu' => \app\modules\menu\UI\admin\Module::class,
                'product' => \app\modules\product\UI\admin\Module::class,
                'slider' => \app\modules\slider\UI\admin\Module::class,
                'characteristic' => \app\modules\characteristic\UI\admin\Module::class,
                'feedback' => \app\modules\feedback\UI\admin\Module::class,
                'action' => \app\modules\action\UI\admin\Module::class,
                'review' => \app\modules\review\UI\admin\Module::class,
                'portfolio' => \app\modules\portfolio\UI\admin\Module::class,
                'faq' => \app\modules\faq\UI\admin\Module::class,
            ],
        ],
        'api' => [
            'class' => \app\modules\api\Module::class,
            'modules' => [
                'main' => \app\modules\api\Module::class,
                'page' => \app\modules\page\UI\api\Module::class,
                'category' => \app\modules\category\UI\api\Module::class,
                'product' => \app\modules\product\UI\api\Module::class,
                'feedback' => \app\modules\feedback\UI\api\Module::class,
                'action' => \app\modules\action\UI\api\Module::class,
                'review' => \app\modules\review\UI\api\Module::class,
                'portfolio' => \app\modules\portfolio\UI\api\Module::class,
            ],
        ],
        'user' => \app\modules\user\Module::class,
        'page' => \app\modules\page\Module::class,
        'setting' => \app\modules\setting\Module::class,
    ],
    'components' => [
        'authManager' => \yii\rbac\DbManager::class,
        'request' => [
            'baseUrl' => '',
            'cookieValidationKey' => 'QmHM8kUCL1VN8EB0Xy1EzsxbFJF2s9Ff',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => \app\modules\user\models\User::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => $params['reCaptcha']['v2']['siteKey'],
            'secretV2' => $params['reCaptcha']['v2']['secret'],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => !YII_ENV_PROD,
            'messageConfig' => [
                'from' => 'no-reply@annastomatologia.ru',
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'no-reply@annastomatologia.ru',
                'password' => 'smallbany67',
                'port' => '465',
                'encryption' => 'ssl',
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
