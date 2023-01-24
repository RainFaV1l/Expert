// Отправка ajax формы на jquery
$(document).ready(function () {

    // При клике на кнопку
    $('form').submit(function (event) {

        // if($('form').attr('class') === 'deleteParticipants') {
        //
        // } else {
        //
        // }
        //event.preventDefault();

        // Объявляем переменную json
        let json;

        let clickClass = $(this).attr("class");

        if(clickClass == 'deleteParticipants') {

        } else {
            // Отключаем стандартное срабатывание формы
            event.preventDefault();
        }

        // Формируем ajax запрос
        $.ajax({

            // Указываем тип
            type: $(this).attr('method'),

            // Указываем ссылку
            url: $(this).attr('action'),

            // Получаем данные из формы
            data: new FormData(this),

            // Отключаем передачу заголовков
            contentType: false,

            // Отключаем хэширование
            cache: false,

            // Для того, чтобы данные не преобразовывались в строку
            processData: false,

            // При успешной отправки формы
            success: function (result) {

                json = jQuery.parseJSON(result);
                if(json.url) {

                    window.location.href = '/' + json.url;

                } else {

                    let error = $('.auth__error');
                    error.text(json.message);
                    error.addClass('active');
                    if(json.status === 'success') {
                        error.addClass('success');
                    }

                    // alert(json.status + ' - ' + json.message);

                }

            },

        });

    });

});