<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$urls = include(dirname(__FILE__) . '/urlrules.php');
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        /*'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=we',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix' => 'we_',
        ],*/
        'db'=>require(__DIR__ . '/db.php'),
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*'urlManager'=>[
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
                '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' =>'<controller>/<action>',
                '<controller:(post|comment)>/<id:\d+>' => '<controller>/read',
                '<controller:(post|comment)>s' => '<controller>/list',
            ],
        ],*/
        'urlManager'=>[
            'class' => 'yii\web\UrlManager',//引用urlManager类
            'enablePrettyUrl' => true,//开启url美化，默认为false
            'suffix' => ".html",//启用.html后缀
            'showScriptName' => false,//隐藏index.php
            'rules' => $urls,

        ],
    ],
    'params' => $params,
];
