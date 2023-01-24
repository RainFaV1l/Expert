<?php

use application\models\Competition;

$competition_id = null;
foreach ($competitionParticipants as $competitionParticipant) {
    if(!empty($competitionParticipant['competition_id']))
        $competition_id = $competitionParticipant['competition_id'];
    else
        $competition_id = $competitionParticipant['id'];
    break;
}

$competition = new Competition();

$params = [
    'id' => $competition_id,
];

$competition = $competition->db->row('SELECT * FROM `competition` WHERE `id` = :id', $params);
$competition = $competition[0];

?>
<!-- conkurs-admin -->
<div class="conkurs-admin">
    <div class="header__conkurs-admin">
        <div class="col-header__conkurs-admin">
            <h1 class="name-conkurs__conkurs-admin"><?php echo $competition['name'] ?></h1>
            <label class="date__conkurs-admin">
                <p class="text-date__conkurs-admin">
                    Дата проведения:
                </p>
                <p class="text-date__conkurs-admin">
                    <?php
                    $date_beginning = new DateTimeImmutable ($competition['date_beginning']);
                    $expiration_date = new DateTimeImmutable ($competition['expiration_date']);
                    echo $date_beginning->format('d.m.Y') . ' - ' . $expiration_date->format('d.m.Y');
                    ?>
                </p>
            </label>
        </div>
        <div class="col-header__conkurs-admin">
            <a href="/competition/<?php echo $competition['id'] ?>/edit" class="btn__conkurs-admin">
                Редактировать конкурс
            </a>
            <a href="/competition/<?php echo $competition['id'] ?>/delete" class="btn__conkurs-admin">
                Удалить конкурс
            </a>
        </div>
    </div>
    <div class="categorys__conkurs-admin">
        <a href="/competition/<?php echo $competition['id'] ?>/admin" class="cat__conkurs-admin">Критерии</a>
        <a href="/competition/<?php echo $competition['id'] ?>/participants" class="cat__conkurs-admin">Участники</a>
        <a href="/competition/<?php echo $competition['id'] ?>/experts" class="cat__conkurs-admin active">Эксперты</a>
        <a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/result" class="cat__conkurs-admin">Результат</a>
        <a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/complete" class="cat__conkurs-admin">Отменить конкурс</a>
    </div>
    <div class="users__content">
        <!-- УЧАСТНИКИ -->
        <h1>Эксперты конкурса</h1>
        <div class="block__kriterys">
            <?php
            foreach ($competitionParticipants as $participant):
                if(!empty($participant['patronymic'])) {?>
                    <div class="user">
                        <h2 class="name-user">
                            <?php
                            echo $participant['surname'] . ' ' . $participant['name'] . ' ' . $participant['patronymic'] . ' № ' . $participant['id']
                            ?>
                        </h2>
                        <div class="btns__user">
                            <form method="post" action="/competition/<?php echo $competition['id'] ?>/deleteExpert" name="deleteParticipants" class="deleteParticipants" id="deleteParticipants">
                                <input type="text" class="hidden__input" name="participant_id" value="<?php echo $participant['id'] ?>">
                                <input type="submit" class="delete-user" name="deleteParticipants" value="Удалить">
                            </form>
                            <!--                            <a href="/competition/--><?php //echo $participant['id'] ?><!--/deletePartisipant" class="delete-user">Удалить</a>-->
                        </div>
                    </div>
                <?php }
            endforeach;
            ?>
        </div>
        <a href="/competition/<?php echo $competition['id'] ?>/experts_add" class="btn-add-kritery">
            Добавить эксперта
        </a>
    </div>
</div>
