<?php

// Включение вывода ошибок (если отключены)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Для просмотра данных массива
function debug($str) {
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
}