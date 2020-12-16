<?php
require_once 'init.php';

$user = new User(); //вытаскиваем текущего залогиненного пользователя

$validate = new Validate();
$validate->check($_POST, [ //проверяем глобальный массив POST
    'current_password' => ['required' => true, 'min' => 6],
    'new_password' => ['required' => true, 'min' => 6],
    'new_password_again' => ['required' => true, 'min' => 6, 'matches' => 'new_password'] //'matches' => 'new_password' - поле должно совпадать с new_password
]);

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        if ($validate->passed()) {
            if (password_verify(Input::get('current_password'), $user->data()->password)) {
                $user->update(['password' => password_hash(Input::get('new_password'), PASSWORD_DEFAULT)]);
                Session::flash('success', 'Password has been updated.');
                Redirect::to('index.php');
            } else {
                echo 'Current password is invalid';
                exit;
            }
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
        <label for="">Current password</label>
        <input type="text" name="current_password" id="current_password" value="">
    </div>

    <div class="field">
        <label for="">New password</label>
        <input type="text" name="new_password" id="new_password" value="">
    </div>

    <div class="field">
        <label for="">New password again</label>
        <input type="text" name="new_password_again" id="new_password_again" value="">
    </div>

    <div class="field">
        <button type="submit">Submit</button>
    </div>

    <input type="hidden" name="token" id="token" value="<?php echo Token::generate();?>">
</form>
