<!-- conkurs -->
<div class="conkurs">
    <h1 class="zag__conkurs">
        Конкурсы
    </h1>
    <div class="conkurs__blocks">
        <?php
            foreach ($competition as $key => $val):
                // Вывод конкурсов
                ?>
                    <div class="conkurs__block">
                    <div class="after-block__conkurs">
                        <a href="/competition/<?php echo $val['id']; ?>" class="btn__conkurs">
                            Подробнее
                        </a>
                    </div>
                    <h3 class="name__conkurs">
                        <?php echo $val['name']; ?>
                    </h3>
                    <p class="text__conkurs">
                        <?php echo $val['description']; ?>
                    </p>
                    <div class="ikons__conkurs">
                        <div class="ikon__conkurs">
                            <img src="public/images/ikon.png" alt="icon">
                        </div>
                        <div class="ikon__conkurs">
                            <img src="public/images/ikon2.png" alt="icon">
                        </div>
                        <div class="ikon__conkurs">
                            <img src="public/images/ikon3.png" alt="icon">
                        </div>
                    </div>
                    <p class="date__conkurs">
                        <?php
                            $date = new DateTimeImmutable ($val['date_beginning']);
                            echo $date->format('d-m-Y');
                        ?>
                    </p>
                    <a href="/competition/<?php echo $val['id']; ?>" class="btn-mobile">
                        Подробнее
                    </a>
                </div>
                <?php
            endforeach;
        ?>
    </div>
    <?php
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 3) :
            ?><a href="/competition/add" class="btn-add__conkurs">Добавить конкурс</a><?php
        endif;
    ?>
</div>