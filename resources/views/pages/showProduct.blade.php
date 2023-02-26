@extends('layouts.main-layout')

@section('title') Contact  @endsection
@section('keywords') Bota,vrata, pvc stolarija, sobna vrata, sigurnosna vrata, prodaja @endsection
@section('description') Bota shop proizvodi visokog kvaliteta, prodaja @endsection

@section('content')

<div class="row" id="main-show-block">

    <div id='div-slika-proizvoda' class="col-lg-6">
        <h2>{{$product->title}}</h2>
        <img id='product-main-picture' src="../{{$product['images'][0]->href}}" alt="productImage">
    </div>

    <div id="div-specifikacije" class="col-lg-6">

        <h3>Specifikacije</h3>
        <ul id='specifikacija-prozivoda'>
            @php
            $starCount = 5;
        @endphp
            <ul class="stars">
                @for($i=0; $i< round($product->avarage_star); $i++)
                <li><i class="fa fa-star"></i></li>
                @php
                    $starCount--;
                @endphp
                @endfor
                @if($starCount != 0)
                    @for($i=0; $i<$starCount; $i++)
                        <li><i class="fa fa-star-o"></i></li>
                    @endfor
                @endif
                </ul>
            <li><p>Opis prozivoda: {{$product->description}}</p></li>
            <li><p>Proizvodjac: {{$product->description}} </p></li>
            <li><p>Materijali izrade: {{$product['manufacturer']->manufacturer_name}} </p></li>
            <li><p>Dostupnost: <label id='green-label'>Dostupan</label></p></li>
        </ul>
        <h3 id='cena-proizvoda'>Cena: <label>{{$product->price}} RSD</label></h3>
    </div>


</div>

@endsection
