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
            <li><p>Proizvodjac: {{$product['manufacturer']->manufacturer_name}} </p></li>
            <li><p>Boja: {{$product['color']->color}} </p></li>
            <li><p>Materijali izrade: @for ($i=0;$i<count($product['product_materials']); $i++)
                @if ($i == count($product['product_materials'])-1)
                {{$product['product_materials'][$i]->materials[0]->material}}
                @else
                {{$product['product_materials'][$i]->materials[0]->material}} ,
                @endif
                @endfor
            </p></li>
            <li><p>Dostupnost: <label id='green-label'>Dostupan</label></p></li>
        </ul>
        <h3 id='cena-proizvoda'>Cena: <label>{{$product->price}} RSD</label></h3>
        <br/>
        @if (Session::has('user'))
            <button id="addToCartButton" type="button" class="btn btn-danger" data-id="{{$product->id}}">Dodaj u korpu</button>
        @endif
    </div>

    <div id='comments-main-div' class="row">

        <div class="col-lg-6">

            <h4>Komentari</h4>
            <div class="row">
                @foreach ($product->reviews as $review)
                <div id='review-block' class="col-lg-12">
                    <p>Korisnik : {{$review->user->username}} </p>
                    <p>Komentar : {{$review->review}}</p>
                    @php
                            $starCount=5;
                        @endphp
                    <p> Ocena : <ul id="review-stars">
                        @for($i=0; $i< $review->stars; $i++)
                        <li><i class="fa fa-star"></i></li>
                        @php
                            $starCount--;
                        @endphp
                        @endfor
                        @if($starCount != 0)
                            @for($i=0; $i<$starCount; $i++)
                                <li><i class="fa fa-star-o"></i></li>
                            @endfor
                        </ul>
                    </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-6">

            <h4>Ostavi komentar</h4>
            @if (Session::has('user'))
            <div class="form-group" id="comment-form">
                <textarea class="form-control" id="comment" rows="5" placeholder="Komentar.."></textarea>
                <div>
                    <p>Ocena <i class="fa fa-star"></i></li></p>
                    <input type="number" id="starReview"" name="tentacles" min="1" max="5" value="5">
                </div>
                <button id="leaveAComment" type="button" class="btn btn-primary">Postavi komentar</button>
            </div>
            @else
                <h6 id='comment-warning'>Uloguj se da bi ostavio komentar</h6>
            @endif
        </div>

    </div>

</div>

@endsection
