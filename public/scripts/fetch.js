// Асинхроннаяя отправка данных на серве
// Оценка заданий экспертом

const saveData = async (formsDataItems) => {

    formsData = document.querySelectorAll(formsDataItems);

    formsData.forEach((formData) => {

        formData.onsubmit = async (e) => {

            e.preventDefault();
    
            // let url = formData.dataset.url;

            let url = '/competition/1/grade/grade';
    
            let response = await fetch(url, {
                method: 'POST',
                body: new FormData(formData),
            });
    
            let result = await response.json();
    
            // alert(result.message);
        }

    })

}

const init = () => {

    // Вызываем функцию асинхронного сохранения данных
    // saveData('.gradeFetch');

}

document.addEventListener('DOMContentLoaded', init);