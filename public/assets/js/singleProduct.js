$('document').ready(function() {

$('#leaveAComment').on('click', addComment);
$('#addToCartButton').on('click', addToCart);
$('.deleteCommentButton').on('click', deleteReview);
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

function addToCart() {
    let productId = $(this).data("id");

    let cartProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];
    let maxQuantity = parseInt($(this).data("quantity"));

    let productExists = false;

    cartProducts.forEach(cartProduct => {
        console.log(cartProduct);
        if (cartProduct[0] == productId) {
            alert('Proizvod vec postoji u korpi');
            productExists = true;
            return false;
        }
    });

    if (!productExists) {
        cartProducts.push([productId, maxQuantity]);
        localStorage.setItem('cartProducts', JSON.stringify(cartProducts));
        alert('Proizvod dodat u korpu');
    }
}

function deleteReview() {
    var reviewId = $(this).data("review-id");
    $.ajax({
        url: '/api/reviews/deleteReview',
        method: 'DELETE',
        data: { "reviewId" : reviewId },
        success: function (response) {
            alert(response);
            location.reload();
        },
        error: function (xhr, status, error) {
            alert(xhr);
        }
    });
}





