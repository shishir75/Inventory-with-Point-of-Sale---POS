<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->get();

        return response()->json( [
            'employees' => $employees,
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
            'name'         => 'required|unique:employees|max:255',
            'email'        => 'required|email|unique:employees|max:255',
            'address'      => 'required',
            'phone'        => 'required|numeric|unique:employees',
            'nid'          => 'nullable|numeric|unique:employees',
            'joining_date' => 'required|date',
            'salary'       => 'required|numeric',
        ] );

        if ( $request->photo ) {
            $position = strpos( $request->photo, ';' );
            $sub = Str::substr( $request->photo, 0, $position );
            $extentation = explode( '/', $sub )[1];

            $img_name = time() . '.' . $extentation;
            $path = public_path() . "/assets/img/employee/";

            $img = Image::make( $request->photo );
            $img->resize( 300, 200 );
            $img->save( $path . $img_name );

        } else {
            $img_name = null;
        }

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->nid = $request->nid;
        $employee->photo = $img_name;
        $employee->joining_date = $request->joining_date;
        $employee->salary = $request->salary;
        $employee->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show( Employee $employee )
    {
        return response()->json( [
            'employee' => $employee,
        ], 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Employee $employee )
    {
        $request->validate( [
            'name'         => 'required|unique:employees,name,' . $employee->id,
            'email'        => 'required|email|unique:employees,email,' . $employee->id,
            'address'      => 'required',
            'phone'        => 'required|numeric|unique:employees,phone,' . $employee->id,
            'nid'          => 'nullable|numeric|unique:employees,nid,' . $employee->id,
            'joining_date' => 'required|date',
            'salary'       => 'required|numeric',
        ] );

        if ( $request->photo ) {

            // Delete Old Photo
            if ( $employee->photo ) {
                @unlink( public_path() . "/assets/img/employee/" . $employee->photo );
            }

            $position = strpos( $request->photo, ';' );
            $sub = Str::substr( $request->photo, 0, $position );
            $extentation = explode( '/', $sub )[1];

            $img_name = time() . '.' . $extentation;
            $path = public_path() . "/assets/img/employee/";

            $img = Image::make( $request->photo );
            $img->resize( 300, 200 );
            $img->save( $path . $img_name );

        } else {
            $img_name = $employee->photo;
        }

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->nid = $request->nid;
        $employee->photo = $img_name;
        $employee->joining_date = $request->joining_date;
        $employee->salary = $request->salary;
        $employee->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy( Employee $employee )
    {
        $photo = $employee->photo;
        if ( $photo ) {
            @unlink( public_path() . "/assets/img/employee/" . $photo );
        }
        $employee->delete();
    }
}
