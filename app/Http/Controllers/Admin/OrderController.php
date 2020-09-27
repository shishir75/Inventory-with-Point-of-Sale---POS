<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_submit( Request $request )
    {
        $request->validate( [
            'customer_id' => 'required|integer',
            'paid'        => 'required|numeric',
            'paidBy'      => 'required',
        ] );

        $due = $request->total - $request->paid;

        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->quantity = $request->quantity;
        $order->sub_total = $request->sub_total;
        $order->vat = $request->vat;
        $order->total = $request->total;
        $order->paid = $request->paid;
        $order->due = $due;
        $order->paidBy = $request->paidBy;
        $order->date = date( 'Y-m-d' );
        $order->month = date( 'F' );
        $order->year = date( 'Y' );
        $order->save();

        $order_id = $order->id;

        $cartItems = Cart::all();
        foreach ( $cartItems as $cartItem ) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order_id;
            $orderDetail->product_id = $cartItem->product_id;
            $orderDetail->quantity = $cartItem->quantity;
            $orderDetail->price = $cartItem->product->selling_price;
            $orderDetail->sub_total = $cartItem->product->selling_price * $cartItem->quantity;
            $orderDetail->save();

            Product::where( 'id', $cartItem->product_id )->decrement( 'quantity', $cartItem->quantity );
        }

        Cart::truncate();

        return response( 'Done' );
    }

    public function today_order()
    {
        $date = date( 'Y-m-d' );
        $orders = Order::with( 'customer' )->where( 'date', $date )->latest()->get();

        return response()->json( [
            'orders' => $orders,
        ], 200 );
    }

    public function view_order_details( $id )
    {
        $orders = OrderDetail::with( 'product' )->where( 'order_id', $id )->get();

        $customerOrder = Order::with( 'customer' )->where( 'id', $id )->first();

        return response()->json( [
            'orders'        => $orders,
            'customerOrder' => $customerOrder,
        ], 200 );
    }

    public function all_orders()
    {
        $orders = Order::with( 'customer' )->latest()->get();

        return response()->json( [
            'orders' => $orders,
        ], 200 );
    }
}
