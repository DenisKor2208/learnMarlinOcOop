<?php

class User { //для регистрации пользователя
    private $db, $data, $session_name;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->session_name = Config::get('session.user_session');
    }

    public function create($fields = []) {
        $this->db->insert('users', $fields);
    }

    public function login($email = null, $password = null) {

    if ($email) {
        $user = $this->find($email);

        if ($user) {
            if (password_verify($password, $this->data()->password)) { //если переданный пароль соответствует тому который имеется в БД
                Session::put($this->session_name, $this->data()->id); //то записываем в сессию id пользователя
                return true;
            }
        }
    }
        return false;
    }

    public function find($email = null) { //проверка на существование переданного email в базе
        if($email) {
            $this->data = $this->db->get('users', ['email', '=', $email])->first(); //записываем найденную запись по переданному email в переменную data
            if ($this->data) {
                return true;
            }
        }
        return false;
    }

    public function data() { //getter для переменной data
        return $this->data;
    }


}