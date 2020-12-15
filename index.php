<?php
require_once 'init.php';

$user = new User; //получаем текущего залогиненного пользователя
$anotherUser = new User(2); //получаем любого другого нужного нам пользователя
//echo $user->data()->username;
//echo $anotherUser->data()->username;

if ($user->isLoggedIn()) {
    echo "Hi, <a href='#'>{$user->data()->username}</a>";
    echo "<p><a href='logout.php'>Logout</a></p>";
} else {
    echo "<a href='login.php'>Login</a> or <a href='register.php'>Register</a>";
}

//var_dump(Session::get(Config::get('session.user_session')));

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


