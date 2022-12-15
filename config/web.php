<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - thisis required by cookie validation
 'cookieValidationKey' => '649-19',
 'parsers' => [
    'application/json' => 'yii\web\JsonParser',
]
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
     'class' => \yii\symfonymailer\Mailer::class,
     'viewPath' => '@app/mail',
     // send all mails to a file by default.
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
 'db' => $db,

 'urlManager' => [
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        'POST register' => 'user/create', //регистрация
        'POST login' => 'user/login',//вход  в аккаут
        'POST pattern' => 'pattern/create',//загрузка шаблона
        'POST newdoc' => 'doc/create',//загрузка документа
        'GET getdoc/<ID_doc>' => 'doc/getdoc',//получение документа и данных о нем
        'DELETE deldoc/<ID_doc>' => 'doc/delete',//удаление документа
        'DELETE delcat/<Category>' => 'doc/delcat',//удаление категории
        'GET account' => 'user/account',//личный кабинет
        'PUT editaccount/<ID_user>' => 'user/editaccount', //редактирование аккаунта
    ],



 ],
 'params' => $params,
]];
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from
        //localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from
        //localhost.
        'allowedIPs' => ['127.0.0.1', '::1','*' ],
    ];


}
return $config;