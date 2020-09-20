<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with( 'category', 'supplier' )->latest()->get();

        return response()->json( [
            'products' => $products,
        ], 200 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $request->validate( [
            'name'          => 'required|unique:products|max:255',
            'code'          => 'required|unique:products',
            'quantity'      => 'required|integer',
            'category_id'   => 'required|integer',
            'supplier_id'   => 'required|integer',
            'buying_date'   => 'required|date',
            'root'          => 'required',
            'buying_price'  => 'required|numeric',
            'selling_price' => 'required|numeric',
        ] );

        if ( $request->photo ) {
            $position = strpos( $request->photo, ';' );
            $sub = Str::substr( $request->photo, 0, $position );
            $extentation = explode( '/', $sub )[1];

            $img_name = time() . '.' . $extentation;
            $path = public_path() . "/assets/img/product/";

            $img = Image::make( $request->photo );
            $img->resize( 300, 200 );
            $img->save( $path . $img_name );

        } else {
            $img_name = null;
        }

        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->photo = $img_name;
        $product->buying_date = $request->buying_date;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $product = Product::with( 'category', 'supplier' )->where( 'id', $id )->first();

        return response()->json( [
            'product' => $product,
        ], 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Product $product )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( Product $product )
    {
        //
    }
}
