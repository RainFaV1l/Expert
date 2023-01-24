<?php


namespace application\core;

use application\core\View;
use application\controllers\CompetitionController;


abstract class Controller
{

    // Объявляем свойства
    public $route;
    public $view;
    public $acl;
    public $competition;
    public $competitionEdit;
    //public $oneCompetition;
    //public $oneCompetitionAdmin;

    // Конструктор класса

    public function __construct($route) {

        // Инициализируем $this->route
        $this->route = $route;

        if(!$this->checkAcl()) {
            View::errorCode(403);
        }

        // Вызываем метод checkAcl
        $this->checkAcl();

        // Передаем route в класс View
        $this->view = new View($route);

        // Вызываем метод before
        // $this->before();

        // Вызываем метод автозагрузки
        $this->model = $this->loadModel($route['controller']);

    }

    // Метод автозагрузки моделей
    public function loadModel($name) {

        // Путь к классу
        $path = 'application\models\\' . ucfirst($name);

        // Проверка наличия класса
        if(class_exists($path)) {
            return new $path;
        }
    }

    // Проверка роли
    public function  checkAcl() {

        // Подключаем файл
        $this->acl = require 'application/acl/' . $this->route['controller'] . '.php';

        // Проверка выполняется через функцию in_array()
        if($this->isAcl('all')) {
            return true;
        }

        else if(isset($_SESSION['user']['role']) and $_SESSION['user']['role'] == 2 and $this->isAcl('expert')) {
            return true;
        }

        else if(!isset($_SESSION['user']) and $this->isAcl('guest')) {
            return true;
        }

        else if(isset($_SESSION['user']) and $this->isAcl('authorize')) {
            return true;
        }

        else if(isset($_SESSION['user']['role']) and $_SESSION['user']['role'] == 3 and $this->isAcl('admin')) {
            return true;
        }

        else {
            return false;
        }

    }

    public function isAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}