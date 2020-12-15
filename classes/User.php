<?php

class User { //для регистрации пользователя
    private $db, $data, $session_name, $isLoggedIn;

    public function __construct($user = null) {
        $this->db = Database::getInstance();
        $this->session_name = Config::get('session.user_session');

        if (!$user) { //Если $user(передается id) пустой, то выполняется код; получаем текущего залогиненного пользователя
            if (Session::exists($this->session_name)) { //проверка есть ли запись в сессии
                $user = Session::get($this->session_name); //получаем из сессии id залогиненного пользователя

                if ($this->find($user)) {
                    $this->isLoggedIn = true;
                } else {
                    //logout
                }
            }
        } else { //если вы передаем id(пользователя), то в таком случае мы его должны только найти
            $this->find($user);
        }
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

    public function find($value = null) { //проверка на существование переданного email в базе
        if (is_numeric($value)){ //если значение цифровое, то значит это id
            $this->data = $this->db->get('users', ['id', '=', $value])->first(); //записываем найденную запись по переданному id в переменную data
        } else { //иначе это email
            $this->data = $this->db->get('users', ['email', '=', $value])->first(); //записываем найденную запись по переданному email в переменную data
        }
            if ($this->data) { //возвращаем true если что-то найдено и записалось
                return true;
            }
        return false;
    }

    public function data() { //getter для переменной data
        return $this->data;
    }

    public function isLoggedIn() { //геттер для переменной isLoggedIn
        return $this->isLoggedIn;
    }

    public function logout() {
        Session::delete($this->session_name);
    }

}