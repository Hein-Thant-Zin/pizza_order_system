<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizzaList
    public function pizzaList(Request $request)
    {
        // logger($request->all());
        if ($request->status == 'desc') {
            $data =  Product::orderBy('created_at', 'desc')->get();
        } else {
            $data =  Product::orderBy('created_at', 'asc')->get();
        }
        return $data;
    }
    //return pizza list
    public function addToCart(Request $request)
    {
        // logger($request->all());
        $data = $this->getOrderData($request);
        // Logger($data);

        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' => 'added..'
        ];
        return response()->json($response, 200);
    }
    //order
    public function order(Request $request)
    {

        $total = 0;
        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);
            $total += $data->total;
        }

        Cart::where('user_id', Auth::user()->id)->delete();
        // logger($data->order_code);
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 30,

        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order completed',
        ], 200);
    }
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //clearCurrentProduct

    public function clearCurrentProduct(Request $request)
    {
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->product_id)
            ->where('cart_id', $request->cart_id)->delete();
    }
    //get order data
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
