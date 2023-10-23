<?php

namespace application\models;

use application\core\Model;
use application\core\View;

class Competition extends Model
{

    // Объявление свойства для вывода ошибок
    public $error;

    // Вывод конкурсов
    public function getCompetition()
    {

        if (isset($_SESSION['user'])) :

            if ($_SESSION['user']['role'] === 1) :

                // Находим конкурсы, в которых участвует данный пользователь
                $params = [
                    'user_id' => $_SESSION['user']['id'],
                ];

                // Выполняем JOIN и выводим информацию о конкурсах данного пользователя
                $result = $this->db->row('SELECT * FROM `users_competition` JOIN `competition` 
                ON users_competition.competition_id = competition.id WHERE `user_id` = :user_id', $params);

                return $result;

            endif;

            if ($_SESSION['user']['role'] === 2) :

                // Находим конкурсы, в которых судит данный эксперт
                $params = [
                    'user_id' => $_SESSION['user']['id'],
                    'user_role' => $_SESSION['user']['role'],
                ];

                // Выполняем JOIN и выводим информацию о конкурсах данного пользователя
                $result = $this->db->row('SELECT * FROM `users_competition` JOIN `competition` 
                ON users_competition.competition_id = competition.id WHERE `user_id` = :user_id AND `user_role` = :user_role', $params);

                return $result;

            endif;

            if ($_SESSION['user']['role'] === 3) :

                // Вывод всех конкурсов
                $result = $this->db->row('SELECT * FROM `competition`');

                return $result;

            endif;

        endif;
    }

    // Вывод одного конкурса
    public function getOneCompetitionById($id)
    {

        $params = [
            'id' => $id,
        ];

        $result = $this->db->row('SELECT * FROM `competition` WHERE `id` = :id', $params);

        //        if(empty($result)) {
        //            View::errorCode(404);
        //        }

        return $result;
    }

    // Вывод критериев
    public function getCriterionByCompetition($id)
    {

        $params = [
            'id' => $id,
        ];

        $result = $this->db->row('SELECT * FROM `evaluation_criterion` WHERE `id` = :id', $params);

        return $result;
    }

    // Вывод пользователя по id
    public function getCompetitionUserByUserId($id)
    {

        $params = [
            'id' => $id,
        ];

        $result = $this->db->row('SELECT * FROM `users` WHERE `id` = :id', $params);

        //        if(empty($result)) {
        //            View::errorCode(404);
        //        }

        return $result;
    }

    public function getAllCriterion($competition_id)
    {

        $params = [
            'id' => $competition_id,
        ];

        $result = $this->db->row('SELECT * FROM `evaluation_criterion` WHERE `competition_id` = :id', $params);
        $count = $this->db->row('SELECT COUNT(id) as count FROM `evaluation_criterion` WHERE `competition_id` = :id', $params);

        return [$result, $count];
    }

    public function getRatedCriterion($competition_id)
    {

        if (isset($_SESSION['user']) and $_SESSION['user']['role'] == 2) {
            $expert_id = $_SESSION['user']['id'];
        }

        $params = [
            'id' => $competition_id,
            'expert_id' => $expert_id,
        ];

        $result = $this->db->row('SELECT * FROM `evaluation_criterion` WHERE `id` 
        IN (SELECT evaluation_criterion_id FROM `grade` WHERE `competition_id` = :id AND `expert_id` = :expert_id) AND `competition_id` = :id', $params);
        $count = $this->db->row('SELECT COUNT(id) as count FROM `evaluation_criterion` WHERE `id` 
        IN (SELECT evaluation_criterion_id FROM `grade` WHERE `competition_id` = :id AND `expert_id` = :expert_id) AND `competition_id` = :id', $params);

        return [$result, $count];
    }

    public function getNotRatedCriterion($competition_id)
    {

        if (isset($_SESSION['user']) and $_SESSION['user']['role'] == 2) {
            $expert_id = $_SESSION['user']['id'];
        }

        $params = [
            'id' => $competition_id,
            'expert_id' => $expert_id,
        ];

        $result = $this->db->row('SELECT * FROM `evaluation_criterion` WHERE `id` 
        NOT IN (SELECT evaluation_criterion_id FROM `grade` WHERE `competition_id` = :id AND `expert_id` = :expert_id) AND `competition_id` = :id', $params);
        $count = $this->db->row('SELECT COUNT(id) as count FROM `evaluation_criterion` WHERE `id` 
        NOT IN (SELECT evaluation_criterion_id FROM `grade` WHERE `competition_id` = :id AND `expert_id` = :expert_id) AND `competition_id` = :id', $params);

        return [$result, $count];
    }

    // Вывод одного конкурса
    public function getParticipantsWithCompetitionById($id)
    {

        $params = [
            'id' => $id,
            'role' => 1,
        ];

        $result = $this->db->row('SELECT * FROM `users_competition` JOIN `users` ON users_competition.user_id = users.id WHERE users_competition.competition_id = :id AND users_competition.user_role = :role', $params);

        if (empty($result)) :

            $params = [
                'id' => $id,
            ];

            $result = $this->db->row('SELECT * FROM `competition` WHERE `id` = :id', $params);

            if (empty($result)) {
                View::errorCode(404);
            }

        endif;

        return $result;
    }

    // Вывод одного конкурса
    public function getParticipantsWithCompetitionByIdExperts($id)
    {

        $params = [
            'id' => $id,
            'expert' => 2,
        ];

        $result = $this->db->row('SELECT * FROM `users_competition` JOIN `users` ON users_competition.user_id = users.id WHERE users_competition.competition_id = :id AND users_competition.user_role = :expert', $params);

        if (empty($result)) :

            $params = [
                'id' => $id,
            ];

            $result = $this->db->row('SELECT * FROM `competition` WHERE `id` = :id', $params);

            if (empty($result)) {
                View::errorCode(404);
            }

        endif;

        return $result;
    }

    // Вывод участников конкурса
    public function getParticipant($id)
    {
        if (isset($_SESSION['user'])) :

            if ($_SESSION['user']['role'] > 1) :

                // Вывод всех участников данного конкурсов
                $params = [
                    'id' => $id,
                    'role' => 1
                ];

                $result = $this->db->row('SELECT competition_id as competition_id, user_id as user_id, users.name as user_name, 
                users.surname as user_surname, users.patronymic as user_patronymic
                FROM `users_competition`
                JOIN `users` ON users_competition.user_id = users.id JOIN competition ON users_competition.competition_id = competition.id 
                WHERE `competition_id` = :id AND `user_role` = :role AND competition.status = 1', $params);

                return $result;

            endif;

        endif;
    }


    public function resultActiveCompetition($competition_id)
    {
        $params = [
            'status' => 1,
            'id' => $competition_id,
        ];
        $sql = 'UPDATE `competition` SET `status` = :status WHERE `competition`.`id` = :id';
        $query = $this->db->update($sql, $params);
    }

    public function resultCompleteCompetition($competition_id)
    {

        $params = [
            'id' => $competition_id,
            'role' => 2,
        ];
        $sql = 'SELECT id, user_id FROM `users_competition` WHERE `competition_id` = :id AND `user_role` = :role';
        $experts = $this->db->row($sql, $params);

        foreach ($experts as $expert) {

            $params = [
                'id' => $competition_id,
            ];

            $sql = 'SELECT * FROM `evaluation_criterion` WHERE `competition_id` = :id';
            $criterions = $this->db->row($sql, $params);

            foreach ($criterions as $criterion) {

                $params = [
                    'competition_id' => $competition_id,
                    'expert_id' => $expert['user_id'],
                    'criterion_id' => $criterion['id']
                ];

                $sql = 'SELECT DISTINCT evaluation_criterion.id, grade.expert_id, grade.evaluation_criterion_id FROM evaluation_criterion 
                JOIN grade ON evaluation_criterion.id = grade.evaluation_criterion_id 
                WHERE evaluation_criterion.competition_id = :competition_id AND `expert_id` = :expert_id AND grade.evaluation_criterion_id = :criterion_id';
                $check = $this->db->row($sql, $params);
                if (!count($check) >= 1) {
                    $params = [
                        'id' => $expert['user_id'],
                    ];
                    $sql = 'SELECT * FROM `users` WHERE `id` = :id';
                    $expert_info = $this->db->row($sql, $params)[0];
                    $_SESSION['error'][] = 'Эксперт с ' . 'id: ' . $expert['user_id'] . ' - ' . $expert_info['surname'] . ' ' . $expert_info['name']
                        . ' ' . $expert_info['patronymic'] . ' не закончил оценку конкурса.<br>';
                    break;
                }
            }
        }
        if (!isset($_SESSION['error'])) {
            $params = [
                'status' => 2,
                'id' => $competition_id,
            ];
            $sql = 'UPDATE `competition` SET `status` = :status WHERE `competition`.`id` = :id';
            $query = $this->db->update($sql, $params);
        }
    }

    // Оценка конкурса экспертом
    public function gradeCriterion($post)
    {

        if (!$post) return false;

        // Сохраняем данные в переменные
        $type_id = $post['type_id'];
        $criterion_id = $post['criterion_id'];
        $competition_id = $post['competition_id'];
        $participant_id = $post['participant_id'];
        if (isset($post['yes-no'])) :
            $type = $post['yes-no'];
        else :
            $_SESSION['error'] = 'Выберите ответ';
            header('Location: /competition/' . $competition_id . '/grade');
        endif;

        // Проверяем введенные данные
        if (empty($criterion_id or $competition_id or $participant_id)) : View::errorCode(404);
        else :
            $params = ['criterion_id' => $criterion_id];
            $sql = 'SELECT * FROM `evaluation_criterion` WHERE `id` = :criterion_id';
            $result = $this->db->row($sql, $params);

            $criterionScore = $result[0]['score'];

            switch ($type):
                case 1:
                    $score = 0;
                    break;
                case 2:
                    $score = $criterionScore / 2;
                    break;
                case 3:
                    $score = $criterionScore;
                    break;
            endswitch;

            if ($type_id == 2) :
                if ($type == 1) :
                    $type = 3;
                elseif ($type == 2) :
                    $type = 4;
                elseif ($type == 5) :
                    $type = 4;
                endif;
            endif;

            $sql = "INSERT INTO `grade` (`id`, `user_id`, `competition_id`, `evaluation_criterion_id`, `answer_id`, 
            `expert_id`, `score`, `created_at`, `updated_at`) 
            VALUES (NULL, $participant_id, '$competition_id', $criterion_id, '$type', {$_SESSION['user']['id']}, $score, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
            $query = $this->db->send($sql);
        endif;

        header('Location: /competition/' . $competition_id . '/grade');
    }

    // Добавление конкурсов
    public function addCompetitionValidate($post)
    {

        // Сохраняем данные в переменные
        $name = $post['name'];
        $description = $post['description'];
        $date_beginning = $post['date_beginning'];
        $expiration_date = $post['expiration_date'];
        $path = 'public/images/' . time() . $_FILES['img']['name'];

        // Проверяем введенные данные
        if (empty($name) or empty($description) or empty($date_beginning) or empty($expiration_date) or empty($_FILES['img']['size'])) :
            $this->error = 'Заполните пустые поля.';
            return false;

        elseif (!move_uploaded_file($_FILES['img']['tmp_name'], $path)) :
            $this->error = 'Не удалось загрузить файл';
            return false;
        endif;

        $user = $this->db->send("INSERT INTO `competition` (`id`, `name`, `description`, `date_beginning`, `expiration_date`, `status`, `path`) 
        VALUES (NULL, '$name', '$description', '$date_beginning', '$expiration_date', '1', '$path')");

        return true;
    }

    // Редактирование конкурсов
    public function editCompetitionValidate($post, $id)
    {

        // Сохраняем данные в переменные
        $name = $post['name'];
        $description = $post['description'];
        $date_beginning = $post['date_beginning'];
        $expiration_date = $post['expiration_date'];
        $path = 'public/images/' . time() . $_FILES['img']['name'];
        $params = [
            'id' => $id,
        ];

        // Проверяем введенные данные
        if (empty($name) or empty($description) or empty($date_beginning) or empty($expiration_date)) :
            $this->error = 'Заполните пустые поля.';
            return false;

        elseif (empty($_FILES['img']['name'])) :
            $user = $this->db->update("UPDATE `competition` SET `name` = '$name', `description` = '$description', `date_beginning` = '$date_beginning', `expiration_date` = '$expiration_date' WHERE `competition`.`id` = :id", $params);
            return true;

        elseif (!move_uploaded_file($_FILES['img']['tmp_name'], $path)) :
            $this->error = 'Не удалось загрузить файл';
            return false;
        endif;

        $user = $this->db->update("UPDATE `competition` SET `name` = '$name', `description` = '$description', `date_beginning` = '$date_beginning', `expiration_date` = '$expiration_date', `path` = '$path' WHERE `competition`.`id` = :id", $params);

        return true;
    }

    // Метод удаления конкурса
    public function deleteCompetition($id)
    {

        $params = [
            'id' => $id,
        ];

        $user = $this->db->delete("DELETE FROM `competition` WHERE `competition`.`id` = :id", $params);

        return true;
    }

    // Добавление участников
    public function addUsersValidate($post, $competition_id)
    {

        // Сохраняем данные в переменные
        $user_id = $post['user_id'];

        // Проверяем введенные данные
        if (strlen($user_id) === 0) :
            $this->error = 'Заполните пустое поле.';
            return false;

        elseif ($user_id == 0) :
            $this->error = 'Заполните пустое поле.';
            return false;
        endif;

        $user = $this->db->send("INSERT INTO `users_competition` (`id`, `competition_id`, `user_id`, `user_role`) VALUES (NULL, '$competition_id', '$user_id', 1)");

        return true;
    }

    // Добавление критерия
    public function addCriterionValidate($post, $competition_id)
    {

        // Сохраняем данные в переменные
        $name = $post['name'];
        $score = $post['score'];
        if (isset($post['type'])) $type = $post['type'];

        // Проверяем введенные данные
        if (empty($name)) :
            $this->error = 'Заполните название.';
            return false;

        elseif (empty($score)) :
            $this->error = 'Заполните количество баллов.';
            return false;

        elseif (!is_numeric($score)) :
            $this->error = 'Введите число.';
            return false;

        elseif (empty($type)) :
            $this->error = 'Выберите тип.';
            return false;
        endif;

        $sql = "INSERT INTO `evaluation_criterion` (`id`, `name`, `score`, `competition_id`, `type_id`) VALUES (NULL, '$name', $score, $competition_id, $type)";

        $user = $this->db->send($sql);

        return true;
    }

    // Редактирование критерия
    public function editCriterionValidate($post, $competition_id)
    {

        // Сохраняем данные в переменные
        $criterion_id = $post['criterion_id'];
        $name = $post['name'];
        $score = $post['score'];
        if (isset($post['type'])) $type = $post['type'];

        // Проверяем введенные данные
        if (empty($criterion_id)) :
            View::errorCode(404);
            return false;

        elseif (empty($name)) :
            //            $this->error = 'Заполните название.';
            header('location: /competition/' . $competition_id . '/admin');
            return false;

        elseif (empty($score)) :
            //            $this->error = 'Заполните количество баллов.';
            header('location: /competition/' . $competition_id . '/admin');
            return false;

        elseif (!is_numeric($score)) :
            //            $this->error = 'Введите число.';
            header('location: /competition/' . $competition_id . '/admin');
            return false;

        elseif (empty($type)) :
            //            $this->error = 'Выберите тип.';
            header('location: /competition/' . $competition_id . '/admin');
            return false;
        endif;

        $params = [
            'id' => $criterion_id,
        ];


        $sql = "UPDATE `evaluation_criterion` SET `name` = '$name', `score` = $score, `type_id` = $type WHERE `id` = :id";

        $user = $this->db->update($sql, $params);

        return true;
    }

    // Добавление участников
    public function addExpertsValidate($post, $competition_id)
    {

        // Сохраняем данные в переменные
        $user_id = $post['expert_id'];

        // Проверяем введенные данные
        if (strlen($user_id) === 0) :
            $this->error = 'Заполните пустое поле.';
            return false;

        elseif ($user_id == 0) :
            $this->error = 'Заполните пустое поле.';
            return false;
        endif;

        $user = $this->db->send("INSERT INTO `users_competition` (`id`, `competition_id`, `user_id`, `user_role`) VALUES (NULL, '$competition_id', '$user_id', 2)");

        return true;
    }

    // Метод завершения конкурса
    public function completeCompetition($id)
    {

        $params = [
            'id' => $id,
        ];

        $user = $this->db->update("UPDATE `competition` SET `status` = '0' WHERE `competition`.`id` = :id", $params);

        return true;
    }

    // Метод вывода результата
    public function getCompetitionResult($id)
    {

        $params = [
            'id' => $id,
        ];

        // Получаем информацию
        $sql = 'SELECT * FROM `grade` WHERE `competition_id` = :id';
        $result = $this->db->row($sql, $params);

        return $result;
    }

    // Метод вывода результата и количества
    public function getCompetitionResultCount($id)
    {

        $params = [
            'id' => $id,
        ];

        // Получаем информацию
        //        $sql = "SELECT grade.user_id, competition.id as competition_id, competition.name as competition_name, competition_status.name as competition_status_name, GROUP_CONCAT(evaluation_criterion.name SEPARATOR ', ') as evaluation_criterion_names, GROUP_CONCAT(grade.score SEPARATOR ', ') as score,
        //        GROUP_CONCAT(answer.name SEPARATOR ', ') as answer_names, GROUP_CONCAT(grade.expert_id SEPARATOR ', ') as expert_id, SUM(grade.score) as sum_score FROM `grade`
        //        JOIN `evaluation_criterion` ON grade.evaluation_criterion_id = evaluation_criterion.id JOIN `answer` ON grade.answer_id = answer.id
        //        JOIN competition ON grade.competition_id = competition.id JOIN competition_status ON competition.status = competition_status.id WHERE grade.competition_id = :id GROUP BY grade.user_id";

        $sql = "SELECT grade.user_id, competition.id as competition_id, competition.name as competition_name, competition_status.name as competition_status_name, GROUP_CONCAT(evaluation_criterion.name SEPARATOR ', ') as evaluation_criterion_names, GROUP_CONCAT(grade.score SEPARATOR ', ') as score,
        GROUP_CONCAT(answer.name SEPARATOR ', ') as answer_names, SUM(grade.score) as sum_score, @row_num:=@row_num+1 as 'num' FROM `grade` 
        JOIN `evaluation_criterion` ON grade.evaluation_criterion_id = evaluation_criterion.id JOIN `answer` ON grade.answer_id = answer.id 
        JOIN competition ON grade.competition_id = competition.id JOIN competition_status ON competition.status = competition_status.id JOIN (SELECT @row_num := 0 FROM DUAL) as sub WHERE grade.competition_id = :id GROUP BY grade.user_id ORDER BY SUM(grade.score) DESC";

        $result = $this->db->row($sql, $params);

        // Сложные sql запросы
        //SELECT user_id, competition_id, GROUP_CONCAT(evaluation_criterion_id) as evaluation_criterion_id, GROUP_CONCAT(answer_id) as answer_id, expert_id, SUM(score) as sum_score FROM `grade` GROUP BY user_id

        //SELECT grade.user_id, competition.name as competition_name, competition.status as competition_status, GROUP_CONCAT(evaluation_criterion.name SEPARATOR ', ') as evaluation_criterion_names,
        //GROUP_CONCAT(answer.name SEPARATOR ', ') as answer_names, expert_id, SUM(grade.score) as sum_score FROM `grade`
        //JOIN `evaluation_criterion` ON grade.evaluation_criterion_id = evaluation_criterion.id JOIN `answer` ON grade.answer_id = answer.id
        //JOIN competition ON grade.competition_id = competition.id WHERE grade.competition_id = :id GROUP BY grade.user_id

        return $result;
    }

    // Метод удаления участника из конкурса
    public function deleteUserCompetition($post, $id)
    {

        $participant_id = $post['participant_id'];

        // Проверяем введенные данные
        if (empty($participant_id)) {
            $this->error = 'Заполните пустые поля.';
            return false;
        }

        $params = [
            'competition_id' => $id,
            'participatn_id' => $participant_id,
        ];

        $user = $this->db->delete("DELETE FROM `users_competition` WHERE `user_id` = :participatn_id AND `competition_id` = :competition_id", $params);

        return true;
    }

    // Метод удаления критериев из конкурса
    public function deleteCriterionCompetition($post, $id)
    {

        $criterion_id = $post['criterion_id'];

        // Проверяем введенные данные
        if (empty($criterion_id)) {
            $this->error = 'Заполните пустые поля.';
            return false;
        }

        $params = [
            'id' => $criterion_id,
        ];

        $user = $this->db->delete("DELETE FROM evaluation_criterion WHERE `evaluation_criterion`.`id` = :id", $params);

        return true;
    }

    // Метод удаления экспертов из конкурса
    public function deleteExpertCompetition($post, $id)
    {

        $expert_id = $post['expert_id'];

        // Проверяем введенные данные
        if (empty($expert_id)) {
            $this->error = 'Заполните пустые поля.';
            return false;
        }

        $params = [
            'competition_id' => $id,
            'expert_id' => $expert_id,
        ];

        $user = $this->db->delete("DELETE FROM `users_competition` WHERE `user_id` = :expert_id AND `competition_id` = :competition_id", $params);

        return true;
    }

    // Вывод одного конкурса и вывод критериев
    public function getCriterionWithId($id)
    {

        $params = [
            'id' => $id,
        ];

        $result = $this->db->row('SELECT competition.id as competition_id, competition.name as competition_name, competition.description as competition_description, 
        competition.date_beginning as competition_date_beginning, competition.expiration_date as competition_expiration_date, competition.status as competition_status, 
        competition.path as competition_path, evaluation_criterion.id as criterion_id, evaluation_criterion.name as criterion_name, evaluation_criterion.score as criterion_score, 
        evaluation_criterion.type_id as criterion_type_id
        FROM `evaluation_criterion` JOIN `competition` ON evaluation_criterion.competition_id = competition.id WHERE competition.id = :id', $params);


        if (empty($result)) :

            $params = [
                'id' => $id,
            ];
            $result = $this->db->row('SELECT competition.id as competition_id, competition.name as competition_name, competition.description as competition_description, 
            competition.date_beginning as competition_date_beginning, competition.expiration_date as competition_expiration_date, competition.status as competition_status, 
            competition.path as competition_path FROM `competition` WHERE competition.id = :id', $params);

            if (empty($result)) {
                View::errorCode(404);
            }

        endif;

        return $result;
    }
}
