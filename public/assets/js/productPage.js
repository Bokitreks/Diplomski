$('document').ready(function() {
    $('#getAllProducts').on('click',getAllProducts);
    $('#getSigurnosnaVrata').on('click',getSigurnosnaVrata);
    $('#getSobnaVrata').on('click',getSobnaVrata);
    $('#getPvcStolarija').on('click',getPvcStolarija);
});

function getAllProducts(e) {
    e.preventDefault();
    $.ajax({
        url: "/api/products/getAllProducts",
        method: "GET",
        success: function (data) {
            printProducts(data);
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        },
    });
}

function getSigurnosnaVrata(e) {
    e.preventDefault();
    $.ajax({
        url: "/api/products/getSigurnosnaVrata",
        method: "GET",
        success: function (data) {
            printProducts(data);
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        },
    });
}

function getSobnaVrata(e) {
    e.preventDefault();
    $.ajax({
        url: "/api/products/getSobnaVrata",
        method: "GET",
        success: function (data) {
            printProducts(data);
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        },
    });
}

function getPvcStolarija(e) {
    e.preventDefault();
    $.ajax({
        url: "/api/products/getPvcStolarija",
        method: "GET",
        success: function (data) {
            printProducts(data);
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        },
    });
}

function printProducts(data) {
    let mainBlock = $('#main-products-block');
    let print = '';
    data.forEach(product => {
        print += `<div class="col-lg-4 col-md-4 all des">
                    <div class="product-item">
                        <a href="/products/${product.id}"><img src="${product.images[0].href}" alt=""></a>
                        <div class="down-content">
                            <a href="/products/${product.id}"><h4>${product.title}</h4></a>
                            <h6>${product.price} RSD</h6>
                            <p>${product.description}</p>
                            <ul class="stars">`
                            for(let i=0; i< Math.round(product.avarageStar); i++) {
                                print += ` <li><i class="fa fa-star"></i></li>`
                            }
                            print += `</ul>
                            <span> Komentari (${product.reviews.length}) </span>
                        </div>
                    </div>
                </div>`;
    });
    mainBlock.html(print);
}
