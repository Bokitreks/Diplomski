<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartShippingInfo;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['products'] = Product::with('category', 'manufacturer', 'color', 'images', 'reviews.user')->get();
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
    public function showProduct($id)
    {
        $this->data['product'] = Product::with('category', 'manufacturer', 'color', 'images', 'reviews','color', 'product_materials.materials')->find($id);
        return view('pages.showProduct', $this->data);

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
        return Product::with('category', 'manufacturer', 'color', 'images', 'reviews', 'materials')->get();
    }

    public function sortProductsAction(Request $request) {
        $filter = $request->input('filter');
        $sort = $request->input('sort');
        $products = [];

        if($filter == 0) {
            $products = Product::with('category', 'manufacturer', 'color', 'images', 'reviews');
        }
        else {
            $products = Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->where('category_id', $filter);
        }

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

    public function getProductsAction(Request $request) {
        $productIds = $request->input('productIds');
        $products = Product::whereIn('id', $productIds)->get();
        return response()->json($products, 200);
    }

    public function confirmOrderWithoutShippingAction(Request $request) {
        $cartItems = $request->input('cartItems');
        $userId = $request->input('userId');
        foreach($cartItems as $cartItem) {
            Cart::create([
                'user_id' => $userId,
                'product_id' => (int)$cartItem['productId'],
                'quantity' => (int)$cartItem['quantity'],
                'total' => (int)$cartItem['total'],
                'is_payed' => 0,
                'shipping' => 0,
                'is_finished' => 0
            ]);
        }

        return response()->json('Porudzbina uspesno potvrdjena !', 200);
    }

    public function confirmOrderWithShippingAction(Request $request) {
        $cartItems = $request->input('cartItems');
        $userId = $request->input('userId');
        $name = $request->input('name');
        $city = $request->input('city');
        $address = $request->input('address');
        $comment = $request->input('comment');

        $shippingInfo = [
            'user_id' => $userId,
            'name_surname' => $name,
            'city' => $city,
            'address' => $address,
            'comment' => $comment,
        ];

        $cartIds = [];

        DB::beginTransaction();

        try {
            foreach ($cartItems as $cartItem) {
                // Create a new Cart record
                $cart = Cart::create([
                    'user_id' => $userId,
                    'product_id' => (int) $cartItem['productId'],
                    'quantity' => (int) $cartItem['quantity'],
                    'total' => (int) $cartItem['total'],
                    'is_payed' => 0,
                    'shipping' => 1,
                    'is_finished' => 0,
                ]);

                $cartIds[] = $cart->id;
            }

            $shippingInfoRecord = ShippingInfo::create($shippingInfo);
            foreach ($cartIds as $cartId) {
                CartShippingInfo::create([
                    'cart_id' => $cartId,
                    'shippingInfo_id' => $shippingInfoRecord->id,
                ]);
            }
            DB::commit();

            return response()->json(['message' => 'Order has been placed successfully'], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Order placement failed'], 500);
        }
    }

}
