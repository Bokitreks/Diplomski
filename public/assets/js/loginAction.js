$("document").ready(function () {
    $("#login_button").click(loginAction);
});

function loginAction() {
    let username = $("#login_username").val();
    let password = $("#login_password").val();
    let errors = loginValidation(username, password);
    let token = document.getElementsByName("_token")[0].value;

    if (errors.length == 0) {
        $("#loginErrors").html("");
        $.ajax({
            url: "/api/user/login",
            method: "POST",
            data: {
                username: username,
                password: password,
                _token: "{{ csrf_token() }}"
            },
            success: function (data,status,xhr) {
                alert(data);
                if(xhr.status == 202) {
                    window.location.href = '/';
                }
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
            "Korisnicko ime mora sazdrzati minimum 5 karaktera,mora poceti slovom,moze sadrzati slova,brojeve i _"
        );
    }
    if (!passwordRegex.test(password)) {
        errors.push(
            "Sifra mora imati minimum 8 karaktera, mora sadrzati bar 1 slovo i 1 broj"
        );
    }
    console.log(errors);
    return errors;
}
