import './bootstrap';
import $ from 'jquery'
window.$ = $;
window.jQuery = $;

// Установка куки
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Получение куки
function getCookie(name) {
    const nameEQ = name + "=";
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        while (cookie.charAt(0) === ' ') cookie = cookie.substring(1, cookie.length);
        if (cookie.indexOf(nameEQ) === 0) {
            return decodeURIComponent(cookie.substring(nameEQ.length, cookie.length)); // Декодируем значение
        }
    }
    return null;
}

// Удаление куки
function deleteCookie(name) {
    document.cookie = name + "=; Max-Age=-99999999;";
}

function updateBasketCount() {
    let data = getCookie('basket-products');
    data = data ? JSON.parse(data) : [];
    let products_cnt = Object.keys(data).length
    if (products_cnt > 0) {
        $('#basket-badge').removeClass('hidden');
        $('#basket-badge').text(products_cnt);
    } else {
        $('#basket-badge').addClass('hidden');
    }
}
updateBasketCount()

// Объявляем функцию снаружи, чтобы она была доступна глобально
function updateBasketButtons() {
    let data = getCookie('basket-products');
    data = data ? JSON.parse(data) : [];
    $.each(data, function(index, item) {
        let button = $(`#big-basket-button-${item.id}`);
        button.text('В корзине');
        button.addClass('disabled');
    });
}

// Запускаем функцию сразу
updateBasketButtons();

// Добавляем обработчик на событие
document.addEventListener('afterBasketUpdate', function() {
    updateBasketButtons()
    updateBasketCount()
});





// Добавление ID в куки
document.addEventListener('DOMContentLoaded', function () {
    window.addIdToCookie = function (cookieName, id) {
        let data = getCookie(cookieName);
        // Преобразуем строку куки в массив, если кука существует
        data = data ? JSON.parse(data) : {};
        const val = $(`#big-basket-button-${id}`).parent().children('.number-wrap').find('input').val();

        // Проверяем, есть ли ID в массиве
        if (!data.includes(id)) {
            data.push(id); // Добавляем ID в массив
            setCookie(cookieName, JSON.stringify(data), 7); // Сохраняем массив в виде строки
            console.log(`ID ${id} добавлен в куки`);
            updateBasketCount()
            updateBasketButtons()
        } else {
            console.log(`ID ${id} уже существует в куки`);
        }
    };
});

// Удаление ID из куки
document.addEventListener('DOMContentLoaded', function () {
    window.removeIdFromCookie = function (cookieName, id) {
        let data = getCookie(cookieName);

        if (data) {
            data = JSON.parse(data); // Преобразуем строку в массив

            // Убираем указанный ID
            data = data.filter(item => item !== id);

            // Сохраняем обновленный список
            setCookie(cookieName, JSON.stringify(data), 7);
            console.log(`ID ${id} удалён из куки`);
            updateBasketCount()
            updateBasketButtons()
        } else {
            console.log(`Кука ${cookieName} не существует или пуста`);
        }
    };
})
