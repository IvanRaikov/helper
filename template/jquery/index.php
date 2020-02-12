
.find() поиск элемента
.prev() предидущий элемент
.next() следующий элемент
.css('color', 'red') установить стиль
.css('color') получить цвет
.css({'color':'red',
      'background':'green'}) установить несколько стилей
.css('color', function(){}) колбэк функция
.addClass('some-class') добавить класс
.hasClass('class-name') есть ли такой класс
.removeClass('class-name') удалить класс
.toggleClass() установить или удалить класс
.attr(atrrName, value) установить атрибут
.attr({atrName:atrValue,
       atrName:atrValue})установить несколько атрибутов
.attr(atrName) получить значение атрибута
.removeAttr(atrrName) удалить атррибут
.hide(animation time,func) скрыть    func колбэк функция которая срабатывает по окончаании анимации
.show(animation time,func) показать 

.slideUp(animation time,func)   развернуть свернуть элемент
.slideDown(animation time,func)
.slideToggle(animation time,func)

.fadeIn(animationTime)   
.fadeOut(animationTime)    выцветание и исчезновение манипулирует стилем opacity
.fadeToggle(animationTime)
.fadeTo(0-1 opacity)

.animate({styles},animateTime) задать анимацию, только стили с числовыми значениями
element.appendTo(parentElement) добавить element в parentElement
$('<div></div>') создать элемент
element1.after(element2) вставить element2 после element1 
element1.before(element2) вставить element2 после element1 
element.append(element2) вставить в element внутрь в конец element2 
element.prepend(element2) вставить в element внутрь в начало element2
element.rplaceWith(element2) заменить element на element2 