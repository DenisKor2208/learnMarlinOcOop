<?php

require_once 'Database.php';

$users = Database::getInstance()->query("SELECT * FROM users WHERE username IN(?, ?)", ['John Doe', 'Jane Koe']);

/*Database::getInstance()->get('users', ['username', '=', 'marlin']);
Database::getInstance()->delete('users', ['username', '=', 'marlin']);*/

if ($users->error()){
    echo "we have an error";
}else {
    foreach ($users->results() as $user) {
        echo $user->username . '<br>';
    }
}


?>