<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
// use Illuminate\Log\Logger;

use Illuminate\Log\Logger;

class OrderController extends Controller
{
    public function orderList()
    {
        // return "test";
        $orderForDate = Order::latest()->first();
        $order = Order::select('orders.*', 'users.name as user_name')
            ->when(request('key'), function ($query) {
                $query->where('users.name', 'products.name', 'like', '%' . request('key') . '%');
            })
            ->orderBy('orders.created_at', 'desc')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->paginate(4);
        $order->appends(request()->all());
        // dd($order->toArray());

        return view('admin.order.list', compact('order', 'orderForDate'));
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


    //list info
    public function listInfo($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();
        $orderList = OrderList::where('order_code', $orderCode)
            ->select('order_lists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image')
            ->leftJoin('users', 'users.id', 'order_lists.user_id')
            ->leftJoin('products', 'products.id', 'order_lists.product_id')
            ->get();
        return view('admin.order.productList', compact('orderList', 'order'));
    }
}
