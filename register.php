<?php

require_once 'init.php';

/*Данный код отвечает за валидацию и использование двух компонентов Input и Validation*/
if (Input::exists()) { // exists - проверка была ли отправлена форма
    if (Token::check(Input::get('token'))) { //проверка что наш токен который мы передали с данными формы является именно тем, который находится в сессии у данного пользователя
        $validate = new Validate();

        $validation = $validate->check($_POST, [ // 1. что чекать($_POST) - источник информации  2. На что чекать
            'username' => [
                'required' => true,
                'min' => 2,
                'max' => 15
            ],
            'email' => [ //здесь email название поля в форме (тег input -> name)
                'required' => true,
                'email' => true, //здесь email название правила валидации которые прописываются в классе Validate
                'unique' => 'users' //email должен быть уникальным в таблице users
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
            $user = new User();
            $user->create([ //запись валидных данных в таблицу
                'username' => Input::get('username'),
                'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT ),
                'email' => Input::get('email')
            ]);

            Session::flash('success', 'register success'); //записываем значение(2 аргумент) в ключ сессии(1 аргумент)
            Redirect::to('login.php');

        } else {
            foreach ($validation->errors() as $error) {
                echo $error . "<br>";
            }
        }
    }
}

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
        <label for="email">Email</label>
        <input type="text" name="email" value="<?php echo Input::get('email')?>"> <!-- Input занимается данными которые вводятся через форму -->
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
