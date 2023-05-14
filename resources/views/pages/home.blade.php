@extends('layouts.main-layout')

@section('title') Home  @endsection
@section('keywords') Bota,shop,doors,windows,garage doors, webshop @endsection
@section('description') Bota shop home page, best quality doors, windows and pvc @endsection

@section('content')

<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
    <div class="banner-item-01">
        <div class="text-content">
        <h4>VELIKI IZBOR</h4>
        <h2>Najveci izbor sobnih vrata i PVC stolarije</h2>
        </div>
    </div>
    <div class="banner-item-02">
        <div class="text-content">
        <h4>VI BIRATE</h4>
        <h2>Izrada po Vasoj meri</h2>
        </div>
    </div>
    <div class="banner-item-03">
        <div class="text-content">
        <h4>UGRADNJA</h4>
        <h2>Brzo, lako, efikasno</h2>
        </div>
    </div>
    </div>
</div>
<!-- Banner Ends Here -->

<div class="latest-products">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="section-heading">
            <h2>Novo u ponudi</h2>
            <a href="/products">Pogledaj celu ponudu<i class="fa fa-angle-right"></i></a>
        </div>
        </div>
        @foreach ($latestProducts as $product)
            @php
                $starCount = 5;
            @endphp
            <div class="col-lg-4 col-md-4 all des">
                <div class="product-item">
                    <a href="/products/{{$product->id}}"><img src="{{$product->images[0]->href}}" alt=""></a>
                    <div class="down-content">
                        <a href="#"><h4>{{$product->title}}</h4></a>
                        <h6>{{$product->price}} RSD</h6>
                        <p>{{$product->description}}</p>
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
                        <span>Komentari ({{count($product->reviews)}})</span>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
</div>

<div class="best-features">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="section-heading">
            <h2>Saznaj vise o nama</h2>
        </div>
        </div>
        <div class="col-md-6">
        <div class="left-content">
            <h4>Po cemu se izdvajamo od ostalih?</h4>
            <p>Nasa kompanija godinama u nazad brine o svojim potrosacima, kvalitetna roba kao i usluga ugradnje i odrzavanja su nam prioritet broj jedan. Neke od nasih najboljih osobina bi izdvojili:</p>
            <ul class="featured-list">
            <li><a href="#">Roba visokog kvaliteta</a></li>
            <li><a href="#">Pristupacne cene</a></li>
            <li><a href="#">Brza i efikasna ugradnja</a></li>
            <li><a href="#">Garancija do cak 6 godina</a></li>
            <li><a href="#">24/7 dostupnost nasih servisera</a></li>
            </ul>
            <a href="/contact" class="filled-button">Saznaj vise</a>
        </div>
        </div>
        <div class="col-md-6">
        <div class="right-image">
            <img src="assets/images/doorServicer.jpg" alt="doorServicer"/>
        </div>
        </div>
    </div>
    </div>
</div>


<div class="call-to-action">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="inner-content">
            <div class="row">
            <div class="col-md-8">
                <h4>Kvalitet &amp; Pristupacne cene</h4>
                <p>Uveri se i sam u kvalitet nasih proizvoda, sta cekas, pogledaj nas katalog</p>
            </div>
            <div class="col-md-4">
                <a href="/products" class="filled-button">Pogledaj katalog proizvoda</a>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>


@endsection
