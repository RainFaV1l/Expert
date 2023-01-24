<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;
use application\models\Competition;

class CompetitionController extends Controller
{

    public function showCompetitionCode()
    {

        // Выполняем метод вывода всех конкурсов
        $this->competition = $this->model->getCompetition();

        // Передаем значения в массив vars для дальнейшей передачи в вид через метод render
        $vars = [
            'competition' => $this->competition,
        ];

        return $vars;

    }

    public function showAction()
    {

        $vars = $this->showCompetitionCode();
        $this->view->render('Конкурсы', $vars);

    }

    public function adminAction()
    {

        $this->competitionCriterion = $this->model->getCriterionWithId($this->route['id']);

        $vars = [
            'criterion' => $this->competitionCriterion,
        ];

        $this->view->render('Участники администратора', $vars);

    }

    public function addAction()
    {

        // Проверка на наличие POST
        if (!empty($_POST)) {

            // Валидация формы и вывод ошибок
            if (!$this->model->addCompetitionValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }

            // Вывод информации об успешной отправки формы
            $this->view->location('success', 'competition');
            $this->view->message('success', 'Успешная отправка.');

        }

        $this->view->render('Добавление конкурса');

    }

    public function addCriterionAction()
    {

        // Получаем id одного конкурса
        $this->competitionAddCriterion = $this->model->getOneCompetitionById($this->route['id']);

        $vars = [
            'competition_id' => $this->competitionAddCriterion,
        ];

        $competition_id = $vars['competition_id'][0]['id'];

        //Проверка на наличие POST
        if (!empty($_POST)) {

            // Валидация формы и вывод ошибок
            if (!$this->model->addCriterionValidate($_POST, $competition_id)) {
                $this->view->message('error', $this->model->error);
            }

            // Вывод информации об успешной отправки формы
            $this->view->location('success', 'competition/'  . $competition_id . '/admin');
            $this->view->message('success', 'Успешная отправка.');

        }

        if(empty($vars['competition_id'])) View::errorCode(404);

        $this->view->render('Добавление критерия', $vars);

    }

    public function editCriterionAction() {

        // Получаем id одного конкурса
        $this->competitioneditCriterion = $this->model->getOneCompetitionById($this->route['id']);

        $vars = [
            'competition_id' => $this->competitioneditCriterion,
        ];

        $competition_id = $vars['competition_id'][0]['id'];


        //Проверка на наличие POST
        if (isset($_POST['editCriterion'])) {
            // Валидация формы и вывод ошибок
            if (!$this->model->editCriterionValidate($_POST, $competition_id)) {
                $this->view->message('error', $this->model->error);
            }

            header('location: /competition/' . $competition_id . '/admin');

            // Вывод информации об успешной отправки формы
            $this->view->location('success', 'competition/'  . $competition_id . '/admin');
            $this->view->message('success', 'Успешная отправка.');

        }

        $this->view->render('Редактирование критерия', $vars);

    }

    public function deleteCriterionAction() {

        // Выполняем метод вывода одного конкурса
        $this->competitionDeleteCriterion = $this->model->getOneCompetitionById($this->route['id']);

        $vars = [
            'competition' => $this->competitionDeleteCriterion,
        ];

        $competition_id = $vars['competition'][0]['id'];

        if(!empty($_POST)) {
            // Валидация формы и вывод ошибок
            if (!$this->model->deleteCriterionCompetition($_POST, $competition_id)) {
                $this->view->message('error', $this->model->error);
            }

            //  информации об успешной отправки формы
            $this->view->location('success', 'competition/' . $competition_id . '/admin');
            $this->view->message('success', 'Успешная отправка.');
        }

    }

    public function gradeAction()
    {
        if(isset($_POST['gradeCriterionData'])) {
//            $participant_id = $_POST['participant_id'];
            $_SESSION['participant_id'] = $_POST['participant_id'];
        }

        $this->allCriterionCountGrade = $this->model->getAllCriterion($this->route['id']);
        $this->notRatedCriterionCountGrade = $this->model->getNotRatedCriterion($this->route['id']);
        $this->ratedCriterionCountGrade = $this->model->getRatedCriterion($this->route['id']);

        if(isset($_POST['gradeNotRatedCat'])) {
            $this->allCriterionGrade = $this->model->getNotRatedCriterion($this->route['id']);
        }
        else if(isset($_POST['gradeRatedCat'])) {
            $this->allCriterionGrade = $this->model->getRatedCriterion($this->route['id']);
        }
        else {
            $this->allCriterionGrade = $this->model->getAllCriterion($this->route['id']);
        }

        $this->competitionGrade = $this->model->getOneCompetitionById($this->route['id']);
        $this->participantGrade = $this->model->getCompetitionUserByUserId($_SESSION['participant_id']);

        $vars = [
            'competition' => $this->competitionGrade[0],
            'participant' => $this->participantGrade[0],
            'criterion' => $this->allCriterionGrade[0],
            'countAll' => $this->allCriterionCountGrade[1][0],
            'countRated' => $this->ratedCriterionCountGrade[1][0],
            'countNotRated' => $this->notRatedCriterionCountGrade[1][0],
        ];

        if(isset($_POST['gradeCriterion'])) {
            // Валидация формы и вывод ошибок
            if (!$this->model->gradeCriterion($_POST)) {
                $this->view->message('error', $this->model->error);
            }
        }

        $this->view->render('Оценка конкурса', $vars);

    }

    public function oneAction()
    {

        $vars = [];

        $this->competition = $this->showCompetitionCode();

        foreach ($this->competition['competition'] as $item) {
            if($item['id'] == $this->route['id']) {
                $vars = [
                    'oneCompetition' => $item,
                ];
                break;
            }
        }

        if(!$vars) View::errorCode(404);

        $this->view->render('Страница конкурса', $vars);

    }

    public function showCompetitionByIdCode()
    {
        $vars = [];

        // Выполняем метод вывода одного конкурса
        $this->competitionEdit = $this->model->getOneCompetitionById($this->route['id']);

        // Передаем значения в массив vars для дальнейшей передачи в вид через метод render
        $vars = [
            'showCompetitionById' => $this->competitionEdit,
        ];

        if(!$vars) View::errorCode(404);

        return $vars;

    }

    public function editAction() {

        $this->competitionEdit = $this->showCompetitionByIdCode();

        $vars = [
            'oneCompetitionEdit' => $this->competitionEdit['showCompetitionById'][0],
        ];

        // Проверка на наличие POST
        if (!empty($_POST)) {

            // Валидация формы и вывод ошибок
            if (!$this->model->editCompetitionValidate($_POST, $this->competitionEdit['showCompetitionById'][0]['id'])) {
                $this->view->message('error', $this->model->error);
            }

            // Вывод информации об успешной отправки формы
            $this->view->location('success', 'competition');
            $this->view->message('success', 'Успешная отправка.');

        }

        $this->view->render('Редактирование конкурса', $vars);

    }

    public function deleteAction() {

        $this->competitionEdit = $this->showCompetitionByIdCode();

        // Выполняем удаление
        $this->model->deleteCompetition($this->competitionEdit['showCompetitionById'][0]['id']);
        $this->view->redirect('competition');

    }

    public function completeAction() {

        $this->competitionEdit = $this->showCompetitionByIdCode();

        // Выполняем удаление
        $this->model->completeCompetition($this->competitionEdit['showCompetitionById'][0]['id']);
        $this->view->redirect('competition/' . $this->route['id'] . '/admin');

    }

    public function participantsAction()
    {

        $this->competitionCriterion = $this->model->getCriterionWithId($this->route['id']);
        $this->competitionParticipants = $this->model->getParticipantsWithCompetitionById($this->route['id']);

        $vars = [
            'competitionParticipants' => $this->competitionParticipants,
            'competition_id' => $this->competitionParticipants,
            'criterion' => $this->competitionCriterion,
        ];

        $this->view->render('Участники конкурса', $vars);

    }

    public function resultAction()
    {

        $this->competitionResult = $this->model->getCompetitionResult($this->route['id']);
        if (!$this->competitionResult) : $this->view->redirect('competition/' . $this->route['id'] . '/admin'); endif;
        $this->competitionResultCount = $this->model->getCompetitionResultCount($this->route['id']);
        if (!$this->competitionResultCount) : $this->view->redirect('competition/' . $this->route['id'] . '/admin'); endif;

        $vars = [
            'competitionResult' => $this->competitionResult,
            'competitionResultCount' => $this->competitionResultCount,
        ];

        $this->view->render('Результат конкурса', $vars);

    }

    public function resultСompleteAction() {

        // Выполняем завершение конкурса
        $this->model->resultCompleteCompetition($this->route['id']);
        $this->view->redirect('competition/' . $this->route['id'] . '/result');

    }

    public function resultActiveAction() {

        // Выполняем завершение конкурса
        $this->model->resultActiveCompetition($this->route['id']);
        $this->view->redirect('competition/' . $this->route['id'] . '/admin');

    }

    public function addUserAction()
    {

        // Выполняем метод вывода одного конкурса
        $this->competitionAddUser = $this->model->getOneCompetitionById($this->route['id']);

        $vars = [
            'competition_id' => $this->competitionAddUser,
        ];

        $competition_id = $vars['competition_id'][0]['id'];

        //Проверка на наличие POST
        if (!empty($_POST)) {

            // Валидация формы и вывод ошибок
            if (!$this->model->addUsersValidate($_POST, $competition_id)) {
                $this->view->message('error', $this->model->error);
            }

            // Вывод информации об успешной отправки формы
            $this->view->location('success', 'competition/'  . $competition_id . '/participants');
            $this->view->message('success', 'Успешная отправка.');

        }

        if(empty($vars['competition_id'])) View::errorCode(404);

        $this->view->render('Участники конкурса', $vars);

    }

    public function deleteUserAction() {

        // Выполняем метод вывода одного конкурса
        $this->competitionAddUser = $this->model->getOneCompetitionById($this->route['id']);

        $vars = [
            'competition_id' => $this->competitionAddUser,
        ];

        $competition_id = $vars['competition_id'][0]['id'];

        if(!empty($_POST)) {
            // Валидация формы и вывод ошибок
            if (!$this->model->deleteUserCompetition($_POST, $competition_id)) {
                $this->view->message('error', $this->model->error);
            }

            //  информации об успешной отправки формы
            $this->view->location('success', 'competition/' . $competition_id . '/participants');
            $this->view->message('success', 'Успешная отправка.');
        }

        // $this->view->render('Участники конкурса', $vars);

    }

    public function expertsAction()
    {

        $this->competitionCriterion = $this->model->getCriterionWithId($this->route['id']);
        $this->competitionParticipants = $this->model->getParticipantsWithCompetitionByIdExperts($this->route['id']);

        $vars = [
            'competitionParticipants' => $this->competitionParticipants,
            'competition_id' => $this->competitionParticipants,
            'criterion' => $this->competitionCriterion,
        ];

        $this->view->render('Эксперты конкурса', $vars);

    }

    public function addExpertAction()
    {

        // Выполняем метод вывода одного конкурса
        $this->competitionAddUser = $this->model->getOneCompetitionById($this->route['id']);

        $vars = [
            'competition_id' => $this->competitionAddUser,
        ];

        $competition_id = $vars['competition_id'][0]['id'];

        //Проверка на наличие POST
        if (!empty($_POST)) {

            // Валидация формы и вывод ошибок
            if (!$this->model->addExpertsValidate($_POST, $competition_id)) {
                $this->view->message('error', $this->model->error);
            }

            // Вывод информации об успешной отправки формы
            $this->view->location('success', 'competition/'  . $competition_id . '/experts');
            $this->view->message('success', 'Успешная отправка.');

        }

        if(empty($vars['competition_id'])) View::errorCode(404);

        $this->view->render('Добавление эксперта', $vars);

    }

    public function deleteExpertAction() {

        // Выполняем метод вывода одного конкурса
        $this->competitionAddExpert = $this->model->getOneCompetitionById($this->route['id']);

        $vars = [
            'competition_id' => $this->competitionAddExpert,
        ];

        $competition_id = $vars['competition_id'][0]['id'];

        if(!empty($_POST)) {
            // Валидация формы и вывод ошибок
            if (!$this->model->deleteUserCompetition($_POST, $competition_id)) {
                $this->view->message('error', $this->model->error);
            }

            //  информации об успешной отправки формы
            $this->view->location('success', 'competition/' . $competition_id . '/experts');
            $this->view->message('success', 'Успешная отправка.');
        }

        // $this->view->render('Участники конкурса', $vars);

    }

}