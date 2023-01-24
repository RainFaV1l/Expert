<?php


namespace application\core;


class View
{

    // Объявляем путь к нашему виду
    public $path;

    // Обьявляем переменную
    public $route;

    // Объявляем шаблон
    public $layout = 'default';

    // Конструктор класса
    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    // Создаем метод Render для загрузки шаблона и вида
    public function render($title, $vars = []) {

        // extract - функция для распаковки массива по переменным
        extract($vars);

        // Выполняем проверку на существование файла
        $path = 'application/views/' . $this->path . '.php';
        if(file_exists($path)) {

            // Копируем в буфер
            ob_start();

            // Подключаем контент
            require $path;

            // Заканчиваем копирование в буфер
            $content = ob_get_clean();

            // Подключаем шаблон
            require 'application/views/layouts/' . $this->layout . '.php';

        } else {
            echo 'Вид не найден:' . $this->path . '.';
        }

    }

    // Метод для вывода ошибок
    public static function errorCode($code) {

        // Получaет или устанавливает код ответа HTTP
        http_response_code($code);

        $path = 'application/views/errors/' . $code . '.php';
        if(file_exists($path)) {
            require $path;
        }
        exit;

    }

    // Метод для перенаправления
    public function redirect($url) {

        // Перенаправление на другой адрес
        header('location: /' . $url);
        exit;

    }

    // Метод для вывода сообщений
    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    // Метод для перенаправления js
    public function location($status, $url) {
        exit(json_encode(['status' => $status, 'url' => $url]));
    }

}