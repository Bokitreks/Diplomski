$(document).ready(function() {
    let filter = localStorage.getItem('filter') || 'sviProizvodi';
    let sort = localStorage.getItem('sort') || 1;
    $('#sort').val(sort);

    loadProducts(filter, sort);
    getAllCategories();

    $('#sort').on('change', function() {
        sort = this.value;
        localStorage.setItem('sort', sort);
        loadProducts(filter, sort);
    });

    $(document).on('click', '.productCategoryLink', function(e) {
        e.preventDefault();
        filter = $(this).attr('id');
        localStorage.setItem('filter', filter);
        loadProducts(filter, sort);
    });
});

function loadProducts(filter, sort) {
    $.ajax({
        url: "/api/products/sortProducts",
        method: "POST",
        data: {
            'filter': filter,
            'sort': sort
        },
        success: function(data) {
            printProducts(data);
        },
        error: function(xhr, status, error) {
            console.log(xhr);
        },
    });
}

function printProducts(data) {
    let mainBlock = $('#main-products-block');
    let print = '';
    data.forEach(product => {
        let starCount = 5;
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
                                starCount--;
                            }
                            if(starCount != 0) {
                                for(let i=0;i<starCount;i++) {
                                    print += '<li><i class="fa fa-star-o"></i></li>'
                                }
                            }
                            print += `</ul>
                            <span> Komentari (${product.reviews.length}) </span>
                        </div>
                    </div>
                </div>`;
    });
    mainBlock.html(print);
}

function sortProducts() {
    let filter = localStorage.getItem('filter');
    let sort = localStorage.getItem('sort');
    $.ajax({
        url: "/api/products/sortProducts",
        method: "POSt",
        data: {
            'filter' : filter,
            'sort' : sort
        },
        success: function (data) {
            printProducts(data);
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        },
    });
}

function getAllCategories() {
    $.ajax({
        url: "/api/categories/getAllCategories",
        method: "GET",
        success: function (data) {
            loadCategories(data);
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        },
    });
}

function loadCategories(data) {
    let categoriesList = $('#categories-list');
    let print = ' <li><a href="" class="productCategoryLink" id="0">Svi prozivodi</a></li>';
    data.forEach(category => {
        print += ` <li><a href="" class="productCategoryLink" id=${category.id}>${category.category_name}</a></li>`;
    });
    categoriesList.html(print);
}
