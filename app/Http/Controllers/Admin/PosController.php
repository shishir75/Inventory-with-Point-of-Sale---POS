<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;

class PosController extends Controller
{
    public function category_product( $id )
    {
        $products = Product::with( 'category' )->where( 'category_id', $id )->latest()->get();

        return response()->json( [
            'products' => $products,
        ], 200 );
    }
}
