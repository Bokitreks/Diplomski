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
            <ul id='categories-list'>
            </ul>
        </div>
        <div class="row" id='sort-fields'>
            <div class="col-md-6"></div>
            <div id="sort-div" class="col-md-6">
                <select class="sort" name="sort" id="sort">
                    <option value="1">Najnovije</option>
                    <option value="2">Po ceni rastuce</option>
                    <option value="3">Po ceni opadajuce</option>
                    <option value="4">Po nazivu</option>
                </select>
            </div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="filters-content">
            <div id="main-products-block" class="row">
                    @foreach ($products as $product)
                    @php
                        $starCount = 5;
                    @endphp
                    <div class="col-lg-4 col-md-4 all des">
                        <div class="product-item">
                            <a href='/products/{{$product->id}}'><img src="{{$product->images[0]->href}}" alt=""></a>
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
