<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;

class AjaxController extends Controller
{
    //return pizzaList
    public function pizzaList(Request $request)
    {
        logger($request->all());
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
        return redirect()->route('user#home')->with(['orderSuccess' => 'orderSuccess']);
        // return view('user.main.home');
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
