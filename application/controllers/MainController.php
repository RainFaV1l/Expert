<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function showRoleCode() {

        // Выполняем метод вывода всех конкурсов
        $result = $this->model->getRole();

        // Передаем значения в массив vars для дальнейшей передачи в вид через метод render
        $vars = [
            'user_role' => $result,
        ];

        return $vars;

    }

    public function indexAction() {

        $vars = $this->showRoleCode();

        // Передаем значения и вызываем метод render
        $this->view->render('Система оценивания', $vars);

    }
}