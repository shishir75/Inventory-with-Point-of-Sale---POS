<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Support\Facades\DB;

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
        $data['top_sold'] = OrderDetail::with( 'product' )->select( 'product_id', DB::raw( 'SUM(quantity) as total_sold' ) )
            ->groupBy( 'product_id' )->orderBy( 'total_sold', 'desc' )->take( 9 )->get();

        $data['months'] = Order::distinct()->select( 'month' )->where( 'year', date( 'Y' ) )->get();

        return response()->json( [
            'data' => $data,
        ], 200 );
    }

    public function monthly_history()
    {
        //
    }
}
