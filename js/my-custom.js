


$('#modal-reviews form').submit(function (event) {
    event.preventDefault();
    let form = $(this),
        form_data = new FormData();
    // поля формы
    form_data.append('action', 'post_add');
    form_data.append('name', form.find('input[name="name"]').val());
    form_data.append('mail', form.find('input[name="email"]').val());
    form_data.append('textarea', form.find('textarea[name="msg"]').val());


    $.ajax({
        url: my_ajax.url,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',
        success: function (response) {
            console.log('success', response);
            //form.get(0).reset();
            //let $popup = document.querySelector('#modal-getRequest');
            //$.fancybox.open($popup);
            //setTimeout(function () {
            //    $.fancybox.close($popup);
            //}, 5000);
        }
    });
    console.log('form_data', form_data);
});
