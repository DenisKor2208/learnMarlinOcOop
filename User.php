<?php

class User { //для регистрации пользователя
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create($fields = []) {
        $this->db->insert('users', $fields);
    }
}