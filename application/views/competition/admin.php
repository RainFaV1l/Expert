<!-- conkurs-admin -->
<div class="conkurs-admin">
    <div class="header__conkurs-admin">
        <div class="col-header__conkurs-admin">
            <h1 class="name-conkurs__conkurs-admin"><?php echo $criterion[0]['competition_name'] ?></h1>
            <label class="date__conkurs-admin">
                <p class="text-date__conkurs-admin">
                    Дата проведения:
                </p>
                <p class="text-date__conkurs-admin">
                    <?php
                        $date_beginning = new DateTimeImmutable ($criterion[0]['competition_date_beginning']);
                        $expiration_date = new DateTimeImmutable ($criterion[0]['competition_expiration_date']);
                        echo $date_beginning->format('d.m.Y') . ' - ' . $expiration_date->format('d.m.Y');
                    ?>
                </p>
            </label>
        </div>
        <div class="col-header__conkurs-admin">
            <a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/edit" class="btn__conkurs-admin">
                Редактировать конкурс
            </a>
            <a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/delete" class="btn__conkurs-admin">
                Удалить конкурс
            </a>
        </div>
    </div>
    <div class="categorys__conkurs-admin">
        <a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/admin" class="cat__conkurs-admin active">Критерии</a>
        <a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/participants" class="cat__conkurs-admin">Участники</a>
        <a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/experts" class="cat__conkurs-admin">Эксперты</a>
        <a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/result" class="cat__conkurs-admin">Результат</a>
        <?php
            if($criterion[0]['competition_status'] == 0) :
            ?><a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/result/active" class="cat__conkurs-admin">Активировать конкурс</a><?php
            elseif($criterion[0]['competition_status'] == 1) :
                ?><a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/complete" class="cat__conkurs-admin">Отменить конкурс</a><?php
            endif;
        ?>
    </div>
    <div class="users__content">
        <h1>Критерии конкурса</h1>
        <div class="block__kriterys">
            <!-- КРИТЕРИИ -->
            <?php
                if(isset($criterion[0]['criterion_id'])) :
                    foreach ($criterion as $value) : ?>
                        <div class="kritery">
                            <p class="text-kritery"><?php echo $value['criterion_name'] ?></p>
                            <div class="row__kritery">
                                <div class="btns-row__kritery">
                                    <form method="post" action="/competition/<?php echo $criterion[0]['competition_id'] ?>/criterion_edit" name="editCriterionData" class="deleteParticipants">
                                        <input type="text" class="hidden__input" name="criterion_id" value="<?php echo $value['criterion_id'] ?>">
                                        <input type="text" class="hidden__input" name="competition_id" value="<?php echo $criterion[0]['competition_id'] ?>">
                                        <input type="submit" class="delete-user" name="editCriterionData" value="Редактировать">
                                    </form>
                                    <form method="post" action="/competition/<?php echo $criterion[0]['competition_id'] ?>/criterion_delete" name="deleteCriterionData">
                                        <input type="text" class="hidden__input" name="criterion_id" value="<?php echo $value['criterion_id'] ?>">
                                        <input type="submit" class="delete-user" name="deleteCriterionData" value="Удалить">
                                    </form>
                                </div>
                                <p class="text-row__kritery">
                                    <span class="count__points"><?php echo $value['criterion_score'] ?></span>
                                    баллов
                                </p>
                            </div>
                        </div>
                    <?php endforeach;
                    endif;
            ?>
        </div>
        <a href="/competition/<?php echo $criterion[0]['competition_id'] ?>/criterion_add" class="btn-add-kritery">
            Добавить критерии
        </a>
    </div>
</div>