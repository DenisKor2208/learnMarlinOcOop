<?php
require_once 'init.php';

$user = new User(); //вытаскиваем текущего залогиненного пользователя

$validate = new Validate();
$validate->check($_POST, [ //проверяем глобальный массив POST
    'username' => ['required' => true, 'min' => 2] //username должен быть обязательным для заполнения и минимум 2 символа в длинну
]);

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        if ($validate->passed()) {
            $user->update(['username' => Input::get('username')]);
            Redirect::to('update.php');
        } else {
            foreach ($validate->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }
}
?>

<form action="" method="post">

    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $user->data()->username;?>">
    </div>

    <div class="field">
        <button type="submit">Submit</button>
    </div>

    <input type="hidden" name="token" id="username" value="<?php echo Token::generate();?>">
</form>
