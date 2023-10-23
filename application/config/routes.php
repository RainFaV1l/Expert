<?php

// Возвращаем названия страниц и их action
return [

    // Главный маршрут страницы
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'login' => [
        'controller' => 'account',
        'action' => 'login',
    ],

    'logout' => [
        'controller' => 'account',
        'action' => 'logout',
    ],

    'competition/{id:\d+}/participants_add' => [
        'controller' => 'competition',
        'action' => 'addUser',
    ],

    'competition/{id:\d+}/deletePartisipant'   => [
        'controller' => 'competition',
        'action' => 'deleteUser',
    ],

    'competition/{id:\d+}/deleteExpert'   => [
        'controller' => 'competition',
        'action' => 'deleteExpert',
    ],

    'competition/{id:\d+}/experts_add' => [
        'controller' => 'competition',
        'action' => 'addExpert',
    ],

    'competition/{id:\d+}/participants' => [
        'controller' => 'competition',
        'action' => 'participants',
    ],

    'competition/{id:\d+}/experts' => [
        'controller' => 'competition',
        'action' => 'experts',
    ],

    'competition' => [
        'controller' => 'competition',
        'action' => 'show',
    ],

    'competition/{id:\d+}' => [
        'controller' => 'competition',
        'action' => 'one',
    ],

    'competition/{id:\d+}/admin' => [
        'controller' => 'competition',
        'action' => 'admin',
    ],

    'competition/add' => [
        'controller' => 'competition',
        'action' => 'add',
    ],

    'competition/{id:\d+}/criterion_add' => [
        'controller' => 'competition',
        'action' => 'addCriterion',
    ],

    'competition/{id:\d+}/criterion_edit' => [
        'controller' => 'competition',
        'action' => 'editCriterion',
    ],

    'competition/{id:\d+}/criterion_delete' => [
        'controller' => 'competition',
        'action' => 'deleteCriterion',
    ],

    'competition/{id:\d+}/delete' => [
        'controller' => 'competition',
        'action' => 'delete',
    ],

    'competition/{id:\d+}/edit' => [
        'controller' => 'competition',
        'action' => 'edit',
    ],

    'competition/{id:\d+}/complete' => [
        'controller' => 'competition',
        'action' => 'complete',
    ],


    'competition/{id:\d+}/grade' => [
        'controller' => 'competition',
        'action' => 'grade',
    ],

    'competition/{id:\d+}/result' => [
        'controller' => 'competition',
        'action' => 'result',
    ],

    'competition/{id:\d+}/result/complete' => [
        'controller' => 'competition',
        'action' => 'resultСomplete',
    ],
    'competition/{id:\d+}/result/active' => [
        'controller' => 'competition',
        'action' => 'resultActive',
    ],

];
