$(document).ready(function () {
    
})

$('#user-icon').on('click', function () {
    $('#login-register-div').slideToggle();
});

$('#register_button').on('click', function () {
    
    let validated = validateFields();

});


function validateFields() {
    let username = $("#register_username");
    let password = $("#register_password");
    let email = $("#register_email");

    let regExpUsername = /^[A-z0-9\.\-]{4,20}$/;
    let regExpPassword = /^(?=.*[A-Za-z])(?=.*d)[A-Za-zd]{8,}$/; //Minimum eight characters, at least one letter and one number
    let regExpEMail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;


}