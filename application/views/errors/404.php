<?php
// Шаблон страниц
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/styles/style.css">
    <link href="https://allfont.ru/allfont.css?fonts=pragmatica" rel="stylesheet" type="text/css" />
    <script src="../../public/scripts/burger.js" defer></script>
    <link rel="shortcut icon" href="../../public/images/logo.png" type="image/png">
    <title>
        <?php
            echo 404;
        ?>
    </title>
</head>
<body>
<div class="burger-block">
    <div class="burger__inner">
        <div class="close">
            X
        </div>
        <?php
            if(isset($_SESSION['user'])): ?>
                <a href="/logout" class="btn__burger">Выход</a>
            <?php else: ?>
                <a href="/login" class="btn__burger">Авторизоваться</a>
            <?php endif;
        ?>
    </div>
</div>
<!-- header -->
<header class="header">
    <div class="header__inner">
        <a href="/" class="logo logo__header">
            Система оценивания
        </a>
        <?php
            if(isset($_SESSION['user'])): ?>
                <a href="/logout" class="btn__header">Выход</a>
            <?php else: ?>
                <a href="/login" class="btn__header">Авторизоваться</a>
            <?php endif;
        ?>
        <div class="burger">
            <img src="../../public/images/burger.png" alt="burger">
        </div>
    </div>
</header>

<!-- Контент -->
<main class="error404">
    <h1>Ошибка 404</h1>
    <p>Данная страница не существует.</p>
    <a href="/" class="btn__error">На главную</a>
</main>

<!-- footer -->
<footer class="footer">
    <div class="footer__inner">
        <a href="/" class="logo logo__footer">
            Система оценивания
        </a>
        <a href="#" class="btn__footer">Поддержка телеграмм</a>
        <a href="#" class="btn__footer">admin@hostclub.online</a>
    </div>
</footer>
</body>
</html>