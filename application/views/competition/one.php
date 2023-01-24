<?php
    use application\models\Competition;
    use application\lib\Db;
    //debug($competition);
    $db = new Db();
    $params = [
            'id' => $oneCompetition['status'],
    ];
    $oneCompetitionStatus = $db->row('SELECT * FROM `competition_status` WHERE `id` = :id', $params);
    $oneCompetitionStatus = $oneCompetitionStatus[0];
?>
<!-- one__conkurs -->
<div class="one-conkurs">
    <h1 class="zag__one-conkurs"><?php echo $oneCompetition['name'] ?></h1>
    <div class="info__conkurs">
        <div class="img-block__conkurs">
            <img src="../../<?php echo $oneCompetition['path'] ?>" alt="Здесь должна была быть картинка :(" />
        </div>
        <div class="info-inner__conkurs">
            <h2 class="subname__conkurs"><?php echo $oneCompetition['name'] ?></h2>
            <p class="description-accordion">
                Описание <img src="../img/arrow.png" alt="">
            </p>
            <p class="description__conkurs"><?php echo $oneCompetition['description'] ?></p>
            <div class="date-info__conkurs"> Дата начала:
                <?php
                    $arr = [
                        'январь',
                        'февраль',
                        'март',
                        'апрель',
                        'май',
                        'июнь',
                        'июль',
                        'август',
                        'сентябрь',
                        'октябрь',
                        'ноябрь',
                        'декабрь'
                    ];
                    $month = date('n')-1;
                    $date = new DateTimeImmutable ($oneCompetition['date_beginning']);
                    echo $date->format('d') . ' ' . $arr[$month] . ' ' . $date->format('Y');
                ?>
            </div>
            <div class="date-info__conkurs"> Дата окончания:
                <?php
                $date = new DateTimeImmutable ($oneCompetition['expiration_date']);
                echo $date->format('d') . ' ' . $arr[$month] . ' ' . $date->format('Y');
                ?>
            </div>

            <div class="date-info__conkurs">
                <p>Статус конкурса: <?php echo $oneCompetitionStatus['name']?></p>
            </div>

            <div class="date-info__conkurs">
                <?php
                    if($_SESSION['user']['role'] === 3) {?>
                        <p>Страница конкурса для админа:</p>
                        <a href="/competition/<?php echo $oneCompetition['id'] ?>/admin" class="btn-add-kritery">Админ панель</a>
                    <?php }
                ?>
            </div>
        </div>
    </div>
    <?php
        $participant = new Competition();
        if(isset($_SESSION['user']['role']) AND $_SESSION['user']['role'] == 2):
            $params = [
                'competition_id' => $oneCompetition['id'],
            ];
            $participant_info = $participant->getParticipant($oneCompetition['id']);
            ?>
            <div class="users__conkurs">
                <h1 class="zag-users__conkurs">
                    Список участников
                </h1>
                <div class="block-users__conkurs">
                    <?php
                        if(!empty($participant_info)) :
                            foreach ($participant_info as $value): ?>
                                <div class="user__conkurs">
                                    <div class="id-user__conkurs"><?php echo $value['user_id'] ?></div>
                                    <div class="fio-user__conkurs"><?php echo $value['user_surname'] . ' ' . $value['user_name'] . ' ' . $value['user_patronymic'] ?></div>
                                    <div class="container__btn-user__conkurs">
                                        <form method="post" action="/competition/<?php echo $oneCompetition['id'] ?>/grade" name="gradeCriterionData" class="deleteParticipants">
                                            <input type="text" class="hidden__input" name="competition_id" value="<?php echo $oneCompetition['id'] ?>">
                                            <input type="text" class="hidden__input" name="participant_id" value="<?php echo $value['user_id'] ?>">
                                            <input type="submit" class="btn-user__conkurs" name="gradeCriterionData" value="Оценить">
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach;
                            endif;
                    ?>

                </div>
            </div>
            <?php
        endif;
    ?>
</div>