<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{
//    public function before() {
//        $this->view->layout = 'default';
//    }

//    public function __construct($route) {
//        parent::__construct($route);
//        $this->view->layout = 'default';
//    }

    public function loginAction() {

        // Запись для смены пути файла вида
        // $this->view->path = 'test/test';

        // Запись для смены пути файла шаблона
        // $this->view->layout = 'custom';

        // Проверка на наличие POST
        if(!empty($_POST)) {

            // Валидация формы и вывод ошибок
            if(!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }

            // Создание сессии
            $_SESSION['user'] = $this->model->loginValidate($_POST);

            if(isset($_SESSION['user'])) {
                $this->view->location('success', 'competition');
                $this->view->message('success', 'Успешний вход.');
            }

        }

        // Перенаправление авторизованного пользователя
        if(isset($_SESSION['user'])) {
            $this->view->redirect('');
        }

        // Запускаем вид
        $this->view->render('Вход');

    }

    public function logoutAction() {

        // Очищаем сессию
        unset($_SESSION['user']);
        $this->view->redirect('');

    }
}