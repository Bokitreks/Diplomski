$("document").ready(function () {
    $("#register_button").click(registerAction);
});

function registerAction() {
    let username = $("#register_username").val();
    let password = $("#register_password").val();
    let email = $("#register_email").val();
    let errors = registerValidation(username, password, email);

    if (errors.length == 0) {
        $("#registerErrors").html("");
        $.ajax({
            url: "/api/user/register",
            method: "POST",
            data: {
                username: username,
                password: password,
                email: email,
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
        $("#registerErrors").html(errorMessages);
    }
}

function registerValidation(username, password, email) {
    let usernameRegex = /^[A-z][A-z0-9\_]{4,20}$/;
    let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    let emailRegex = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
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
    if (!emailRegex.test(email)) {
        errors.push("Invalid email");
    }

    return errors;
}
