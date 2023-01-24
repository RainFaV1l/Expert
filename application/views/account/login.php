<!-- Страница авторизации -->
<div class="auth">
    <h1 class="zag__auth">Авторизация</h1>
    <p class="auth__error"></p>
    <form action="/login" method="post" name="login" class="form__auth">
        <div class="inputs__auth">
            <label class="input-block__auth">
                <p class="name-input__auth">Введите ваш email</p>
                <input class="input__auth" type="text" name="email" placeholder="Введите ваш email">
            </label>
            <label class="input-block__auth">
                <p class="name-input__auth">Введите ваш пароль</p>
                <input class="input__auth" type="password" name="password" placeholder="Введите ваш пароль">
            </label>
        </div>
        <input type="submit" value="Авторизоваться" name="login" class="btn__auth">
    </form>
</div>