function send_contact_form() {
//ОТПРАВКА ФОРМЫ
    $('.contacts form').submit(function (event) {
        event.preventDefault();
        let form = $(this),
            form_data = new FormData();
        // поля формы
        form_data.append('action', 'contact_form');
        form_data.append('name', form.find('input[name="name"]').val());
        form_data.append('mail', form.find('input[name="email"]').val());
        form_data.append('textarea', form.find('textarea[name="msg"]').val());


        if ($('.input_namb_random_val').val() === number_random) {

            $.ajax({
                url: admin_ajax.url,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (response) {
                    form.get(0).reset();
                    // let thanks = document.querySelector('.thanks');
                    // $.fancybox.open(thanks);
                    // setTimeout(function () {
                    //     $.fancybox.close(thanks);
                    // }, 5000);
                }
            });
            console.log('form_data', form_data);

            console.log('send_contact_form');
            $('.input_namb_random_val').css('border', "none");
        } else {
            $('.input_namb_random_val').css('border', "2px solid red");
            console.log('not_send_validation');
        }

    });
}



function random_numb() {
//ПОЛУЧАЕМ РАНДОМ ЦИФРЫ
    let min = 1234,
        max = 9999;
    return (Math.random() * (max - min) + min).toFixed(0);
}

function not_send_validation() {
//ОТМЕНА ОТПРАВКИ - ОТКЛЮЧЕНИЕ КНОПКИ ОТПРАВКИ
    $('.contacts form').submit(function (event) {
        event.preventDefault();
    });
}

$('.contacts form').submit(function (event) {
//КРАСНАЯ ОБВОДКА ПРИ ОШИБКЕ
    event.preventDefault();
    $('.input_namb_random_val').css('border', "2px solid red");
});


$('.btn_back').on('click', function (event) {
//КНОПКА ДЛЯ ВОЗВРАТА - Имитирует кнопку назад
    event.preventDefault();
    history.back();
    return false;
});

let number_random = random_numb(),
    input_namb_random_val;
    //СОЗДАЕМ ПЕРЕМЕННЫЕ И ПОЛУЧАЕМ РАНДОМ ЧИСЛО

$('.input-custom__code--text').text(number_random);
//ВЫВОДИМ РАНДОМ ЧИСЛО

$('.input_namb_random_val').change(function() {
//ОТСЛЕЖИВАЕМ ВВЕДЕННОЕ ЧИСЛО
    input_namb_random_val = $(this).val();
    console.log('input_namb_random_val', input_namb_random_val);

    if (input_namb_random_val === number_random) {
    //ПРОВЕРЯЕМ ЧТО ЧИСЛО СОВПАДАЕТ
        send_contact_form();
        console.log('send_contact_form');
        $('.input_namb_random_val').css('border', "none");
    } else {
    //ЕСЛИ НЕ СОВПАЛО
        not_send_validation();
        $('.input_namb_random_val').css('border', "2px solid red");
        console.log('not_send_validation');
    }
});

console.log('Num_random', number_random);


