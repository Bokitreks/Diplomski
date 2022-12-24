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
}
