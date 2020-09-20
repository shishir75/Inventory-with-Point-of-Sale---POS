<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return response()->json( [
            'suppliers' => $suppliers,
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
            'name'      => 'required|unique:suppliers|max:255',
            'email'     => 'required|email|unique:suppliers|max:255',
            'address'   => 'required',
            'phone'     => 'required|numeric|unique:suppliers',
            'shop_name' => 'nullable|unique:suppliers',
        ] );

        if ( $request->photo ) {
            $position = strpos( $request->photo, ';' );
            $sub = Str::substr( $request->photo, 0, $position );
            $extentation = explode( '/', $sub )[1];

            $img_name = time() . '.' . $extentation;
            $path = public_path() . "/assets/img/supplier/";

            $img = Image::make( $request->photo );
            $img->resize( 300, 200 );
            $img->save( $path . $img_name );

        } else {
            $img_name = null;
        }

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->photo = $img_name;
        $supplier->shop_name = $request->shop_name;
        $supplier->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show( Supplier $supplier )
    {
        return response()->json( [
            'supplier' => $supplier,
        ], 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Supplier $supplier )
    {
        $request->validate( [
            'name'      => 'required|unique:suppliers,name,' . $supplier->id,
            'email'     => 'required|email|unique:suppliers,email,' . $supplier->id,
            'address'   => 'required',
            'phone'     => 'required|numeric|unique:suppliers,phone,' . $supplier->id,
            'shop_name' => 'nullable|unique:suppliers,shop_name,' . $supplier->id,
        ] );

        if ( $request->photo ) {

            // Delete Old Photo
            if ( $supplier->photo ) {
                @unlink( public_path() . "/assets/img/supplier/" . $supplier->photo );
            }

            $position = strpos( $request->photo, ';' );
            $sub = Str::substr( $request->photo, 0, $position );
            $extentation = explode( '/', $sub )[1];

            $img_name = time() . '.' . $extentation;
            $path = public_path() . "/assets/img/supplier/";

            $img = Image::make( $request->photo );
            $img->resize( 300, 200 );
            $img->save( $path . $img_name );

        } else {
            $img_name = $supplier->photo;
        }

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->shop_name = $request->shop_name;
        $supplier->photo = $img_name;
        $supplier->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy( Supplier $supplier )
    {
        $photo = $supplier->photo;
        if ( $photo ) {
            @unlink( public_path() . "/assets/img/supplier/" . $photo );
        }
        $supplier->delete();
    }
}
