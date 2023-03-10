<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;

class OrderController extends Controller
{
    public function orderList()
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
            })
            ->orderBy('orders.created_at', 'desc')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->paginate(4);
        // dd($order->toArray());

        return view('admin.order.list', compact('order'));
    }

    //sort with ajax
    public function ajaxStatus(Request $request)
    {
        Logger($request->all());
        // $request->status = $request->status == null ? '' : $request->status;
        $order = Order::select('orders.*', 'users.name as user_name')
            ->orderBy('orders.created_at', 'desc')

            ->leftJoin('users', 'users.id', 'orders.user_id');
        if ($request->status == null) {
            $order = $order->get();
        } else {
            $order = $order->where('orders.status', $request->status)->get();
        };
        return response()->json($order, 200);

        // Logger($request->all());
    }
}
