$(document).ready(function() {
    getAllUsers();
    getAllCategories();
    getAllProducts();

    $('#users-table').on('click', '.edit-btn', function() {
        var hiddenForm = $(this).closest('tr').next().find('.hidden-form');
        if (hiddenForm.is(":hidden")) {
            // Show the hidden form
            hiddenForm.show();
        } else {
            // Hide the hidden form
            hiddenForm.hide();
        }
    });

    $('#categories-table').on('click', '.edit-btn', function() {
        var hiddenForm = $(this).closest('tr').next().find('.hidden-form');
        if (hiddenForm.is(":hidden")) {
            // Show the hidden form
            hiddenForm.show();
        } else {
            // Hide the hidden form
            hiddenForm.hide();
        }
    });

    $('#addProductBtn').click(function() {
        var hiddenForm = $('#addProductForm');
        if (hiddenForm.is(":hidden")) {
            hiddenForm.show();
            getAllCategories();
            getAllColors();
            getAllWarehouses();
            getAllManufacturers();
            getAllMaterials();
            getAllCategoriesForAddProduct();
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
                        <label for="editRoleId${user.id}">Uloga</label>
                        <input type="text" class="form-control" id="editRoleId${user.id}" value='${user.role_id}'>
                    </div>
                    <button type="button" class="btn btn-primary editUserButton" data-user-id="${user.id}">Sacuvaj</button>
                </form>
            </div>
        </td>
        </tr>`;
    });

    usersTable.html(data);

// Define the event handler for edit buttons outside of the populateUsersTable function
$('.editUserButton').click(function() {
    var userId = $(this).data('user-id');
    var newName = $('#editName' + userId).val();
    var newPassword = $('#editPassword' + userId).val();
    var newEmail = $('#editEmail' + userId).val();
    var newRoleId = $('#editRoleId' + userId).val();
    var csrfTokenInput = document.querySelector('input[name="_token"]');
    var csrfToken = csrfTokenInput.value;


    // Check if newPassword field is not empty
    if (newPassword.trim() === '') {
        // If newPassword is empty, exclude it from the data
        var data = {
            '_token': csrfToken,
            'userId': userId,
            'username': newName,
            'email': newEmail,
            'role_id': newRoleId,
        };
    } else {
        // If newPassword is not empty, include it in the data
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

// Add a click event handler for the delete buttons
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
        url: 'api/user/addUser', // Update the URL to the endpoint for adding a new user
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

    // Define the event handler for edit buttons outside of the populateUsersTable function
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

// Add a click event handler for the delete buttons
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
        url: 'api/categories/addCategory', // Update the URL to the endpoint for adding a new user
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
    console.log(products);
    products.forEach(product => {
        data += `
        <tr>
        <td>${product.id}</td>
        <td>${product.title}</td>
        <td>${product.description}</td>
        <td>${product.price} RSD</td>
        <td>${product.category.category_name}</td>
        <td>${product.manufacturer.manufacturer_name}</td>
        <td>${product.color.color}</td>

        <td>`
        product.materials.forEach((material, index) => {
            data += material.material;
            if (index < product.materials.length - 1) {
                data += ',';
            }
        });
        data +=  `</td>
        <td>999</td>
        <td>
          <img src="${product.images[0].href}" alt="Product A Thumbnail" width="50">
        </td>
        <td>
          <button class="btn btn-sm btn-primary edit-btn">Izmeni</button>
          <button class="btn btn-sm btn-danger delete-btn" data-product-id="${product.id}">Obrisi</button>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <div class="hidden-form" style="display: none;">
            <h4>Edit Product</h4>
            <form>
              <div class="form-group">
                <label for="editName">Name</label>
                <input type="text" class="form-control" id="editName">
              </div>
              <div class="form-group">
                <label for="editPrice">Price</label>
                <input type="text" class="form-control" id="editPrice">
              </div>
              <div class="form-group">
                <label for="editCategory">Category</label>
                <input type="text" class="form-control" id="editCategory">
              </div>
              <div class="form-group">
                <label for="editImage">Image Thumbnail</label>
                <input type="file" class="form-control-file" id="editImage">
                <small class="form-text text-muted">Choose a new image for the product.</small>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </td>
      </tr>`
    });

    productsTable.html(data);

$('#products-table').on('click', '.delete-btn', function() {
    var productId = $(this).data('product-id');
    var csrfTokenInput = document.querySelector('input[name="_token"]');
    var csrfToken = csrfTokenInput.value;

    if (confirm("Jel ste sigurni da zelite da obrisete proizvod?")) {
        $.ajax({
            url: 'api/products/deleteProduct',
            method: 'DELETE',
            data: {
                '_token': csrfToken,
                'productId': productId,
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

function getAllManufacturers() {
    let manufacturerSelect = $('#newManufacturerSelect');
    $.ajax({
        url: 'api/manufacturers/getAllManufacturers',
        method: 'GET',
        success: function(manufacturers) {
            let data = '';
            manufacturers.forEach(manufacturer => {
                data += `<option value="${manufacturer.id}">${manufacturer.manufacturer_name}</option>`;
            });
            manufacturerSelect.html(data);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function getAllColors() {
    let colorSelect = $('#newColorSelect');
    $.ajax({
        url: 'api/colors/getAllColors',
        method: 'GET',
        success: function(colors) {
            let data = '';
            colors.forEach(color => {
                data += `<option value="${color.id}">${color.color}</option>`;
            });
            colorSelect.html(data);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function getAllMaterials() {
    let materialSelect = $('#newMaterialSelect');
    $.ajax({
        url: 'api/materials/getAllMaterials',
        method: 'GET',
        success: function(materials) {
            console.log(materials);
            let data = '';
            materials.forEach(material => {
                data += `<option value="${material.id}">${material.material}</option>`;
            });
            materialSelect.html(data);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function getAllWarehouses() {
    let warehouseSelect = $('#newWarehouseSelect');
    $.ajax({
        url: 'api/warehouses/getAllWarehouses',
        method: 'GET',
        success: function(warehouses) {
            let data = '';
            warehouses.forEach(warehouse => {
                data += `<option value="${warehouse.id}">${warehouse.warehouse_name}</option>`;
            });
            warehouseSelect.html(data);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function getAllCategoriesForAddProduct() {
    let categoriesSelect = $('#newCategorySelect');
    $.ajax({
        url: 'api/categories/getAllCategories',
        method: 'GET',
        success: function(categories) {
            let data = '';
            categories.forEach(category => {
                data += `<option value="${category.id}">${category.category_name}</option>`;
            });
            categoriesSelect.html(data);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
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


