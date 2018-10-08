
// Подключить нужно только после vendor или jquery

$('.class form').submit(function(event){ //отслеживается первая форма которая вложена в элемент с классом .class
    event.preventDefault(); // также по мимо класса можно писать id ('#id form')

    var $this = $(this);

    $.post( myajax.url, { //обращение на передачу данных в myajax.url
        action: 'my_form_name_action', //название action который зарегистрирован для обработки данных в php
        name: $this.find('input[name="name"]').val(), //берутся значения по input и атрибуту name
        org: $this.find('input[name="organization"]').val(),
        region: $this.find('input[name="region"]').val(),
        tel: $this.find('input[name="tel"]').val(),
        radio: $this.find('input[name="radio"]:checked').val()

    }, function(response) {
        $this.get(0).reset(); // сбрасываю поля формы после отправки данных
        $.fancybox.close(); // закрываю pop-up2 если форма находится в pop-up
    });
});



// Подключить нужно только после vendor или jquery

$('.contacts form').submit(function(event){
    event.preventDefault();

    var form = $(this),
        data =  {
            action: 'my_action', //название action который зарегистрирован для обработки данных в php
            name: form.find('input[name="name"]').val(), //берутся значения по input и атрибуту name
            mail: form.find('input[name="email"]').val(),
            tel: form.find('input[name="tel"]').val(),
            comment: form.find('textarea[name="comment"]').val()

        };
    console.table(data);
    $.post( myajax.url, data, function(response) {
        form.get(0).reset();
    });
});










button.click(function(e){
    var dataset = $(e.target).data();
    console.log(dataset);
    magnificPopupInstance.open({
        type: 'inline',
        items: dataset,
        inline: {
            markup: `
        <div class="white-popup">
          <div class="mfp-close"></div>
          <h2>${dataset.username}</h2>
          <input type="text" placeholder="${dataset.value}"/>
          <input type="hidden" value="${dataset.value}"/>
        </div>
      `
        }
    });
});



//* Добавление класса при скролле *//

jQuery(window).scroll(function() {
    var the_top = jQuery(document).scrollTop(); // привязываем отсчет от верха документа
    // говорим на сколько пиксилей нужно проскролить вниз что бы добавить класс (скрол от верха > если больше значения то присвоить класс)
    if (the_top > 1150) {
        jQuery('.grid-animate-fix-1').addClass('engaged'); // находим jQuery('.класс') по классу или id элемент к которому через .addClass('класс') добавляем клас
    }
    else {
        jQuery('.grid-animate-fix-1').removeClass('engaged'); // иначе если не проскроленно и условие не выполняется то убираем класс при скроле вверх
    }
});


// Поздно отвечаю - но решение 100% рабочее - может кому пригодится

Картинка в magnific popup через data
<div class="zoom" data-src="/images/test.jpg"></div>

$('.zoom').click(function(){
    $.magnificPopup.open({
        items: {
            src: $(this).data('src')
        },
        type: 'image'
    });
});
