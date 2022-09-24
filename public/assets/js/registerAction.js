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
<<<<<<< HEAD
        success:function()


=======
        success:function(data) {
            alert(data);
        },
        error:function(xhr,status,error) {
            console.log(xhr);
        }
        
>>>>>>> ef8e56c60f00f081d71a857d5046128adff8b86b
    });
}