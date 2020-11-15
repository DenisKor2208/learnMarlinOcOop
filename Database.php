<?php

/*паттерн Singleton
 * существует только один экземпляр объекта во всем приложении и его дубликатов не бывает
 */
class Database {

    private static $instance = null; //статичное приватное свойство
    private $pdo, $query, $error = false, $results, $count;

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

    public function query($sql) {
        $this->error = false;
        $this->query = $this->pdo->prepare($sql);
        if (!$this->query->execute()) {
            $this->error = true;
        }else{
            $this->results = $this->query->fetchAll(PDO::FETCH_OBJ); //FETCH_OBJ потому что мы используем ООП
            $this->count = $this->query->rowCount();
        }

        return $this;
    }

    public function error() { //(getter)возвращаем ошибки в sql запросе
        return $this->error;
    }

    public function results() { //(getter)возвращаем результаты из переменной $results так как свойство private
        return $this->results;
    }

    public function count() { //(getter)возвращаем кол-во затронутых в последнем запросе записей(записей которые мы получили в последнем запросе) так как свойство private
        return $this->count;
    }








}


?>