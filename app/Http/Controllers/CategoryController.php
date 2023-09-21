<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getAllCategoriesAction() {
        return Category::all();
    }

    public function deleteCategoryAction(Request $request) {
        $categoryId = $request->input('categoryId');

        try {
            $category = Category::findOrFail($categoryId);

            Product::where('category_id', $categoryId)->delete();

            $category->delete();

            return response()->json("Kategorija obrisana", 200);
        } catch (ModelNotFoundException $e) {
            return response()->json('Kategorija nije pronadjena', 404);
        } catch (Exception $e) {
            return response()->json('Greska prilikom brisanja kategorije' . $e->getMessage(), 400);
        }
    }


    public function addCategoryAction(Request $request) {
        $categoryName = $request->input('newCategoryName');

        $validator = Validator::make(
            ['category_name' => $categoryName],
            ['category_name' => 'required|unique:categories']
        );

        if ($validator->fails()) {
            return response()->json('Neispravno uneta kategorija, ili vec postoji', 400);
        }

        try {
            Category::create([
                'category_name' => $categoryName
            ]);

            return response()->json('Kategorija uspesno kreirana', 200);
        } catch (Exception $e) {
            return response()->json('Greska prilikom dodavanja kategorije ', 400);
        }
    }

    public function editCategoryAction(Request $request) {
        try {
            $categoryId = $request->input('categoryId');
            $newCategoryName = $request->input('newCategoryName');


            $category = Category::findOrFail($categoryId);
            $category->update(['category_name' => $newCategoryName]);

            return response()->json('Kategorija uspesno izmenjena', 200);
        } catch (ModelNotFoundException $e) {
            return response()->json('Kategorija nije pronadjena', 404);
        } catch (Exception $e) {
            return response()->json('Greska prilikom izmene', 400);
        }
    }

}
