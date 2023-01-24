<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getRole() {

        // Получаем название роли пользователя
        if(isset($_SESSION['user'])):

            $params = [
                'id' => $_SESSION['user']['role'],
            ];

            $user_role = $this->db->row('SELECT * FROM `user_role` WHERE `id` = :id', $params);

            return $user_role[0];

        endif;

    }
}