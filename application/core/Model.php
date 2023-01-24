<?php


namespace application\core;

use application\lib\Db;

abstract class Model
{
    public $db;

    public function __construct() {

        // Создаем экземпляр класса Db
        $this->db = new Db;

    }
}