$(document).ready(function() {
    populateCartList();
    $('#shippingMethod').on('change', shippingMethodAction);
    recalculateTotal();
    $('#addToCartButton').on('click', confirmOrder);
  });

  function shippingMethodAction() {
    let shippingInfoDiv = $('#shipping-info');
    if (this.value == 1) {
      shippingInfoDiv.css("display", "block");
    } else {
      shippingInfoDiv.css("display", "none");
    }
  }

  function populateCartList() {
    let productIds = JSON.parse(localStorage.getItem('cartProducts'));
    console.log(productIds);
    if (productIds != null && productIds.length > 0) {
      $.ajax({
        url: 'api/products/getProducts',
        method: 'GET',
        data: {
          'productIds': productIds
        },
        success: function(products) {
          console.log(products);
          populateCartListTable(products);
          setupQuantityChangeHandler();
          recalculateTotal();
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    }
  }

  function populateCartListTable(products) {
    let htmlValue = '';
    products.forEach(product => {
      htmlValue += `
        <tr class="cart-item" data-id=${product.id}>
          <td>${product.title}</td>
          <td class="price">${product.price} RSD</td>
          <td><input type="number" min="1" value="1" class="quantity"></td>
          <td class="total">${product.price}</td>
          <td><a onclick="removeItemFromCart(event)" class="remove-item" data-id="${product.id}">X</a></td>
        </tr>`;
    });
    $('#cart-product-list').html(htmlValue);
  }

  function setupQuantityChangeHandler() {
    $('.quantity').on('change', function() {
      const row = $(this).closest('tr');
      const price = parseFloat(row.find('.price').text());
      const quantity = parseInt($(this).val());
      const total = price * quantity;
      row.find('.total').text(total.toFixed(2));
      recalculateTotal();
    });
  }

  function removeItemFromCart(event) {
    let localStorageIds = JSON.parse(localStorage.getItem('cartProducts'));
    var elementToRemove = parseInt(event.target.getAttribute('data-id'));
    elementToRemove = localStorageIds.indexOf(elementToRemove);
    if (elementToRemove !== -1) {
      localStorageIds.splice(elementToRemove, 1);
    } else {
      console.log('Element not found');
    }

    localStorage.setItem('cartProducts', JSON.stringify(localStorageIds));

    if (localStorageIds.length === 0) {
      $('.cart-total').text('0.00');
    }

    recalculateTotal();
    location.reload();
  }

  function recalculateTotal() {
    let overallTotal = 0;
    $('.total').each(function() {
      overallTotal += parseFloat($(this).text());
    });
    $('.cart-total').text(overallTotal.toFixed(2));
  }

  function confirmOrder() {
    let productIds = JSON.parse(localStorage.getItem('cartProducts'));
    let shippingMethod = $('#shippingMethod').val();
    if(productIds && productIds.length > 0) {
    let cartItems = [];
    let username = document.querySelector("#username");
    let userId = username.dataset.value;
    productIds.forEach(productId => {
        const quantity = parseInt($('#cart-product-list').find(`[data-id="${productId}"] .quantity`).val());
        const total = parseFloat($('#cart-product-list').find(`[data-id="${productId}"] .total`).text());
        cartItems.push({ productId, quantity, total });
    });
    if(shippingMethod == 0) {
        $.ajax({
            url: 'api/products/confirmOrderWithoutShipping',
            method: 'POST',
            data: {
                'userId' : userId,
                'cartItems': cartItems,
            },
            success: function(response) {
              console.log(response);
              alert('Potvrdjena porudzbina !');
              localStorage.removeItem('cartProducts');
              location.reload();
            },
            error: function(xhr, status, error) {
              console.log(error);
              alert('Greska prilikom potvrde, pokusajte ponovo');
            }
          });
    } else {
        let name = $('#cartName').val();
        let city = $('#cartCity').val();
        let address = $('#cartAddress').val();
        let comment = $('#cartComment').val();

        $.ajax({
            url: 'api/products/confirmOrderWithShipping',
            method: 'POST',
            data: {
                'userId' : userId,
                'name' : name,
                'city' : city,
                'address' : address,
                'comment' : comment,
                'cartItems': cartItems,
            },
            success: function(response) {
              console.log(response);
              alert('Potvrdjena porudzbina !');
              localStorage.removeItem('cartProducts');
              location.reload();
            },
            error: function(xhr, status, error) {
              console.log(error);
              alert('Greska prilikom potvrde, pokusajte ponovo');
            }
          });
    }
    }
    else {
        alert('Korpa je prazna!');
    }
  }
