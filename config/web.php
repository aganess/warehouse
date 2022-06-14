<?php

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'basic',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'warehouse' => [
            'class' => 'app\modules\warehouse\Module',
        ],
    ],
    'components' => [
        'common' => [
            'class' => 'app\config\components\Common',
        ],
        'request' => [
            'baseUrl' => '',
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY'),
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => env('DB_DSN'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8',
        ],

        'assetManager' => [
            'appendTimestamp' => true,
        ],

        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',
        ],

        'urlManager' => require(__DIR__ . '/settings/__urlManager.php'),
    ],
    'params' => $params,
];

require __DIR__ . '/settings/debug.php';

return $config;
