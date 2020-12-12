<?php

class Session {
    public static function put($name, $value) { //записываем значение сессии($value) в ключ с именем $name
        return $_SESSION[$name] = $value;
    }

    public static function exists($name) { //проверка на существование переданного ключа со значением в сессии
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function delete($name) { //удаление записи из сессии
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function get($name) { //получить значение переданного ключа из сессии
        return $_SESSION[$name];
    }
}