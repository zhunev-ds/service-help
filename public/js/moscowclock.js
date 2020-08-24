'use strict';

var hoursM = document.querySelector('.hoursM');
var minutesM = document.querySelector('.minutesM');
var secondsM = document.querySelector('.secondsM');

var monthM = document.querySelector('.monthM');
var dayM = document.querySelector('.dayM');
var yearM = document.querySelector('.yearM');

function setDateM() {
    var now = new Date();
    var mm = now.getMonth();
    var dd = now.getDate();
    var yyyy = now.getFullYear();
    var secs = now.getSeconds();
    var mins = now.getMinutes();
    var hrs = now.getHours();
    var monthName = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

    if (hrs > 12) {
        hoursM.innerHTML = hrs;
    } else {
        hoursM.innerHTML = hrs;
    }

    if (secs < 10) {
        secondsM.innerHTML = '0' + secs;
    } else {
        secondsM.innerHTML = secs;
    }

    if (mins < 10) {
        minutesM.innerHTML = '0' + mins;
    } else {
        minutesM.innerHTML = mins;
    }

    monthM.innerHTML = monthName[mm];
    dayM.innerHTML = dd;
    yearM.innerHTML = yyyy;
}

setInterval(setDateM, 1000);
