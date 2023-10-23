<!-- add-kritery -->
<div class="add-conkurs">
    <h1 class="name__add-conkurs">Добавление критерия</h1>
    <p class="auth__error"></p>
    <form class="form__add-conkurs" name="addCriterion" method="post" action="/competition/<?php echo $competition_id[0]['id']?>/criterion_add">
        <div class="inputs__add-conkurs">
            <label class="input-block__add-conkurs" for="">
                <p class="name-input__auth">Введите наименование критерия</p>
                <input
                    class="input__auth"
                    type="text"
                    name="name"
                    id=""
                    placeholder="Введите наименование критерия"
                />
            </label>
            <label class="input-block__add-conkurs" for="">
                <p class="name-input__auth">Введите балл за критерий</p>
                <input
                    class="input__auth"
                    type="text"
                    name="score"
                    id=""
                    placeholder="Введите балл за критерий"
                />
            </label>
            <div class="row__add-conkurs">
                <p class="name-input__auth">Выберите тип оценивания</p>
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
            </div>
        </div>
        <input type="submit" name="addCriterion" class="btn__add-conkurs" value="Добавить критерий"/>
    </form>
</div>