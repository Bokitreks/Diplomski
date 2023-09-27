<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/adminPanel.css">
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
                    <label for="newRoleId">Uloga(1-korisnik/2-administrator)</label>
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
        <button class="btn btn-success" id="addProductBtn">Dodaj novi proizvod</button>
      </div>
      <div class="mt-3" id="addProductForm" style="display: none;">
        <h4>Dodaj novi proizvod</h4>
        <form>
            <div class="form-group">
                <label for="newName">Naziv</label>
                <input type="text" class="form-control" id="newProductName">
            </div>
            <div class="form-group">
                <label for="newPrice">Opis</label>
                <br />
                <textarea name="productDescription" id="newProductDescription" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="newPrice">Cena</label>
                <input type="text" class="form-control" id="newPrice">
            </div>
            <div class="form-group">
                <label for="newCategory">Kategorija</label>
                <select class="form-control" id="newCategorySelect">
                </select>
            </div>
            <div class="form-group">
                <label for="newManufacturer">Proizvodjac</label>
                <select class="form-control" id="newManufacturerSelect">
                </select>
            </div>
            <div class="form-group">
                <label for="newColor">Boja</label>
                <select class="form-control" id="newColorSelect">
                </select>
            </div>
            <div class="form-group">
                <label for="newMaterial">Materijal</label>
                <select class="form-control" id="newMaterialSelect" multiple>
                </select>
            </div>
            <div class="form-group">
                <label for="newColor">Magacin</label>
                <select class="form-control" id="newWarehouseSelect">
                </select>
            </div>
            <div class="form-group">
                <label for="newStock">Kolicina na stanju</label>
                <input type="text" class="form-control" id="newStock">
            </div>
            <div class="form-group">
                <label for="newImage">Slika</label>
                <input type="file" class="form-control-file" id="newImage">
                <small class="form-text text-muted">Izaberite sliku proizvoda</small>
            </div>
            <button type="button" class="btn btn-primary" id="addNewProductButton">Dodaj proizvod</button>
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
        <h2>Upravljanje narudzbenicama</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Datum</th>
              <th>ID</th>
              <th>Korisnik</th>
              <th>Proizvod</th>
              <th>Kolicina</th>
              <th>Dostava</th>
              <th>Placeno</th>
              <th>Isporuceno</th>
              <th>Akcije</th>
            </tr>
          </thead>
          <tbody id='cart-table'>
          </tbody>
        </table>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{asset('assets/js/adminPanel.js')}}"></script>

</body>
</html>
