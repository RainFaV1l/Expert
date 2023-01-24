<?php
    use \application\lib\Db;
    $db = new Db();
    if(!isset($_POST)) \application\core\View::errorCode(404);
    if(isset($_POST['editCriterionData'])) {
        $criterion_id = $_POST['criterion_id'];
        $params = ['criterion_id' => $criterion_id];
        $sql = 'SELECT * FROM `evaluation_criterion` WHERE `id` = :criterion_id';
        $criterion = $db->row($sql, $params);
        foreach ($criterion as $value) : endforeach;
    }
?>
<!-- add-kritery -->
<div class="add-conkurs">
    <h1 class="name__add-conkurs">Редактирование критерия</h1>
    <p class="auth__error"></p>
    <form class="deleteParticipants" name="editCriterion" method="post" action="/competition/<?php echo $competition_id[0]['id']; ?>/criterion_edit">
        <div class="inputs__add-conkurs">
            <label class="input-block__add-conkurs" for="">
                <p class="name-input__auth">Введите наименование критерия</p>
                <input type="text" class="hidden__input" name="criterion_id" value="<?php if(isset($value['id'])) echo $value['id'] ?>">
                <input
                    class="input__auth"
                    type="text"
                    name="name"
                    value="<?php if(isset($value['name'])) echo $value['name']; ?>"
                    placeholder="Введите наименование критерия"
                />
            </label>
            <label class="input-block__add-conkurs" for="">
                <p class="name-input__auth">Введите балл за критерий</p>
                <input
                    class="input__auth"
                    type="number"
                    name="score"
                    value="<?php if(isset($value['score'])) echo $value['score']; ?>"
                    placeholder="Введите балл за критерий"
                />
            </label>
            <div class="row__add-conkurs">
                <p class="name-input__auth">Выберите тип оценивания</p>
                <?php
                    if(isset($value['type_id'])) :
                        if($value['type_id'] == 1) : ?>
                            <p class="radio-pole">
                                <input
                                        class="inp__yes-no"
                                        type="radio"
                                        name="type"
                                        id="checkbox"
                                        value="1"
                                        checked
                                />
                                <label for="checkbox"></label>
                                Да / Нет
                            </p>
                            <p class="radio-pole">
                                <input
                                        class="inp__yes-no"
                                        type="radio"
                                        name="type"
                                        id="checkbox2"
                                        value="2"
                                />
                                <label for="checkbox2"></label>
                                Отлично / Хорошо / Плохо
                            </p>
                        <?php
                        elseif ($value['type_id'] == 2) : ?>
                            <p class="radio-pole">
                                <input
                                        class="inp__yes-no"
                                        type="radio"
                                        name="type"
                                        id="checkbox"
                                        value="1"
                                />
                                <label for="checkbox"></label>
                                Да / Нет
                            </p>
                            <p class="radio-pole">
                                <input
                                        class="inp__yes-no"
                                        type="radio"
                                        name="type"
                                        id="checkbox2"
                                        value="2"
                                        checked
                                />
                                <label for="checkbox2"></label>
                                Отлично / Хорошо / Плохо
                            </p>
                        <?php
                            endif;
                    else : ?>
                        <p class="radio-pole">
                            <input
                                    class="inp__yes-no"
                                    type="radio"
                                    name="type"
                                    id="checkbox"
                                    value="1"
                            />
                            <label for="checkbox"></label>
                            Да / Нет
                        </p>
                        <p class="radio-pole">
                            <input
                                    class="inp__yes-no"
                                    type="radio"
                                    name="type"
                                    id="checkbox2"
                                    value="2"
                            />
                            <label for="checkbox2"></label>
                            Отлично / Хорошо / Плохо
                        </p>
                    <?php endif;
                ?>
            </div>
        </div>
        <input type="submit" name="editCriterion" class="btn__add-conkurs" value="Редактировать критерий"/>
    </form>
</div>