@extends('layouts.main-layout')

@section('title') Home  @endsection
@section('keywords') Bota,shop,doors,windows,garage doors, webshop @endsection
@section('description') Bota shop home page, best quality doors, windows and pvc @endsection

@section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		h1 {
			margin-top: 0;
			text-align: center;
			color: #333;
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		th, td {
			padding: 10px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		tr:hover {
			background-color: #f5f5f5;
		}
		tfoot tr {
			font-weight: bold;
			background-color: #f2f2f2;
		}
		tfoot td {
			text-align: right;
			padding: 10px;
		}
		.remove-item {
			color: red;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div id="cart-table" class="container">
		<h2>Korpa</h2>
		<table>
			<thead>
				<tr>
					<th>Naziv Proizvoda</th>
					<th>Cena</th>
					<th>Kolicina</th>
					<th>Ukupno</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Prozivod 1</td>
					<td class="price">20000 RSD</td>
					<td><input type="number" min="1" value="1" class="quantity"></td>
					<td class="total">10000.00</td>
					<td><span class="remove-item">X</span></td>
				</tr>
				<tr>
					<td>Prozivod 2</td>
					<td class="price">20000 RSD</td>
					<td><input type="number" min="1" value="2" class="quantity"></td>
					<td class="total">$40.00</td>
					<td><span class="remove-item">X</span></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3"><strong>Ukupno</strong></td>
					<td class="cart-total">34000 RSD</td>
					<td></td>
				</tr>
			</tfoot>
		</table>
        <p>Odaberite nacin dostave</p>
        <select id="shippingMethod" name="shippingMethod">
            <option value="0">Preuzimanje u radnji</option>
            <option value="1">Dostava na adresu</option>
          </select>
        <h3 id='personal-info-header'>Licni podaci</h3>
        <form>
            <div class="form-group">
              <label for="exampleFormControlInput1">Ime i Prezime</label>
              <input type="email" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Grad/Mesto</label>
                <input type="email" class="form-control" id="exampleFormControlInput1">
              </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Adresa Stanovanja</label>
                <input type="email" class="form-control" id="exampleFormControlInput1">
              </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Komentar (opciono)</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </form>
        <button id="addToCartButton" type="button" class="btn btn-danger">Potvrdi porudzbinu</button>
	</div>

@endsection
