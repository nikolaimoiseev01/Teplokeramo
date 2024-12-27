import './bootstrap';
import $ from 'jquery'
import 'jquery-mask-plugin'

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

document.addEventListener('DOMContentLoaded', function () {
    window.updateBasketCount = function () {
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
})

// Объявляем функцию снаружи, чтобы она была доступна глобально
document.addEventListener('DOMContentLoaded', function () {
    window.updateBasketButtons = function () {
        let data = getCookie('basket-products');
        data = data ? JSON.parse(data) : [];
        $.each(data, function (index, item) {
            let button = $(`#big-basket-button-${item.id}`);
            button.text('В корзине');
            button.addClass('disabled');
        });
    }
})

// Добавляем обработчик на событие
document.addEventListener('afterBasketUpdate', function () {
    updateBasketButtons()
    updateBasketCount()
});




$(document).ready(function () {
    $('.mobile_input').mask('0 (000) 000-00-00');
})

window.addEventListener('swal:modal', event => {
    Swal.fire({
        title: event.detail.title,
        icon: event.detail.type,
        html: "<p>" + event.detail.text + "</p>",
        showConfirmButton: false,
    })
    if (event.detail.type === 'success') {

        $('#go-to-part-page').attr('href', event.detail.link);
        $('#go-to-part-page').trigger('click');
        $('#back').trigger('click');
    }
})
