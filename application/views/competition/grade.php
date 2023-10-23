<!-- ocenka -->
<div class="ocenka">
    <div class="fio-user"><?php echo $participant['surname'] . ' ' . $participant['name'] . ' ' .  $participant['patronymic'] . ' #' . $participant['id'] ?> </div>
    <div class="block-progressbar">
        <div class="row__block-progressbar">
            <div class="name-progressbar">Прогресс проверки</div>
            <div class="procent-progressbar"></div>
        </div>
        <div class="progressbar">
            <div class="progressbar-inner"></div>
        </div>
    </div>
    <div class="row__ocenka">
        <div class="filter__ocenka">
            <div class="name-filter">Фильтр:</div>
            <div class="categorys-kritery">
                <?php
                if (isset($_POST['gradeNotRatedCat'])) { ?>
                    <a href="/competition/<?php echo $competition['id'] ?>/grade" class="cat-critery">
                        Все <span class="count-kritery">(<?php echo $countAll['count'] ?>)</span>
                    </a>
                    <form method="post" action="/competition/<?php echo $competition['id'] ?>/grade" name="gradeNotRatedCat" class="deleteParticipants">
                        <input type="text" class="hidden__input" name="participant_id" value="<?php echo $competition['id'] ?>">
                        <input type="text" class="hidden__input" name="cat_id" value="<?php echo $competition['id'] ?>">
                        <button type="submit" class="cat-critery cat-critery_active" name="gradeNotRatedCat">Неоцененные <span class="count-kritery">(<?php echo $countNotRated['count'] ?>)</span></button>
                    </form>
                    <form method="post" action="/competition/<?php echo $competition['id'] ?>/grade" name="gradeRatedCat" class="deleteParticipants">
                        <input type="text" class="hidden__input" name="participant_id" value="<?php echo $competition['id'] ?>">
                        <input type="text" class="hidden__input" name="cat_id" value="<?php echo $competition['id'] ?>">
                        <button type="submit" class="cat-critery" name="gradeRatedCat">Оцененные <span class="count-kritery">(<?php echo $countRated['count'] ?>)</span></button>
                    </form>
                <?php } else if (isset($_POST['gradeRatedCat'])) { ?>
                    <a href="/competition/<?php echo $competition['id'] ?>/grade" class="cat-critery">
                        Все <span class="count-kritery">(<?php echo $countAll['count'] ?>)</span>
                    </a>
                    <form method="post" action="/competition/<?php echo $competition['id'] ?>/grade" name="gradeNotRatedCat" class="deleteParticipants">
                        <input type="text" class="hidden__input" name="participant_id" value="<?php echo $competition['id'] ?>">
                        <input type="text" class="hidden__input" name="cat_id" value="<?php echo $competition['id'] ?>">
                        <button type="submit" class="cat-critery" name="gradeNotRatedCat">Неоцененные <span class="count-kritery">(<?php echo $countNotRated['count'] ?>)</span></button>
                    </form>
                    <form method="post" action="/competition/<?php echo $competition['id'] ?>/grade" name="gradeRatedCat" class="deleteParticipants">
                        <input type="text" class="hidden__input" name="participant_id" value="<?php echo $competition['id'] ?>">
                        <input type="text" class="hidden__input" name="cat_id" value="<?php echo $competition['id'] ?>">
                        <button type="submit" class="cat-critery cat-critery_active" name="gradeRatedCat">Оцененные <span class="count-kritery">(<?php echo $countRated['count'] ?>)</span></button>
                    </form>
                <?php } else { ?>
                    <a href="/competition/<?php echo $competition['id'] ?>/grade" class="cat-critery cat-critery_active">
                        Все <span class="count-kritery">(<?php echo $countAll['count'] ?>)</span>
                    </a>
                    <form method="post" action="/competition/<?php echo $competition['id'] ?>/grade" name="gradeNotRatedCat" class="deleteParticipants">
                        <input type="text" class="hidden__input" name="participant_id" value="<?php echo $competition['id'] ?>">
                        <input type="text" class="hidden__input" name="cat_id" value="<?php echo $competition['id'] ?>">
                        <button type="submit" class="cat-critery" name="gradeNotRatedCat">Неоцененные <span class="count-kritery">(<?php echo $countNotRated['count'] ?>)</span></button>
                    </form>
                    <form method="post" action="/competition/<?php echo $competition['id'] ?>/grade" name="gradeRatedCat" class="deleteParticipants">
                        <input type="text" class="hidden__input" name="participant_id" value="<?php echo $competition['id'] ?>">
                        <input type="text" class="hidden__input" name="cat_id" value="<?php echo $competition['id'] ?>">
                        <button type="submit" class="cat-critery" name="gradeRatedCat">Оцененные <span class="count-kritery">(<?php echo $countRated['count'] ?>)</span></button>
                    </form>
                <?php }
                ?>
            </div>
        </div>
        <!--        <a href="#" class="btn-row__ocenka"> Завершить работу </a>-->
    </div>
    <div class="kriterys">
        <h1 class="zag-kriterys">Критерии:</h1>
        <?php
        if (isset($_SESSION['error'])) {
        ?><p class="session__error"><?php echo $_SESSION['error'];
                                    unset($_SESSION['error']) ?></p> <?php
                                                                    }
                                                                    foreach ($criterion as $value) { ?>
            <?php

                                                                        if (isset($_SESSION['user']) and $_SESSION['user']['role'] == 2) {
                                                                            $expert_id = $_SESSION['user']['id'];
                                                                        }

                                                                        // Создаем экземпляр подключения к бд
                                                                        $db = new \application\lib\Db();

                                                                        // Проверяем оценен ли данный критерий
                                                                        $params = [
                                                                            'evaluation_criterion_id' => $value['id'],
                                                                            'participant_id' => $participant['id'],
                                                                            'expert_id' => $expert_id,
                                                                        ];
                                                                        $sql = 'SELECT * FROM `grade` WHERE `evaluation_criterion_id` = :evaluation_criterion_id AND `user_id` = :participant_id AND `expert_id` = :expert_id';
                                                                        $result = $db->row($sql, $params);
                                                                        if ($result) $result = $result[0];

            ?>
            <div class="block__kriterys">
                <div class="kritery">
                    <p class="text-kritery"><?php echo $value['name'] ?></p>
                    <div class="row__kritery">
                        <p class="text-row__kritery">
                            <?php
                                                                        if ($result) : echo 'Ваша оценка: ' ?><span class="count__points"><?php echo $result['score'] ?></span> баллов<?php
                                                                                                                                                                                    else : ?><span class="count__points"><?php echo $value['score'] ?></span> баллов<?php
                                                                                                                                                                                                                                                                endif;
                                                                                                                                                                                                                                                                    ?>
                        </p>
                    </div>
                </div>
                <div class="ocenka-kritery">
                    <?php
                                                                        if ($result) :
                                                                            echo '<p class="name__ocenka-kritery name__ocenka-kritery_active">Данный критерий уже оценен</p>';
                                                                        else :
                                                                            echo '<p class="name__ocenka-kritery">Выберите один из нескольких вариантов ответа:</p>';
                                                                        endif;
                    ?>
                    <form name="gradeCriterion" method="post" action="/competition/<?php echo $competition['id'] ?>/result" class="gradeFetch">
                        <?php

                                                                        if ($result) :
                        ?>
                            <div class="row__radio">
                                <p class="radio-pole">
                                    <?php
                                                                            //                                                echo 'Ваш ответ:'
                                    ?>
                                    <!--                                            <input-->
                                    <!--                                            class="inp__yes-no"-->
                                    <!--                                            type="radio"-->
                                    <!--                                            name="yes-no"-->
                                    <!--                                            id="radio"-->
                                    <!--                                            checked-->
                                    <!--                                            />-->
                                    <label for="radio"></label>
                                    <?php
                                                                            // Выводим выбранный экспертом ответ
                                                                            //                                                $params = ['id' => $result['answer_id']];
                                                                            //                                                $sql = 'SELECT * FROM `answer` WHERE `id` = :id';
                                                                            //                                                $answer = $db->row($sql, $params)[0];
                                                                            //                                                echo $result['answer_id'];
                                    ?>
                                    Спасибо за оценку
                                </p>
                            </div>
                            <?php
                                                                        else :
                                                                            if ($value['type_id'] == 1) : ?>
                                <div class="row__radio">
                                    <p class="radio-pole">
                                        <input type="text" class="hidden__input" name="type_id" value="<?php echo $value['type_id'] ?>">
                                        <input class="inp__yes-no" type="radio" name="yes-no" id="radio" value="3" />
                                        <label for="radio"></label>
                                        Да
                                    </p>
                                    <p class="radio-pole">
                                        <input class="inp__yes-no" type="radio" name="yes-no" id="radio2" value="1" />
                                        <label for="radio2"></label>
                                        Нет
                                    </p>
                                </div>
                            <?php
                                                                            elseif ($value['type_id'] == 2) : ?>
                                <input type="text" class="hidden__input" name="type_id" value="<?php echo $value['type_id'] ?>">
                                <div class="row__radio">
                                    <p class="radio-pole">
                                        <input class="inp__quality" type="radio" name="yes-no" id="radio3" value="3" />
                                        <label for="radio3"></label>
                                        Отлично
                                    </p>
                                    <p class="radio-pole">
                                        <input class="inp__quality" type="radio" name="yes-no" id="radio4" value="2" />
                                        <label for="radio4"></label>
                                        Хорошо
                                    </p>
                                    <p class="radio-pole">
                                        <input class="inp__quality" type="radio" name="yes-no" id="radio5" value="1" />
                                        <label for="radio5"></label>
                                        Плохо
                                    </p>
                                </div>
                        <?php
                                                                            endif;
                                                                        endif;

                        ?>
                        <input type="text" class="hidden__input" name="criterion_id" value="<?php echo $value['id'] ?>">
                        <input type="text" class="hidden__input" name="competition_id" value="<?php echo $competition['id'] ?>">
                        <input type="text" class="hidden__input" name="participant_id" value="<?php echo $participant['id'] ?>">
                        <div class="row__ocenka-kritery">
                            <?php
                                                                        if ($result) : ?><div class="btn-kritery btn-kritery_active" value="Оценено"></div><?php
                                                                                                                                                        else : ?><input type="submit" class="btn-kritery" name="gradeCriterion" value="Оценить"><?php
                                                                                                                                                                                                                                            endif;
                                                                                                                                                                                                                                                ?>
                        </div>
                    </form>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>