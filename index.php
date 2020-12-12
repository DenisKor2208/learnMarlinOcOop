<?php
session_start();

require_once "Database.php";
require_once "Config.php";
require_once "Validate.php";
require_once "Input.php";
require_once "Token.php";
require_once "Session.php";

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
        'token_name' => 'token' //в сессии значение ключа мы будем хранить под именем token
    ]
];

/*Данный код отвечает за валидацию и использование двух компонентов Input и Validation*/
if (Input::exists()) { // exists - проверка была ли отправлена форма
    if (Token::check(Input::get('token'))) { //проверка что наш токен который мы передали с данными формы является именно тем, который находится в сессии у данного пользователя
        $validate = new Validate();

        $validation = $validate->check($_POST, [ // 1. что чекать($_POST) - источник информации  2. На что чекать
            'username' => [
                'required' => true,
                'min' => 2,
                'max' => 15,
                'unique' => 'users' //username должен быть уникальным в таблице users
            ],
            'password' => [
                'required' => true,
                'min' => 3
            ],
            'password_again' => [
                'required' => true,
                'matches' => 'password' //должен совпадать со значением поля password
            ]
        ]);

        if ($validation->passed()) {

            //Database

            Session::flash('success', 'register success'); //записываем значение(2 аргумент) в ключ сессии(1 аргумент)
            //header('Location: /test.php');

        } else {
            foreach ($validation->errors() as $error) {
                echo $error . "<br>";
            }
        }
    }
}
//echo Config::get('mysql.host');

//$users = Database::getInstance()->query("SELECT * FROM users WHERE username IN(?, ?)", ['John Doe', 'Jane Koe']); //выполняем запросы через этот метод напрямую
//$users = Database::getInstance()->get('users', ['username', '=', 'Jane Koe']); //это полноценная обертка
//Database::getInstance()->delete('users', ['username', '=', 'Jane Koe']);
/*Database::getInstance()->insert('users', [
    'username' => 'Denis Korotin',
    'password' => 'password3'
]);*/




/*$id = 7;
Database::getInstance()->update('users', $id, [
    'username' => 'Marlin',
    'password' => 'password5'
]);*/
//$users = Database::getInstance()->get('users', ['username', '=', 'Jane Koe']);
//echo $users->results();

//$users = Database::getInstance()->get('users', ['id', '=', '1']);
//echo $users->first();




/*
if ($users->error()){
    echo "we have an error";
}else {
    foreach ($users->results() as $user) {
        echo $user->username . '<br>';
    }
}
*/

?>

<!-- Форма для проверки работы Validation и Input -->
<!-- Наша форма хранит свои данные в глобальном массиве POST -->
<form action="" method="post"> <!-- action отправляет на текущую страницу на которой размещена форма -->
    <?php echo Session::flash('success'); ?> <!-- записываем значение(2 аргумент) в ключ сессии(1 аргумент) -->
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo Input::get('username')?>"> <!-- Input занимается данными которые вводятся через форму -->
    </div>

    <div class="field">
        <label for="">Password</label>
        <input type="text" name="password">
    </div>

    <div class="field">
        <label for="">Password Again</label>
        <input type="text" name="password_again">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>
