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
                window.location.href = '/login';
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
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
            "Korisnicko ime mora sazdrzati minimum 5 karaktera,mora poceti slovom,moze sadrzati slova,brojeve i _"
        );
    }
    if (!passwordRegex.test(password)) {
        errors.push(
            "Sifra mora imati minimum 8 karaktera, mora sadrzati bar 1 slovo i 1 broj"
        );
    }
    if (!emailRegex.test(email)) {
        errors.push("Neispravna email adresa");
    }

    return errors;
}
