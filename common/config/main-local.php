<?php
return [
   
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=hocwebsite',
            'username' => 'root',
            'password' => '1',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'h2016@gmail.com',
                'password' => 'lr3fgkRh5',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

        'Urlseo' => [
                    'class' => 'common\seo\Urlseo'
        ],
    ],
];
