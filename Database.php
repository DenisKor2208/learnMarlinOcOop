<?php

/*паттерн Singleton
 * существует только один экземпляр объекта во всем приложении и его дубликатов не бывает
 */
class Database {

    private static $instance = null; //статичное приватное свойство
    private $pdo;

    private function __construct() { //так как этот метод/конструктор приватный, то доступ к нему возможен только в этом классе
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=edu_marlin', 'root', 'root');
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {        //если переменной не существует то создается класс, иначе возвращается созданный класс
            self::$instance = new Database(); //создание экземпляра/объекта класса и установка его в переменную $instance
        }
        return self::$instance;
    }
}



?>