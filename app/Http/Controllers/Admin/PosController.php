<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use App\Http\Controllers\Controller;
use App\Order;
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

    public function today_history()
    {
        $today = date( 'Y-m-d' );
        $data = [];
        $data['total'] = Order::where( 'date', $today )->sum( 'total' );
        $data['paid'] = Order::where( 'date', $today )->sum( 'paid' );
        $data['due'] = Order::where( 'date', $today )->sum( 'due' );
        $data['expense'] = Expense::where( 'date', $today )->sum( 'amount' );

        return response()->json( [
            'data' => $data,
        ], 200 );
    }

    public function monthly_history()
    {
        $month = date( 'F' );
        $data = [];
        $data['total'] = Order::where( 'month', $month )->sum( 'total' );
        $data['paid'] = Order::where( 'month', $month )->sum( 'paid' );
        $data['due'] = Order::where( 'month', $month )->sum( 'due' );
        // $data['expense'] = Expense::where( 'date', $today )->sum( 'amount' );

        return response()->json( [
            'data' => $data,
        ], 200 );
    }
}
