$(function () {
    $('#matricula').on('keydown',function (e) {
        if(event.keyCode === 13) {
            event.preventDefault();
            check();
            return false;
        }
    })
});

function check() {
    var data = {
        user: $('#matricula').val(),
        _token: $('#token').val()
    };

    $('#matricula').val('');

    $.post('check', data).then((response) => {
        var box = '';
        if (response.status === 'success') {
            showUser(response.user);
            box = '#success';
        }
        else{
            box = '#fail';
        }

        $(box).html(response.message);
        $(box).fadeIn();
        closeAlerts(response);
    });
}

function closeAlerts(response) {
    setTimeout(function () {
        $('.alert').fadeOut();
        if(response.status === 'success'){
            $('#info').fadeOut();
        }
    },3000);
}

function showUser(user) {
    $('#profile-picture').attr('src',user.img);
    $('.widget-user-username').html(user.nombre);
    $('.widget-user-desc').html(user.department);
    $('#info').fadeIn();
}
