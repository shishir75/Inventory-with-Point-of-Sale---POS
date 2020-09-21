<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->get();

        return response()->json( [
            'expenses' => $expenses,
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
            'details' => 'required',
            'amount'  => 'required|numeric',
        ] );

        $expense = new Expense();
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->date = date( 'Y-m-d' );
        $expense->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show( Expense $expense )
    {
        return response()->json( [
            'expense' => $expense,
        ], 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Expense $expense )
    {
        $request->validate( [
            'details' => 'required',
            'amount'  => 'required|numeric',
        ] );

        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy( Expense $expense )
    {
        $expense->delete();
    }
}
