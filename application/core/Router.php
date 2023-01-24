<?php

namespace application\core;

use application\core\View;

class Router
{
    // Свойства класса
    protected $routes = [];
    protected $params = [];

    // Конструктор класса
    public function __construct()
    {

        // Подключаем routes
        $arr = require 'application/config/routes.php';

        // Перебираем routes и передаем их в метод add
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }

    }

    // Метод добавления маршрута
    public function add($route, $params) {

        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);

        // Добавляем регулярные выражения
        $route = '#^' . $route . '$#';

        // Сохраняем регулярные выражения в массив
        $this->routes[$route] = $params;

    }

    // Метод проверки маршрута
    // Проверяет существует ли такой маршрут
    public function match() {

        // Получаем текущий url
        $url =trim($_SERVER['REQUEST_URI'], '/');

        //debug($this->routes);

        // Перебираем массив маршрутов
        foreach ($this->routes as $route => $params) {


            // preg_match — выполняет проверку на соответствие регулярному выражению

            if(preg_match($route, $url, $matches)) {

                foreach ($matches as $key => $match) {

                    if (is_string($key)) {

                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }

                        $params[$key] = $match;


                    }

                }
                $this->params = $params;

                return true;

            }
        }

        // Если не выполнилась условие возвращаем false
        return false;

    }

    // Метод для запуска роутера
    public function run() {

        // Проверяем найден ли маршрут
        // ucfirst делает первый символ строки заглавным
        if($this->match()) {

            $path = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';

            // Проверка на существование класса
            if(class_exists($path)) {

                // Проверка на метод
                $action = $this->params['action'] . 'Action';

                // Проверка на существование метода
                if(method_exists($path, $action)) {

                    // Создаем экземпляр контроллера
                    $controller = new $path($this->params);

                    // Вызываем метод
                    $controller -> $action();

                } else {

                    // echo $action . ' не найден.';
                    View::errorCode(404);

                }

            } else {

                // echo $path . ' не найден.';
                View::errorCode(404);

            }

        } else {

            // echo 'Маршрут не найден.';
            View::errorCode(404);

        }

    }
}