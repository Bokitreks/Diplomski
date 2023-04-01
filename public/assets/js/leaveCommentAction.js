$('document').ready(function() {

$('#leaveAComment').on('click',addComment);

});


function addComment() {
    let comment = $('#comment').val();
    let stars = $('#starReview').val();
    let product_id = window.location.href.split('/')[4];
    let username = document.querySelector("#username");
    let userId = username.dataset.value;
    let errors = 0;

    if(stars > 5 || stars < 1) {
        alert("Maksimalan broj zvezdica je 5, minimum je 1");
        errors ++;
    }
    if(comment == "") {
        alert("Komentar ne moze biti prazan");
        errors++;
    }
    if(errors == 0) {
        $.ajax({
            url : "/api/reviews/writeReview",
            method: "POST",
            data: {
                'user_id' : userId,
                'product_id' : product_id,
                "comment" : comment,
                "stars" : stars
            },
            success:function(data) {
                alert(data);
                location.reload();
            },
            error:function(xhr,status,error) {
                console.log(error);
            }
        })
    }
}
