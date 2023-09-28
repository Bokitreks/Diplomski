$(document).ready(function() {
    getAllUsers();
    getAllCategories();
    getAllProducts();
    getAllCarts();

    $('#users-table').on('click', '.edit-btn', function() {
        var hiddenForm = $(this).closest('tr').next().find('.hidden-form');
        if (hiddenForm.is(":hidden")) {

            hiddenForm.show();
        } else {
            hiddenForm.hide();
        }
    });

    $('#categories-table').on('click', '.edit-btn', function() {
        var hiddenForm = $(this).closest('tr').next().find('.hidden-form');
        if (hiddenForm.is(":hidden")) {
            hiddenForm.show();
        } else {
            hiddenForm.hide();
        }
    });

    $('#products-table').on('click', '.edit-btn', function() {
        var hiddenForm = $(this).closest('tr').next().find('.hidden-form');
        if (hiddenForm.is(":hidden")) {
            hiddenForm.show();
        } else {
            hiddenForm.hide();
        }
    });

    $('#cart-table').on('click', '.edit-btn', function() {
        var hiddenForm = $(this).closest('tr').next().find('.hidden-form');
        if (hiddenForm.is(":hidden")) {
            hiddenForm.show();
        } else {
            hiddenForm.hide();
        }
    });

    $('#addProductBtn').click(function() {
        var hiddenForm = $('#addProductForm');
        if (hiddenForm.is(":hidden")) {
            hiddenForm.show();
            getAllCategories();
            populateColors();
            populatelWarehouses();
            populateManufacturers();
            populateMaterials();
            populateCategoriesForAddProduct();
            getAllWarehouses();
        } else {
            hiddenForm.hide();
        }
    });

    $('#addUserBtn').click(function() {
        var hiddenForm = $('#addUserForm');
        if (hiddenForm.is(":hidden")) {
            hiddenForm.show();
        } else {
            hiddenForm.hide();
        }
    });

    $('#addCategoryBtn').click(function() {
        var hiddenForm = $('#addCategoryForm');
        if (hiddenForm.is(":hidden")) {
            hiddenForm.show();
        } else {
            hiddenForm.hide();
        }
    });
});

function getAllUsers() {
    $.ajax({
        url: 'api/user/getAllUsers',
        method: 'GET',
        success: function(users) {
            populateUsersTable(users);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function populateUsersTable(users) {
    let usersTable = $('#users-table');
    let data = ``;
    users.forEach(user => {
        data += `<tr>
        <td>${user.id}</td>
        <td>${user.username}</td>
        <td>${user.password}</td>
        <td>${user.email}</td>
        <td>${user.role_id}</td>
        <td>
            <button class="btn btn-sm btn-primary edit-btn">Izmeni</button>
            <button class="btn btn-sm btn-danger delete-btn" data-user-id="${user.id}">Obrisi</button>
        </td>
        </tr>
        <tr>
        <td colspan="6">
            <div class="hidden-form" style="display: none;">
                <h4>Izmeni korisnika</h4>
                <form>
                    <div class="form-group">
                        <label for="editName${user.id}">Ime</label>
                        <input type="text" class="form-control" id="editName${user.id}" value='${user.username}'>
                        <label for="editPassword${user.id}">Lozinka</label>
                        <input type="text" class="form-control" id="editPassword${user.id}">
                        <label for="editEmail${user.id}">Email</label>
                        <input type="text" class="form-control" id="editEmail${user.id}" value='${user.email}'>
                        <label for="editRoleId${user.id}">Uloga (1-korisnik/2-administrator)</label>
                        <input type="text" class="form-control" id="editRoleId${user.id}" value='${user.role_id}'>
                    </div>
                    <button type="button" class="btn btn-primary editUserButton" data-user-id="${user.id}">Sacuvaj</button>
                </form>
            </div>
        </td>
        </tr>`;
    });

    usersTable.html(data);

$('.editUserButton').click(function() {
    var userId = $(this).data('user-id');
    var newName = $('#editName' + userId).val();
    var newPassword = $('#editPassword' + userId).val();
    var newEmail = $('#editEmail' + userId).val();
    var newRoleId = $('#editRoleId' + userId).val();
    var csrfTokenInput = document.querySelector('input[name="_token"]');
    var csrfToken = csrfTokenInput.value;


    if (newPassword.trim() === '') {
        var data = {
            '_token': csrfToken,
            'userId': userId,
            'username': newName,
            'email': newEmail,
            'role_id': newRoleId,
        };
    } else {
        var data = {
            '_token': csrfToken,
            'userId': userId,
            'username': newName,
            'newPassword': newPassword,
            'email': newEmail,
            'role_id': newRoleId,
        };
    }

    $.ajax({
        url: 'api/user/editUser',
        method: 'POST',
        data: data,
        success: function(response) {
            console.log(response);
            alert(response);
            location.reload();
        },
        error: function(xhr, status, error) {
            console.log(error);
            alert(xhr.responseText);
        }
    });
});

$('#users-table').on('click', '.delete-btn', function() {
    var userId = $(this).data('user-id');
    var csrfTokenInput = document.querySelector('input[name="_token"]');
    var csrfToken = csrfTokenInput.value;

    if (confirm("Jel ste sigurni da zelite da obrisete korisnika?")) {
        $.ajax({
            url: 'api/user/deleteUser',
            method: 'POST',
            data: {
                '_token': csrfToken,
                'userId': userId,
            },
            success: function(response) {
                console.log(response);
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert(xhr.responseText);
            }
        });
    }
});

}

$('#addNewUserButton').click(function() {
    var newName = $('#newName').val();
    var newPassword = $('#newPassword').val();
    var newEmail = $('#newEmail').val();
    var newRoleId = $('#newRoleId').val();
    var csrfTokenInput = document.querySelector('input[name="_token"]');
    var csrfToken = csrfTokenInput.value;

    var data = {
        '_token': csrfToken,
        'username': newName,
        'password': newPassword,
        'email': newEmail,
        'role_id': newRoleId,
    };

    $.ajax({
        url: 'api/user/addUser',
        method: 'POST',
        data: data,
        success: function(response) {
            console.log(response);
            alert(response);
            location.reload();
        },
        error: function(xhr, status, error) {
            console.log(error);
            alert(xhr.responseText);
        }
    });
});

function getAllCategories() {
    $.ajax({
        url: 'api/categories/getAllCategories',
        method: 'GET',
        success: function(catrgories) {
            console.log(catrgories);
            populateCategoriesTable(catrgories);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function populateCategoriesTable(catrgories) {
    let categoriesTable = $('#categories-table');
    let data = ``;
    catrgories.forEach(category => {
        data += `<tr>
        <td>${category.id}</td>
        <td>${category.category_name}</td>
        <td>
            <button class="btn btn-sm btn-primary edit-btn">Izmeni</button>
            <button class="btn btn-sm btn-danger delete-btn" data-category-id="${category.id}">Obrisi</button>
        </td>
        </tr>
        <tr>
        <td colspan="6">
            <div class="hidden-form" style="display: none;">
                <h4>Izmeni kategoriju</h4>
                <form>
                    <div class="form-group">
                        <label for="editName${category.id}">Ime</label>
                        <input type="text" class="form-control" id="editCategoryName${category.id}" value='${category.category_name}'>
                    </div>
                    <button type="button" class="btn btn-primary editCategoryButton" data-category-id="${category.id}">Sacuvaj</button>
                </form>
            </div>
        </td>
        </tr>`;
    });

    categoriesTable.html(data);

$('.editCategoryButton').click(function() {
    var categoryId = $(this).data('category-id');
    var newCategoryName = $('#editCategoryName' + categoryId).val();
    var csrfTokenInput = document.querySelector('input[name="_token"]');
    var csrfToken = csrfTokenInput.value;

    console.log(categoryId, newCategoryName);
    var data = {
        '_token': csrfToken,
        'categoryId': categoryId,
        'newCategoryName': newCategoryName,
    };

    $.ajax({
        url: 'api/categories/editCategory',
        method: 'POST',
        data: data,
        success: function(response) {
            console.log(response);
            alert(response);
            location.reload();
        },
        error: function(xhr, status, error) {
            console.log(error);
            alert(xhr.responseText);
        }
    });
});

$('#categories-table').on('click', '.delete-btn', function() {
    var categoryId = $(this).data('category-id');
    var csrfTokenInput = document.querySelector('input[name="_token"]');
    var csrfToken = csrfTokenInput.value;

    if (confirm("Jel ste sigurni da zelite da obrisete kategoriju, bice obrisani i svi proizvodi koji njoj pripadaju?")) {
        $.ajax({
            url: 'api/categories/deleteCategory',
            method: 'DELETE',
            data: {
                '_token': csrfToken,
                'categoryId': categoryId,
            },
            success: function(response) {
                console.log(response);
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert(xhr.responseText);
            }
        });
    }
});
}

$('#addNewCategoryButton').click(function() {
    var newCategoryName = $('#newCategoryName').val();
    var csrfTokenInput = document.querySelector('input[name="_token"]');
    var csrfToken = csrfTokenInput.value;

    var data = {
        '_token': csrfToken,
        'newCategoryName': newCategoryName,
    };

    $.ajax({
        url: 'api/categories/addCategory',
        method: 'POST',
        data: data,
        success: function(response) {
            console.log(response);
            alert(response);
            location.reload();
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            alert(xhr.responseText);
        }
    });
});

function getAllProducts() {
    $.ajax({
        url: 'api/products/getAllProducts',
        method: 'GET',
        success: function(products) {
            console.log(products);
            populateProductsTable(products);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function populateProductsTable(products) {
    var productsTable = $('#products-table');
    var data = '';

    products.forEach(product => {
      var quantityCount = 0;

      product.warehouse_products.forEach(warehouseProduct => {
        quantityCount += warehouseProduct.pivot.quantity;
      });

      data += `
        <tr>
          <td>${product.id}</td>
          <td>${product.title}</td>
          <td>${product.description}</td>
          <td>${product.price} RSD</td>
          <td>${product.category.category_name}</td>
          <td>${product.manufacturer.manufacturer_name}</td>
          <td>${product.color.color}</td>
          <td>`;

      product.materials.forEach((material, index) => {
        data += material.material;
        if (index < product.materials.length - 1) {
          data += ', ';
        }
      });

      data += `</td>
          <td>${quantityCount}</td>
          <td>
            <img src="${product.images[0].href}" alt="Product Thumbnail" width="50">
          </td>
          <td>
            <button class="btn btn-sm btn-primary edit-btn" data-product-id="${product.id}">Izmeni</button>
            <button class="btn btn-sm btn-danger delete-btn" data-product-id="${product.id}">Obrisi</button>
          </td>
        </tr>
        <tr class="edit-form-row" data-product-id="${product.id}">
          <td colspan="6">
            <div class="hidden-form" style="display: none;">
              <h4>Izmeni proizvod</h4>
              <form>
                <div class="form-group">
                  <label for="productName">Naziv</label>
                  <input type="text" class="form-control" id="editProductName_${product.id}" value="${product.title}">
                </div>
                <div class="form-group">
                  <label for="productDescription">Opis</label>
                  <textarea class="form-control" id="editProductDescription_${product.id}">${product.description}</textarea>
                </div>
                <div class="form-group">
                  <label for="productPrice">Cena</label>
                  <input type="text" class="form-control" id="editProductPrice_${product.id}" value="${product.price}">
                </div>`;

      product.warehouse_products.forEach(warehouseProduct => {
        var quantityCount = warehouseProduct.pivot.quantity;

        data += `
                <div class="form-group">
                  <label for="editProductStock_${product.id}">Magacin - ${warehouseProduct.warehouse_name}</label>
                  <input type="text" class="form-control" id="editProductStock_${product.id}" value="${quantityCount}">
                </div>`;
      });

      data += `
                <div class="form-group">
                  <label for="productImage">Image Thumbnail</label>
                  <input type="file" class="form-control-file" id="productImage_${product.id}">
                  <small class="form-text text-muted">Choose a new image for the product.</small>
                </div>
                <button type="button" class="btn btn-primary editProductButton" data-product-id="${product.id}">Izmeni proizvod</button>
              </form>
            </div>
          </td>
        </tr>`;
    });

    productsTable.html(data);

    $('.delete-btn').click(function () {
      var productId = $(this).data('product-id');
      var csrfTokenInput = document.querySelector('input[name="_token"]');
      var csrfToken = csrfTokenInput.value;

      if (confirm("Jeste li sigurni da zelite da obrisete proizvod?")) {
        $.ajax({
          url: 'api/products/deleteProduct',
          method: 'DELETE',
          data: {
            '_token': csrfToken,
            'productId': productId,
          },
          success: function (response) {
            console.log(response);
            alert(response);
            location.reload();
          },
          error: function (xhr, status, error) {
            console.log(error);
            alert(xhr.responseText);
          }
        });
      }
    });

    // Add event listener for edit product button
    $('.editProductButton').click(function () {
      var productId = $(this).data('product-id');
      var productName = $('#editProductName_' + productId).val();
      var productDescription = $('#editProductDescription_' + productId).val();
      var productPrice = $('#editProductPrice_' + productId).val();
      var productStock = $('#editProductStock_' + productId).val();
      var productImageField = $('#productImage_' + productId)[0];

      var updatedProduct = new FormData();
      updatedProduct.append('id', productId);
      updatedProduct.append('title', productName);
      updatedProduct.append('description', productDescription);
      updatedProduct.append('price', productPrice);
      updatedProduct.append('quantity', productStock);

      if (productImageField.files[0]) {
        updatedProduct.append('productImage', productImageField.files[0]);
      }

      $.ajax({
        url: 'api/products/updateProduct',
        method: 'POST',
        processData: false,
        contentType: false,
        data: updatedProduct,
        success: function (response) {
          console.log(response);
          alert(response);
          location.reload();
        },
        error: function (xhr, status, error) {
          console.log(error);
          alert(xhr.responseText);
        }
      });
    });
  }


function getAllManufacturers() {
    let manufacturers =  $.ajax({
        url: 'api/manufacturers/getAllManufacturers',
        method: 'GET',
        success: function(manufacturers) {
            return manufacturers;
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
    return manufacturers;
}

function populateManufacturers() {
    let manufacturers =  getAllManufacturers()
    .then(function(manufacturers) {
        let manufacturerSelect = $('#newManufacturerSelect');
        let data = '';
        manufacturers.forEach(manufacturer => {
            data += `<option value="${manufacturer.id}">${manufacturer.manufacturer_name}</option>`;
        });
        manufacturerSelect.html(data);
    })
    .catch(function(error) {
        console.log(error);
    });
}

function getAllColors() {
    let allColors =
    $.ajax({
        url: 'api/colors/getAllColors',
        method: 'GET',
        success: function(colors) {
            return colors;
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });

    return allColors;
}

function populateColors() {
    let colors =  getAllColors()
    .then(function(colors) {
    let colorSelect = $('#newColorSelect');
    let data = '';
    colors.forEach(color => {
        data += `<option value="${color.id}">${color.color}</option>`;
    });
    colorSelect.html(data);
    })
    .catch(function(error) {
        console.log(error);
    });
}

function getAllMaterials() {
    let materials =
    $.ajax({
        url: 'api/materials/getAllMaterials',
        method: 'GET',
        success: function(materials) {
            return materials;
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
    return materials;
}

function populateMaterials() {
    let materials =  getAllMaterials()
    .then(function(materials) {
    let materialSelect = $('#newMaterialSelect');
    let data = '';
    materials.forEach(material => {
        data += `<option value="${material.id}">${material.material}</option>`;
    });
    materialSelect.html(data);
    })
    .catch(function(error) {
        console.log(error);
    });
}

function getAllWarehouses() {
    let warehouses =
    $.ajax({
        url: 'api/warehouses/getAllWarehouses',
        method: 'GET',
        success: function(warehouses) {
            return warehouses;
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
    return warehouses;
}

function populatelWarehouses() {
    let warehouses =  getAllWarehouses()
    .then(function(warehouses) {
    let warehouseSelect = $('#newWarehouseSelect');
    let data = '';
    warehouses.forEach(warehouse => {
        data += `<option value="${warehouse.id}">${warehouse.warehouse_name}</option>`;
    });
    warehouseSelect.html(data);
    })
    .catch(function(error) {
        console.log(error);
    });
}

function getAllCategoriesForAddProduct() {
    let categories =
    $.ajax({
        url: 'api/categories/getAllCategories',
        method: 'GET',
        success: function(categories) {
            return categories;
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
    return categories;
}

function populateCategoriesForAddProduct() {
    let categories = getAllCategoriesForAddProduct()
    .then(function(categories) {
    let categoriesSelect = $('#newCategorySelect');
    let data = '';
    categories.forEach(category => {
        data += `<option value="${category.id}">${category.category_name}</option>`;
    });
    categoriesSelect.html(data);
})
.catch(function(error) {
    console.log(error);
});
}

$('#addNewProductButton').click(function() {
    var productName = $('#newProductName').val();
    var productDescription = $('#newProductDescription').val();
    var productPrice = $('#newPrice').val();
    var productCategory = $('#newCategorySelect').val();
    var productManufacturer = $('#newManufacturerSelect').val();
    var productColor = $('#newColorSelect').val();
    var productMaterials = $('#newMaterialSelect').val();
    var productWarehouse = $('#newWarehouseSelect').val();
    var productStock = $('#newStock').val();
    var productImage = $('#newImage')[0].files[0];

    var data = new FormData();
    data.append('productName', productName);
    data.append('productDescription', productDescription);
    data.append('productPrice', productPrice);
    data.append('productCategory', productCategory);
    data.append('productManufacturer', productManufacturer);
    data.append('productColor', productColor);
    data.append('productMaterials', productMaterials);
    data.append('productWarehouse', productWarehouse);
    data.append('productStock', productStock);
    data.append('productImage', productImage);
    console.log(data);
    $.ajax({
        url: 'api/products/addNewProduct',
        method: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            alert(response);
            location.reload();
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            alert(xhr.responseText);
        }
    });
});

function getAllCarts() {
    $.ajax({
        url: 'api/carts/getAllCarts',
        method: 'GET',
        success: function(carts) {
            populateCartsTable(carts);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function populateCartsTable(carts) {
    let cartTable = $('#cart-table');
    let data = '';

    carts.forEach(cart => {
      data += `<tr>`
      const createdAt = new Date(cart.created_at);
      const formattedDate = createdAt.toLocaleDateString('en-GB');
      data += ` <td>${formattedDate}</td>`
      data += `  <td>${cart.id}</td>
        <td>${cart.user.username}</td>
        <td>${cart.product.title}</td>
        <td>${cart.quantity}</td>`;

      if (cart.shipping == 0) {
        data += `<td>U radnji</td>`;
      } else {
        data += `<td>Dostava (Adresa : ${cart.user.shipping_info.address} ,${cart.user.shipping_info.city}) </td>`;
      }

      if (cart.is_payed == 0) {
        data += `<td>Nije</td>`;
      } else {
        data += `<td>Jeste</td>`;
      }

      if (cart.is_finished == 0) {
        data += `<td>Nije</td>`;
      } else {
        data += `<td>Jeste</td>`;
      }

      data += `
        <td>
          <button class="btn btn-sm btn-primary edit-btn">Izmeni</button>
          <button class="btn btn-sm btn-danger delete-btn" data-cart-product-id="${cart.product.id}"  data-cart-quantity="${cart.quantity}" data-cart-id="${cart.id}" >Obrisi</button>
        </td>
      </tr>
      <tr class="edit-form-row" data-cart-id="${cart.id}">
        <td colspan="6">
          <div class="hidden-form" style="display: none;">
            <h4>Izmeni narudzbenicu</h4>
            <form>
              <div class="form-group">
                <label for="editCartPayment_${cart.id}">Placeno</label>
                <select id="editCartIsPayed_${cart.id}">
                  <option value="0">Nije placeno</option>
                  <option value="1">Placeno</option>
                </select>
              </div>
              <div class="form-group">
                <label for="editCartShipping_${cart.id}">Isporuceno</label>
                <select id="editCartShipping_${cart.id}">
                  <option value="0">Nije isporuceno</option>
                  <option value="1">Isporuceno</option>
                </select>
              </div>
              <button type="button" class="btn btn-primary editCartButton" data-cart-id="${cart.id}">Sacuvaj</button>
            </form>
          </div>
        </td>
      </tr>`;
    });

    cartTable.html(data);

    $('#cart-table').on('click', '.delete-btn', function() {
      var cartId = $(this).data('cart-id');
      var quantity = $(this).data('cart-quantity');
      var productId = $(this).data('cart-product-id');
      var csrfTokenInput = document.querySelector('input[name="_token"]');
      var csrfToken = csrfTokenInput.value;

      if (confirm("Jel ste sigurni da zelite da obrisete narudzbenicu?")) {
        $.ajax({
          url: 'api/carts/deleteCart',
          method: 'DELETE',
          data: {
            '_token': csrfToken,
            'cartId': cartId,
            'quantity': quantity,
            'productId': productId
          },
          success: function(response) {
            console.log(response);
            alert(response);
            location.reload();
          },
          error: function(xhr, status, error) {
            console.log(error);
            alert(xhr.responseText);
          }
        });
      }
    });

    $('.editCartButton').click(function() {
      var cartId = $(this).data('cart-id');
      var is_finished = $('#editCartShipping_' + cartId).val();
      var is_payed = $('#editCartIsPayed_' + cartId).val();

      var updatedCart = new FormData();
      updatedCart.append('id', cartId);
      updatedCart.append('is_finished', is_finished);
      updatedCart.append('is_payed', is_payed);

      $.ajax({
        url: 'api/carts/updateCart',
        method: 'POST',
        data: updatedCart,
        processData: false,
        contentType: false,
        success: function(response) {
          console.log(response);
          alert(response);
          location.reload();
        },
        error: function(xhr, status, error) {
          console.log(error);
          alert(xhr.responseText);
        }
      });
    });
  }

