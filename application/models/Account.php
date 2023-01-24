<?php

namespace application\models;

use application\core\Model;

class Account extends Model
{

    public $error;

    public function loginValidate($post) {

        // Сохраняем данные в переменную
        $email = $post['email'];
        $password = $post['password'];

        // Проверяем введенные данные
        if(empty($email) or empty($password)) {
            $this->error = 'Заполните пустые поля.';
            return false;
        }

        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Введите корректный email.';
            return false;
        }

        $params = [
            'email' => $email,
        ];

        $result = $this->db->row('SELECT `id`, `password` FROM `users` WHERE `email` = :email', $params);

        if(!$result) {
            $this->error = 'Пользователя с данным email не существует.';
            return false;
        }

        if(!password_verify($password, $result[0]['password'])) {
            $this->error = 'Неверный логин или пароль.';
            return false;
        }

        $params = [
            'id' => $result[0]['id'],
        ];

        $user = $this->db->row('SELECT `id`, `email`, `name`, `surname`, `patronymic`, `role`, `pautina_id` FROM `users` WHERE `id` = :id', $params);

        return $user[0];

    }

}