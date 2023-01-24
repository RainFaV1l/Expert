<?php

//    Вывод массива с информацией о пользователе
//    if(isset($_SESSION['user']))
//    debug($_SESSION['user']);

// Перебираем массив
if(isset($_SESSION['user'])):
    foreach ($user_role as $value);
endif;

?>
<div class="start">
    <div class="start__container">
        <div class="start__content">
            <h1 class="start__title">Добро пожаловать в систему оценивания.</h1>
            <?php
                if(isset($_SESSION['user'])): ?>
                    <p class="start__text">Добро пожаловать, <?php echo $value; ?>!</p>
                    <p class="start__text">Вы попали на страницу системы оценивания конкурсов клуба веб-мастеров Паутина.</p>
                    <a href="/logout" class="start__button btn">Выход</a>
                <?php else: ?>
                    <p class="start__text">Вы попали на страницу системы оценивания конкурсов клуба веб-мастеров Паутина. Для продолжения работы необходимо авторизоваться.</p>
                    <a href="/login" class="start__button btn">Войти</a>
                <?php endif;
            ?>
        </div>
    </div>
</div>