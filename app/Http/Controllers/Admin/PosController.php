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

        $data['monthly_total'] = Order::select( 'month', DB::raw( 'SUM(total) as total' ) )->groupBy( 'month' )->where( 'year', date( 'Y' ) )->get();
        $data['monthly_due'] = Order::select( 'month', DB::raw( 'SUM(due) as due' ) )->groupBy( 'month' )->where( 'year', date( 'Y' ) )->get();

        $data['top_customers'] = Order::with( 'customer' )->select( 'customer_id', DB::raw( 'SUM(total) as total_amount' ) )
            ->groupBy( 'customer_id' )->orderBy( 'total_amount', 'desc' )->take( 5 )->get();

        $data['top_categories'] = Product::with( 'category' )->select( 'category_id', DB::raw( 'COUNT(category_id) as category_count' ) )
            ->groupBy( 'category_id' )->orderBy( 'category_count', 'desc' )->get();

        $data['less_stock'] = Product::orderBy( 'quantity', 'asc' )->take( 5 )->get();

        return response()->json( [
            'data' => $data,
        ], 200 );
    }

    public function yesterday_history()
    {
        $yesterday = date( 'Y-m-d', strtotime( '-1 days' ) );

        $data = [];
        $data['total'] = Order::where( 'date', $yesterday )->sum( 'total' );
        $data['paid'] = Order::where( 'date', $yesterday )->sum( 'paid' );
        $data['due'] = Order::where( 'date', $yesterday )->sum( 'due' );
        $data['expense'] = Expense::where( 'date', $yesterday )->sum( 'amount' );

        return response()->json( [
            'data' => $data,
        ], 200 );
    }
}
