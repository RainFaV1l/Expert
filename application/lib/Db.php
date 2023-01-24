<?php

namespace application\lib;
use PDO;

class Db
{
    protected $db;

    // Данный метод автоматически выполнится, т.к является конструктором
    public function __construct()
    {
        $config = require 'application/config/db.php';

        // Подключение к БД
        try {
            $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
            $option = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            $this->db = new \PDO($dsn, $config['username'], $config['password'], $option);
        } catch (\PDOException $exceptione) {
            echo 'Ошибка при подключении к базе данных: ' . $exceptione->getMessage();
        }

    }

    // Методы для выполнения запроса
    public function query($sql, $params = []) {

        // Подгатавливаем запрос
        $stmt = $this->db->prepare($sql);

        // Выполняем проверку
        if(!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key , $val);
            }
        }

        $stmt->execute();

        // Возвращаем результат
        return $stmt;
    }

    // Методы для возвращения списка столбцов
    public function row($sql, $params = []) {

        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);

    }

    // Методы для возвращения списка столбца
    public function column($sql, $params = []) {

        $result = $this->query($sql, $params);
        return $result->fetchColumn(PDO::FETCH_COLUMN);

    }

    // Методы для записи данных в таблицу
    public function send($sql) {

        $result = $this->db->query($sql);
        return true;

    }

    // Методы для обновления данных в таблице
    public function update($sql, $params = []) {

        $result = $this->query($sql, $params);
        return true;

    }

    // Методы для удаления данных в таблице
    public function delete($sql, $params = []) {

        $result = $this->query($sql, $params);
        return true;

    }

}