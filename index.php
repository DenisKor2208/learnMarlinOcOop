<?php

require_once 'Database.php';

//$users = Database::getInstance()->query("SELECT * FROM users WHERE username IN(?, ?)", ['John Doe', 'Jane Koe']); //выполняем запросы через этот метод напрямую
$users = Database::getInstance()->get('users', ['username', '=', 'Jane Koe']); //это полноценная обертка

/*Database::getInstance()->delete('users', ['username', '=', 'marlin']);*/

if ($users->error()){
    echo "we have an error";
}else {
    foreach ($users->results() as $user) {
        echo $user->username . '<br>';
    }
}


?>