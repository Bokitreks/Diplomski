<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Admin Panel</a>
</nav>

<div class="container mt-4">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#users">Upravljanje korisnicima</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#products">Upravljanje proizvodima</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#categories">Upravljanje kategorijama</a>
      </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#pages">Upravljanje narudzbenicama</a>
    </li>
  </ul>

  <div class="tab-content mt-4">

    <div class="tab-pane fade show active" id="users">
        @csrf
        <h2>Upravljanje korisnicima</h2>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Korisnicko ime</th>
              <th>Lozinka</th>
              <th>Email</th>
              <th>Uloga</th>
              <th>Akcije</th>
            </tr>
          </thead>
          <tbody id='users-table'>

          </tbody>
        </table>
        <div class="mt-3">
          <button class="btn btn-success" id="addUserBtn">Dodaj novog korisnika</button>
        </div>
        <div class="mt-3" id="addUserForm" style="display: none;">
            <h4>Dodaj novog korisnika</h4>
            <form id="newUserForm">
                @csrf
                <div class="form-group">
                    <label for="newName">Ime</label>
                    <input type="text" class="form-control" id="newName">
                </div>
                <div class="form-group">
                    <label for="newPassword">Lozinka</label>
                    <input type="text" class="form-control" id="newPassword">
                </div>
                <div class="form-group">
                    <label for="newEmail">Email</label>
                    <input type="text" class="form-control" id="newEmail">
                </div>
                <div class="form-group">
                    <label for="newRoleId">Uloga</label>
                    <input type="text" class="form-control" id="newRoleId">
                </div>
                <button type="button" class="btn btn-primary" id="addNewUserButton">Dodaj novog korisnika</button>
            </form>
        </div>


      </div>

    <div class="tab-pane fade" id="products">
      <h2>Upravljanje proizvodima</h2>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Cena</th>
            <th>Kategorija</th>
            <th>Proizvodjac</th>
            <th>Boja</th>
            <th>Materijal</th>
            <th>Kolicina</th>
            <th>Slika</th>
            <th>Akcije</th>
          </tr>
        </thead>
        <tbody id='products-table'>
        </tbody>
      </table>
      <div class="mt-3">
        <button class="btn btn-success" id="addOrderBtn">Dodaj novi proizvod</button>
      </div>
      <div class="mt-3" id="addOrderForm" style="display: none;">
        <h4>Dodaj novi proizvod</h4>
        <form>
          <div class="form-group">
            <label for="newName">Name</label>
            <input type="text" class="form-control" id="newName">
          </div>
          <div class="form-group">
            <label for="newPrice">Price</label>
            <input type="text" class="form-control" id="newPrice">
          </div>
          <div class="form-group">
            <label for="newCategory">Category</label>
            <input type="text" class="form-control" id="newCategory">
          </div>
          <div class="form-group">
            <label for="newImage">Image Thumbnail</label>
            <input type="file" class="form-control-file" id="newImage">
            <small class="form-text text-muted">Choose an image for the new product.</small>
          </div>
          <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
      </div>

    </div>

    <div class="tab-pane fade" id="categories">
        <h2>Upravljanje kategorijama</h2>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Naziv kategorije</th>
              <th>Akcije</th>
            </tr>
          </thead>
          <tbody id="categories-table">
          </tbody>
        </table>
        <div class="mt-3">
          <button class="btn btn-success" id="addCategoryBtn">Dodaj kategoriju</button>
        </div>
        <div class="mt-3" id="addCategoryForm" style="display: none;">
          <h4>Dodaj kategoriju</h4>
          <form>
            <div class="form-group">
              <label for="newName">Naziv kategorije</label>
              <input type="text" class="form-control" id="newCategoryName">
            </div>
            <button type="button" class="btn btn-primary" id="addNewCategoryButton">Dodaj kategoriju</button>
          </form>
        </div>

      </div>

    <div class="tab-pane fade" id="pages">
        <h2>Edit Products</h2>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Price</th>
              <th>Category</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id='products-table'>
            <tr>
              <td>1</td>
              <td>Product A</td>
              <td>$19.99</td>
              <td>Electronics</td>
              <td>
                <img src="product-a-thumbnail.jpg" alt="Product A Thumbnail" width="50">
              </td>
              <td>
                <button class="btn btn-sm btn-primary edit-btn">Edit</button>
                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
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
            </tr>
          </tbody>
        </table>
        <div class="mt-3">
          <button class="btn btn-success" id="addProductBtn">Add New Product</button>
        </div>
        <div class="mt-3" id="addProductForm" style="display: none;">
          <h4>Add New Product</h4>
          <form>
            <div class="form-group">
              <label for="newName">Name</label>
              <input type="text" class="form-control" id="newName">
            </div>
            <div class="form-group">
              <label for="newPrice">Price</label>
              <input type="text" class="form-control" id="newPrice">
            </div>
            <div class="form-group">
              <label for="newCategory">Category</label>
              <input type="text" class="form-control" id="newCategory">
            </div>
            <div class="form-group">
              <label for="newImage">Image Thumbnail</label>
              <input type="file" class="form-control-file" id="newImage">
              <small class="form-text text-muted">Choose an image for the new product.</small>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
          </form>
        </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{asset('assets/js/adminPanel.js')}}"></script>

</body>
</html>
