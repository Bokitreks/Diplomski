$("document").ready(function () {
    $('#logut_button').click(logutAction);
});

function logutAction() {
        $.ajax({
            url: "/api/user/logout",
            method: "GET",
            success: function (data,status,xhr) {
                alert(data);
                    window.location.href = '/';
            },
            error: function (xhr, status, error) {
                console.log(xhr);
            },
        });
    }
