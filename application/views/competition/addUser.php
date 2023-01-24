<?php
    use \application\lib\Db;
    $db = new Db();
    $role = 1;
    $params = ['id' => $competition_id[0]['id'],'role' => 1];
    $sql = 'SELECT * FROM `users` WHERE users.id 
    NOT IN (SELECT user_id FROM `users_competition` WHERE users_competition.competition_id = :id AND users_competition.user_role = :role) AND `role` = :role';
    $users = $db->row($sql, $params);
?>
<!-- add-user -->
<div class="add-conkurs">
    <h1 class="name__add-conkurs">Добавление участника</h1>
    <p class="auth__error"></p>
    <form class="form__add-conkurs" method="post" name="addUser" action="/competition/<?php echo $competition_id[0]['id']?>/participants_add">
        <div class="inputs__add-conkurs">
            <label class="input-block__add-conkurs">
                <p class="name-input__auth">Выберите id участника</p>
                <select name="user_id" class="input__auth">
                    <option value="0" selected>Выберите id участника</option>
                    <?php
                        foreach ($users as $user) :
                            $params = [
                                'user_id' => $user['id'],
                            ];
                            $user_info = $db->row('SELECT * FROM `users` WHERE `id` = :user_id', $params);
                            foreach ($user_info as $value) : ?>
                                <option value="<?php echo $value['id']?>"><?php echo $value['surname'] . ' ' . $value['name'] . ' ' . $value['patronymic']?></option>
                            <?php endforeach;
                        endforeach;
                    ?>
                </select>
            </label>
        </div>
        <input type="submit" class="btn__add-conkurs" value="Добавление участника" name="addUser"/>
    </form>
</div>