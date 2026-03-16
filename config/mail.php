<?php
// config/mail.php

return [
    'class' => \yii\symfonymailer\Mailer::class,
    'viewPath' => '@app/mail',
    'useFileTransport' => false,
    'transport' => [
        'scheme' => 'smtp',
        'host' => 'localhost',
        'port' => 1025,
        'username' => null,
        'password' => null,
    ],
];