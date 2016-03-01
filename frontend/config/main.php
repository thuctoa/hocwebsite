<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'name'=>'Học Website',
    'sourceLanguage'=> 'vi',
    'language'=> 'vi',
    'timezone' =>'Asia/Ho_Chi_Minh',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl' => '/',
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        'jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        'css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [ 
                        'js/bootstrap.min.js',
                    ]
                ],
               // 'yii\widgets\ActiveFormAsset' => false,
               // 'yii\validators\ValidationAsset' => false,
               ],
        ],
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request'=>[
            'baseUrl'=>'',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '/<id:[\w\-]+>' => 'site/index',
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '213920512290093',
                    'clientSecret' => 'a2e2aabb1e34e9ce0099193afc1c1f32',
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/index',
            'site/signup',
            'site/login',
            'site/logout',
            'site/request-password-reset',
            'site/reset-password',
            'site/update-user',
            'site/user'
        ],
    ],
    'params' => $params,
];
