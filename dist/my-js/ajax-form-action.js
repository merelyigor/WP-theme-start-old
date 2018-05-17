
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