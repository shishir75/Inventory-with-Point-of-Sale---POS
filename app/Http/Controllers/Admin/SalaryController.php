<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salaries = Salary::with( 'employee' )->latest()->get();

        return response()->json( [
            'salaries' => $salaries,
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
            'employee_id' => 'required|integer',
            'amount'      => 'required|numeric',
            'month'       => 'required|string',
            'year'        => 'required|integer|min:2000|max:2099',
        ] );

        $check = Salary::where( 'employee_id', $request->employee_id )->where( 'month', $request->month )->where( 'year', $request->year )->first();

        if ( $check ) {
            return response()->json( ['error' => 'Salary already paid for this employee in this month'], 404 );
        } else {
            $salary = new Salary();
            $salary->employee_id = $request->employee_id;
            $salary->amount = $request->amount;
            $salary->month = $request->month;
            $salary->year = $request->year;
            $salary->date = date( 'Y-m-d' );
            $salary->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show( Salary $salary )
    {
        return response()->json( [
            'salary' => $salary,
        ], 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Salary $salary )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy( Salary $salary )
    {
        $salary->delete();
    }
}
