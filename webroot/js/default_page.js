/**
 * Created by kito on 29.05.16.
 */
    /* делаем всплывающую кнопку которая при нажатии прокручивает страницу в самый верх */
$(document).ready(function(){
    var opti = 0;
    $(window).scroll(function(){
        var scro = $(this).scrollTop();
        if(scro > 100 && opti == 0){ $("#upBlock").animate({opacity:0.5},600); opti = 0.5; }
        if(scro > 300 && opti != 1){ $("#upBlock").animate({opacity:0.5},600); opti = 1; }
        if(scro < 100 && opti > 0){ $("#upBlock").animate({opacity:0.01},600); opti = 0; }
        if(scro < 300 && opti == 1){ $("#upBlock").animate({opacity:0.1},600); opti = 0.5; }
    });
    $("#upBlock").click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1200);
        $("#upBlock").css('opacity','0');
        opti = 0;
    });
});
/* меню Головна Пошук Додати Нове в законодавстві Зворотній звязок прилипает при прокрутке вниз */
(function(){  // анонимная функция (function(){ })(), чтобы переменные "a" и "b" не стали глобальными
    var a = document.querySelector('#aside1'), b = null;  // селектор блока, который нужно закрепить
    window.addEventListener('scroll', Ascroll, false);
    document.body.addEventListener('scroll', Ascroll, false);  // если у html и body высота равна 100%
    function Ascroll() {
        if (b == null) {  // добавить потомка-обёртку, чтобы убрать зависимость с соседями
            var Sa = getComputedStyle(a, ''), s = '';
            for (var i = 0; i < Sa.length; i++) {  // перечислить стили CSS, которые нужно скопировать с родителя
                if (Sa[i].indexOf('overflow') == 0 || Sa[i].indexOf('padding') == 0 || Sa[i].indexOf('border') == 0 || Sa[i].indexOf('outline') == 0 || Sa[i].indexOf('box-shadow') == 0 || Sa[i].indexOf('background') == 0) {
                    s += Sa[i] + ': ' +Sa.getPropertyValue(Sa[i]) + '; '
                }
            }
            b = document.createElement('div');  // создать потомка
            b.style.cssText = s + ' box-sizing: border-box; width: ' + a.offsetWidth + 'px;';
            a.insertBefore(b, a.firstChild);  // поместить потомка в цепляющийся блок
            var l = a.childNodes.length;
            for (var i = 1; i < l; i++) {  // переместить во вновь созданного потомка всех остальных потомков плавающего блока (итого: создан потомок-обёртка)
                b.appendChild(a.childNodes[1]);
            }
            a.style.height = b.getBoundingClientRect().height + 'px';  // если под скользящим элементом есть другие блоки, можно своё значение
            a.style.padding = '0';
            a.style.border = '0';  // если элементу присвоен padding или border
        }
        if (a.getBoundingClientRect().top <= 0) { // elem.getBoundingClientRect() возвращает в px координаты элемента относительно верхнего левого угла области просмотра окна браузера
            b.className = 'sticky';
        } else {
            b.className = '';
        }
        /* window.addEventListener('resize', function() {
         a.children[0].style.width = getComputedStyle(a, '').width
         }, false); */ // если изменить размер окна браузера, измениться ширина элемента
    }
})()
