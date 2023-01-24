<?php
    $date_beginning = strtotime($oneCompetitionEdit['date_beginning']);
    $expiration_date = strtotime($oneCompetitionEdit['expiration_date']);
?>
<!-- edit-conkurs -->
<div class="add-conkurs">
    <h1 class="name__add-conkurs">Редактирование конкурса</h1>
    <p class="auth__error"></p>
    <form class="form__add-conkurs" method="post" action="/competition/<?php echo $oneCompetitionEdit['id']?>/edit" name="add_conkurs" enctype="multipart/form-data">
        <div class="inputs__add-conkurs">
            <label class="input-block__add-conkurs">
                <p class="name-input__auth">Введите наименование конкурса</p>
                <input
                    class="input__auth"
                    type="text"
                    name="name"
                    placeholder="Введите наименование конкурса"
                    value="<?php echo $oneCompetitionEdit['name'] ?>"
                />
            </label>
            <label class="input-block__add-conkurs">
                <p class="name-input__auth">Введите описание конкурса</p>
                <textarea
                    class="textarea__add-conkurs"
                    name="description"
                    cols="30"
                    rows="10"
                    placeholder="Введите описание конкурса"
                ><?php echo $oneCompetitionEdit['description'] ?></textarea>
            </label>
            <div class="row__add-conkurs">
                <label class="input-block__add-conkurs">
                    <p class="name-input__add-conkurs">Введите дату начала</p>
                    <input type="date" name="date_beginning" class="input__add-conkurs" value="<?php echo date('Y-m-d', $date_beginning); ?>" />
                </label>
                <label class="input-block__add-conkurs">
                    <p class="name-input__add-conkurs">Введите дату окончания</p>
                    <input type="date" class="input__add-conkurs" name="expiration_date" value="<?php echo date('Y-m-d', $expiration_date); ?>"/>
                </label>
            </div>
            <label class="input-block__add-conkurs">
                <p class="name-input__auth">Загрузите изображение</p>
                <input type="file" name="img">
            </label>
        </div>
        <input type="submit" class="btn__add-conkurs" name="add_conkurs" value="Редактировать конкурс"/>
    </form>
</div>