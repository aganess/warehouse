<?php
return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => false,

    'rules' => [
        '/' => '/site/index',
        [
            'class' => 'yii\web\UrlRule',
            'pattern' => '<action:signup|login|logout|about|request-password-reset|reset-password|verify-email|captcha|contact>',
            'route' => 'site/<action>',
            'suffix' => ''
        ],


        '<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
        '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
        '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
        '<module:\w+>/<controller:\w+>' => '<module>/<controller>/index',
        '<module:\w+>' => '<module>/default/index',

    ],
];