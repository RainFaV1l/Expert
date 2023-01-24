<!-- add-conkurs -->
<div class="add-conkurs">
    <h1 class="name__add-conkurs">Добавление конкурса</h1>
    <p class="auth__error"></p>
    <form class="form__add-conkurs" method="post" action="/competition/add" name="add_conkurs" enctype="multipart/form-data">
        <div class="inputs__add-conkurs">
            <label class="input-block__add-conkurs">
                <p class="name-input__auth">Введите наименование конкурса</p>
                <input
                    class="input__auth"
                    type="text"
                    name="name"
                    placeholder="Введите наименование конкурса"
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
                ></textarea>
            </label>
            <div class="row__add-conkurs">
                <label class="input-block__add-conkurs">
                    <p class="name-input__add-conkurs">Введите дату начала</p>
                    <input type="date" name="date_beginning" class="input__add-conkurs" />
                </label>
                <label class="input-block__add-conkurs">
                    <p class="name-input__add-conkurs">Введите дату окончания</p>
                    <input type="date" class="input__add-conkurs" name="expiration_date"/>
                </label>
            </div>
            <label class="input-block__add-conkurs">
                <p class="name-input__auth">Загрузите изображение</p>
                <input type="file" name="img">
            </label>
        </div>
        <input type="submit" class="btn__add-conkurs" name="add_conkurs" value="Добавить конкурс"/>
    </form>
</div>