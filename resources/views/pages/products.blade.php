@extends('layouts.main-layout')

@section('title') Contact  @endsection
@section('keywords') Bota,vrata, pvc stolarija, sobna vrata, sigurnosna vrata, prodaja @endsection
@section('description') Bota shop proizvodi visokog kvaliteta, prodaja @endsection

@section('content')

<div class="page-heading products-heading header-text">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="text-content">
            <h4>Novo u ponudi</h4>
            <h2>Ucinite vas dom posebnim</h2>
        </div>
        </div>
    </div>
    </div>
</div>
<div class="products">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="filters">
            <ul>
                <li><a href="" class="productCategoryLink" id="getAllProducts">Svi prozivodi</a></li>
                <li><a href="" class="productCategoryLink" id="getSigurnosnaVrata">Sigurnosna vrata</a></li>
                <li><a href="" class="productCategoryLink" id="getSobnaVrata">Sobna vrata</a></li>
                <li><a href="" class="productCategoryLink" id="getPvcStolarija">PVC Stolarija</a></li>
            </ul>
        </div>
        </div>
        <div class="col-md-12">
        <div class="filters-content">
            <div id="main-products-block" class="row">
                    @foreach ($products as $product)
                    <div class="col-lg-4 col-md-4 all des">
                        <div class="product-item">
                            <a href="#"><img src="{{$product->images[0]->href}}" alt=""></a>
                            <div class="down-content">
                                <a href="#"><h4>{{$product->title}}</h4></a>
                                <h6>{{$product->price}} RSD</h6>
                                <p>{{$product->description}}</p>
                                <ul class="stars">
                                @for($i=0; $i< round($product->avarage_star); $i++)
                                <li><i class="fa fa-star"></i></li>
                                @endfor
                                </ul>
                                <span>Komentari ({{count($product->reviews)}})</span>
                            </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
        </div>
        <div class="col-md-12">
        <ul class="pages">
            <li><a href="#">1</a></li>
            <li class="active"><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
        </ul>
        </div>
    </div>
    </div>
</div>

@endsection
