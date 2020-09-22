<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->get();

        return response()->json( [
            'customers' => $customers,
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
            'name'    => 'required|unique:customers|max:255',
            'email'   => 'required|email|unique:customers|max:255',
            'address' => 'required',
            'phone'   => 'required|numeric|unique:customers',
        ] );

        if ( $request->photo ) {
            $position = strpos( $request->photo, ';' );
            $sub = Str::substr( $request->photo, 0, $position );
            $extentation = explode( '/', $sub )[1];

            $img_name = time() . '.' . $extentation;
            $path = public_path() . "/assets/img/customer/";

            $img = Image::make( $request->photo );
            $img->resize( 300, 200 );
            $img->save( $path . $img_name );

        } else {
            $img_name = null;
        }

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->photo = $img_name;
        $customer->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show( Customer $customer )
    {
        return response()->json( [
            'customer' => $customer,
        ], 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Customer $customer )
    {
        $request->validate( [
            'name'    => 'required|unique:customers,name,' . $customer->id,
            'email'   => 'required|email|unique:customers,email,' . $customer->id,
            'address' => 'required',
            'phone'   => 'required|numeric|unique:customers,phone,' . $customer->id,
        ] );

        if ( $request->photo ) {
            $position = strpos( $request->photo, ';' );
            $sub = Str::substr( $request->photo, 0, $position );
            $extention = explode( '/', $sub )[1];

            $img_name = time() . '.' . $extention;
            $path = public_path() . "/assets/img/customer/";

            $img = Image::make( $request->photo );
            $img->resize( 300, 200 );
            $img->save( $path . $img_name );

            if ( $customer->photo ) {
                @unlink( public_path() . "/assets/img/customer/" . $customer->photo );
            }

        } else {
            $img_name = $customer->photo;
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->photo = $img_name;
        $customer->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy( Customer $customer )
    {
        $photo = $customer->photo;
        if ( $photo ) {
            @unlink( public_path() . "/assets/img/customer/" . $photo );
        }
        $customer->delete();
    }
}
