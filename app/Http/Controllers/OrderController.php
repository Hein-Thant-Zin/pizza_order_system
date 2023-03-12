<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
// use Illuminate\Log\Logger;

use Illuminate\Log\Logger;

class OrderController extends Controller
{
    public function orderList()
    {
        // return "test";
        $order = Order::select('orders.*', 'users.name as user_name')
            ->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
            })
            ->orderBy('orders.created_at', 'desc')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->get();
        // dd($order->toArray());

        return view('admin.order.list', compact('order'));
    }

    //sort with ajax
    public function changeStatus(Request $request)
    {
        // dd($request->all());
        $order = Order::select('orders.*', 'users.name as user_name')
            ->orderBy('created_at', 'desc')
            ->leftJoin('users', 'users.id', 'orders.user_id');
        if ($request->orderStatus == null) {
            $order = $order->get();
        } else {
            $order = $order->where('orders.status', $request->orderStatus)->get();
        }
        // dd($order->toArray());
        return view('admin.order.list', compact('order'));

        // Logger($request->all());
    }
    //ajax change status
    public function ajaxChangeStatus(Request $request)
    {
        // Logger($request->all());s
        Order::where('order_id', $request->orderId)->update([
            'status' => $request->status
        ]);
    }
}
