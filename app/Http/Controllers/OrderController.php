<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList()
    {
        $order = Order::get();
        return view('admin.order.list', compact('order'));
    }
}
