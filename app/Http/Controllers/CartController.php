<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\WarehouseProduct;
use Exception;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.cart',$this->data);
    }

    public function getAllCartsAction() {
        return Cart::with('user','product')->get();
    }

    public function updateCartAction(Request $request) {
       $cartId = $request->input('id');
       $is_finished = $request->input('is_finished');
       $is_payed = $request->input('is_payed');

       try{
            Cart::where('id',$cartId)->update([
                'is_finished' => $is_finished,
                'is_payed' => $is_payed
            ]);
            return response()->json('Narudzbenica usopesno izmenjena', 200);
       } catch(Exception $e) {
        return response()->json('Greska prilikom izmene', 500);
       }
    }

    public function deleteCartAction(Request $request) {
        $cartId = $request->input('cartId');
        $quantity = $request->input('quantity');
        $productId = $request->input('productId');
        try {
            Cart::destroy($cartId);
            WarehouseProduct::where('product_id', $productId)
            ->increment('quantity', $quantity);

            return response()->json('Narudzbenica uspesno obrisana', 200);
        }
        catch(Exception $e) {
            return response()->json('Greska prilikom brisanja', 500);
        }
    }
}
