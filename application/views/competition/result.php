<?php
//    debug($competitionResult);
?>
<div class="result">
    <div class="result__container container">
        <div class="result__title-button">
            <div class="result__title-error">
                <h1 class="result__title">Результат оценки</h1>
                    <?php
                    if(isset($_SESSION['error'])) {
                        foreach ($_SESSION['error'] as $error) {
                        echo '<p class="session__error no-margin">' . $error . '</p>';
                        }
                        unset($_SESSION['error']);
                    }
                    ?>
            </div>
            <?php
                $params = [
                        'id' => $competitionResult[0]['competition_id'],
                ];
                $sql = 'SELECT status FROM `competition` WHERE `id` = :id';
                $db = new \application\lib\Db();
                $competition_status = $db->row($sql, $params)[0];

                if($competition_status['status'] == 2) :
                    ?><a href="/competition/<?php echo $competitionResult[0]['competition_id'] ?>/result/active" class="result__button btn__conkurs-admin">Активировать конкурс</a><?php
                else :
                    ?><a href="/competition/<?php echo $competitionResult[0]['competition_id'] ?>/result/complete" class="result__button btn__conkurs-admin">Завершить конкурс</a><?php
                endif;
            ?>

        </div>
        <p class="auth__error"></p>
        <div class="result-table">
            <table class="result-table__table">
                <h3>Таблица оценки</h3>
                <thead>
                <tr>
                    <td>id участника</td>
                    <td>ФИО участника</td>
                    <td>id эксперта</td>
                    <td>ФИО эксперта</td>
                    <td>Конкурс</td>
                    <td>Критерий</td>
                    <td>Ответ</td>
                    <td>Балл</td>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($competitionResult as $value): //debug($value);
                        $params = [
                            'id' => $value['user_id'],
                            'role' => 1
                        ];
                        $sql = 'SELECT * FROM `users` WHERE `id` = :id AND `role` = :role';
                        $user = $db->row($sql, $params)[0];

                        $params = [
                            'id' => $value['expert_id'],
                            'role' => 2
                        ];
                        $sql = 'SELECT * FROM `users` WHERE `id` = :id AND `role` = :role';
                        $expert = $db->row($sql, $params)[0];

                        $params = [
                            'id' => $value['competition_id'],
                        ];
                        $sql = 'SELECT * FROM `competition` WHERE `id` = :id';
                        $competition = $db->row($sql, $params)[0];

                        $params = [
                            'id' => $value['evaluation_criterion_id'],
                        ];
                        $sql = 'SELECT * FROM `evaluation_criterion` WHERE `id` = :id';
                        $criterion = $db->row($sql, $params)[0];

                        $params = [
                            'id' => $value['answer_id'],
                        ];
                        $sql = 'SELECT * FROM `answer` WHERE `id` = :id';
                        $answer = $db->row($sql, $params)[0];
                    ?>
                        <tr>
                            <td><?php echo $value['user_id'] ?></td>
                            <td><?php echo $user['surname'] . ' ' . $user['name'] . ' ' . $user['patronymic'] ?></td>
                            <td><?php echo $value['expert_id'] ?></td>
                            <td><?php echo $expert['surname'] . ' ' . $expert['name'] . ' ' . $expert['patronymic'] ?></td>
                            <td><?php echo $competition['name'] ?></td>
                            <td><?php echo $criterion['name'] ?></td>
                            <td><?php echo $answer['name'] ?></td>
                            <td><?php echo $value['score'] ?></td>
                        </tr>
                    <?php
                    endforeach;
                ?>
                </tbody>
            </table>
            <table class="result-table__table">
                <h3>Таблица результата</h3>
                <thead>
                <tr>
                    <td>id участника</td>
                    <td>ФИО участника</td>
<!--                    <td>id эксперта</td>-->
<!--                    <td>ФИО эксперта</td>-->
                    <td>id конкурса</td>
                    <td>Конкурс</td>
                    <td>Статус</td>
                    <td>Критерии</td>
                    <td>Ответы</td>
                    <td>Баллы</td>
                    <td>Общий балл</td>
                    <td>Рейтинг</td>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($competitionResultCount as $value):
                    $db = new \application\lib\Db();
                    $params = [
                        'id' => $value['user_id'],
                        'role' => 1
                    ];
                    $sql = 'SELECT * FROM `users` WHERE `id` = :id AND `role` = :role';
                    $user = $db->row($sql, $params)[0];

//                    $params = [
//                        'id' => $value['expert_id'],
//                        'role' => 2
//                    ];
//                    $sql = 'SELECT * FROM `users` WHERE `id` = :id AND `role` = :role';
//                    $expert = $db->row($sql, $params)[0];
                    ?>
                    <tr>
                        <td><?php echo $value['user_id'] ?></td>
                        <td><?php echo $user['surname'] . ' ' . $user['name'] . ' ' . $user['patronymic'] ?></td>
                        <!--                        <td>--><?php //echo $value['expert_id'] ?><!--</td>-->
                        <!--                        <td>--><?php //echo $expert['surname'] . ' ' . $expert['name'] . ' ' . $expert['patronymic'] ?><!--</td>-->
                        <td><?php echo $value['competition_id'] ?></td>
                        <td><?php echo $value['competition_name'] ?></td>
                        <td><?php echo $value['competition_status_name'] ?></td>
                        <td><?php echo $value['evaluation_criterion_names'] ?></td>
                        <td><?php echo $value['answer_names'] ?></td>
                        <td><?php echo $value['score'] ?></td>
                        <td><?php echo $value['sum_score'] ?></td>
                        <td><?php echo $value['num'] ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>