$('document').ready(function () {

    $('#register_button').click(registerAction);

});

function registerAction() {

    let username = $('#register_username').val();
    let password = $("#register_password").val();
    let email = $("#register_email").val();
    
    $.ajax({
        url: '/api/register',
        method: 'POST',
        data: {
            'username': username,
            'password': password,
            'email': email
        },

        success:function()


    });
}
