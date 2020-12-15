<?php

session_start();

require_once "classes/Database.php";
require_once "classes/Config.php";
require_once "classes/Validate.php";
require_once "classes/Input.php";
require_once "classes/Token.php";
require_once "classes/Session.php";
require_once "classes/User.php";
require_once "classes/Redirect.php";

$GLOBALS['config'] = [ /* Глобальный массив конфигураций для всего приложения */
    'mysql' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'edu_marlin',
        'something' => [
            'no' => 'yes'
        ]
    ],

    'session' => [
        'token_name' => 'token', //в сессии значение ключа мы будем хранить под именем token
        'user_session' => 'user'
    ]
];