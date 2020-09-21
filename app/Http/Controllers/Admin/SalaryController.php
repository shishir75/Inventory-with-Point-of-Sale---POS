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
        $salaries = Salary::select( 'month_year' )->groupBy( 'month_year' )->get();

        return response()->json( [
            'salaries' => $salaries,
        ], 200 );
    }

    public function month_year( $month_year )
    {
        $salaries = Salary::with( 'employee' )->where( 'month_year', $month_year )->get();

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

        $month_year = $request->month . "_" . $request->year;

        $check = Salary::where( 'employee_id', $request->employee_id )->where( 'month_year', $month_year )->first();

        if ( $check ) {
            return response()->json( ['message' => 'Salary already paid for this employee in this month'] );
        } else {
            $salary = new Salary();
            $salary->employee_id = $request->employee_id;
            $salary->amount = $request->amount;
            $salary->month_year = $month_year;
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
        $month_year = $salary->month_year;

        $month = explode( '_', $month_year )[0];
        $year = explode( '_', $month_year )[1];

        return response()->json( [
            'salary' => $salary,
            'month'  => $month,
            'year'   => $year,
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
        $request->validate( [
            'employee_id' => 'required|integer',
            'amount'      => 'required|numeric',
            'month'       => 'required|string',
            'year'        => 'required|integer|min:2000|max:2099',
        ] );

        $month_year = $request->month . "_" . $request->year;

        $salary->employee_id = $request->employee_id;
        $salary->amount = $request->amount;
        $salary->month_year = $month_year;
        $salary->date = date( 'Y-m-d' );
        $salary->save();
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
