<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['products'] = Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->get();
      //dd($this->data['products']);
        return view('pages.products', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllProductsAction()
    {
        return Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->get();
    }

    public function getSigurnosnaVrataAction()
    {
        return Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->where('category_id',1)->get();
    }

    public function getSobnaVrataAction()
    {
        return Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->where('category_id',2)->get();
    }

    public function getPvcStolarijaAction()
    {
        return Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->where('category_id',3)->get();
    }
    public function sortProductsAction(Request $request) {
        $filter = $request->input('filter');
        $sort = $request->input('sort');
        $products = [];

        switch($filter) {
            case 'sviProizvodi': $products = Product::with('category', 'manufacturer', 'color', 'images', 'reviews');
            break;
            case 'sigurnosnaVrata': $products = Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->where('category_id',1);
            break;
            case 'sobnaVrata': $products = Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->where('category_id',2);
            break;
            case 'pvcStolarija': $products = Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->where('category_id',3);
            break;
            default : $products = $this->getAllProductsAction();
        }
        // dd($products);
        switch($sort) {
            case '1': $products->orderBy('created_at', 'DESC');
            break;
            case '2': $products->orderBy('price');
            break;
            case '3': $products->orderBy('price', "DESC");
            break;
            case '4': $products->orderBy('title');
            break;
            default : break;
        }
        return $products->get();
    }
}
