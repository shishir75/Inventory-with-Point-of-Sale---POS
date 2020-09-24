<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $products = Cart::with( 'product' )->get();

        return response()->json( [
            'products' => $products,
        ], 200 );
    }

    public function store( Request $request )
    {
        $product = Product::findOrFail( $request->id );

        $cart = Cart::where( 'product_id', $request->id )->first();

        if ( $cart ) {
            $cart->quantity = $cart->quantity + 1;
            $cart->save();
        } else {
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->quantity = 1;
            $cart->save();
        }
    }
}
