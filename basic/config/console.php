<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
		'debug' => 'yii\debug\Module',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
			'allowedIPs' => ['127.0.0.1', '192.168.1.25', '91.208.134.254', '*', '::1'] // adjust this to your needs
		),
	   'gridview' =>  [
			'class' => '\kartik\grid\Module'
		]		
	],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];
