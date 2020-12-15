<?php
require_once 'init.php';

//10-05

var_dump(Session::get(Config::get('session.user_session')));

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


