$("document").ready(function () {
    $("#login_button").click(loginAction);
});

function loginAction() {
    let username = $("#login_username").val();
    let password = $("#login_password").val();
    let errors = loginValidation(username, password);

    if (errors.length == 0) {
        $("#loginErrors").html("");
        $.ajax({
            url: "/api/login",
            method: "POST",
            data: {
                username: username,
                password: password,
            },
            success: function (data) {
                alert(data);
            },
            error: function (xhr, status, error) {
                console.log(xhr);
            },
        });
    } else {
        let errorMessages = "";
        errors.forEach((element) => {
            errorMessages += "<p>" + element + "</p>";
        });
        $("#loginErrors").html(errorMessages);
    }
}

function loginValidation(username, password) {
    let usernameRegex = /^[A-z][A-z0-9\_]{4,20}$/;
    let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    let errors = [];
    if (!usernameRegex.test(username)) {
        errors.push(
            "Username must contain minimum 5 characters,must begin with a letter,can contain letters,numbers and _"
        );
    }
    if (!passwordRegex.test(password)) {
        errors.push(
            "Password must contain minimum eight characters, at least one letter and one number"
        );
    }
    console.log(errors);
    return errors;
}
