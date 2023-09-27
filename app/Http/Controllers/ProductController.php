<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartShippingInfo;
use App\Models\Image;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\ShippingInfo;
use App\Models\Warehouse;
use App\Models\WarehouseProduct;
use Exception;
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
        return view('pages.products', $this->data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProduct($id)
    {
        $this->data['product'] = Product::with('category', 'manufacturer', 'color', 'images', 'reviews','color', 'product_materials.materials','warehouseProducts')->find($id);
        return view('pages.showProduct', $this->data);

    }

    public function getAllProductsAction()
    {
        return Product::with('category', 'manufacturer', 'color', 'images', 'reviews', 'materials', 'warehouseProducts')->get();
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

            $warehouseProduct = WarehouseProduct::where('product_id', (int)$cartItem['productId'])->first();

            if ($warehouseProduct) {
                $newQuantity = max(0, $warehouseProduct->quantity - (int)$cartItem['quantity']);
                $warehouseProduct->update(['quantity' => $newQuantity]);
            }
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

        if ($comment == null) {
            $comment = "Nema";
        }

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

                $warehouseProduct = WarehouseProduct::where('product_id', (int)$cartItem['productId'])->first();

                if ($warehouseProduct) {
                    $newQuantity = max(0, $warehouseProduct->quantity - (int)$cartItem['quantity']);
                    $warehouseProduct->update(['quantity' => $newQuantity]);
                }
            }

            $shippingInfoRecord = ShippingInfo::create($shippingInfo);
            foreach ($cartIds as $cartId) {
                CartShippingInfo::create([
                    'cart_id' => $cartId,
                    'shippingInfo_id' => $shippingInfoRecord->id,
                ]);
            }
            DB::commit();

            return response()->json(['message' => 'Uspesno potvrdjena narudzbina !'], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Greska prilikom potvrde'], 500);
        }
    }

    public function addNewProductAction(Request $request)
    {
        try {
            $request->validate([
                'productName' => 'required|string',
                'productDescription' => 'required|string',
                'productPrice' => 'required|numeric',
                'productCategory' => 'required|integer',
                'productManufacturer' => 'required|integer',
                'productColor' => 'required|integer',
                'productMaterials' => 'required',
                'productWarehouse' => 'required|integer',
                'productStock' => 'required|integer',
                'productImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('productImage')) {
                $image = $request->file('productImage');
                $imagePath = $image->move('assets/images/products/', $image->getClientOriginalName());
            }

            $product = Product::create([
                'title' => $request->input('productName'),
                'description' => $request->input('productDescription'),
                'price' => $request->input('productPrice'),
                'category_id' => $request->input('productCategory'),
                'manufacturer_id' => $request->input('productManufacturer'),
                'color_id' => $request->input('productColor')
            ]);

            $materialIds = explode(',', $request->input('productMaterials'));
            foreach ($materialIds as $materialId) {
                ProductMaterial::create([
                    'product_id' => $product->id,
                    'material_id' => $materialId
                ]);
            }

            WarehouseProduct::create([
                'warehouse_id' => $request->input('productWarehouse'),
                'product_id' => $product->id,
                'quantity' => $request->input('productStock')
            ]);

            Image::create([
                'product_id' => $product->id,
                'href' => $imagePath ?? null,
                'alt' => $image->getFilename()
            ]);

            return response()->json('Proizvod uspesno dodat!');
        } catch (\Exception $e) {
            return response()->json('Greska prilikom dodavanja proizvoda', 500);
        }
    }

    public function deleteProductAction(Request $request)
    {
        $productId = $request->input('productId');
    try {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json('Proizvod nije pronađen', 404);
        }

        ProductMaterial::where('product_id', $productId)->delete();
        WarehouseProduct::where('product_id', $productId)->delete();
        Image::where('product_id', $productId)->delete();
        Cart::where('product_id', $productId)->delete();

        $product->delete();

        return response()->json('Proizvod uspesno obrisan');
    } catch (\Exception $e) {
        return response()->json('Greska prilikom brisanja proizvoda', 500);
    }
}

public function updateProductAction(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'productImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productId = $request->input('id');

        $product = Product::find($productId);
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        if ($request->hasFile('productImage')) {
            $image = $request->file('productImage');
            $imagePath = $image->move('assets/images/products/', $image->getClientOriginalName());
            Image::where('product_id',$productId)->update([
                'href' => $imagePath ?? null,
                'alt' => $image->getFilename()
            ]);
        }

        $quantity = $request->input('quantity');
        WarehouseProduct::where('product_id', $productId)->update([
            'quantity' => $quantity
        ]);

        $product->save();

        return response()->json('Proizvod uspesno izmenjen!');
    } catch (Exception $e) {
        return response()->json('Greska prilikom izmene proizvoda', 500);
    }
}


}
