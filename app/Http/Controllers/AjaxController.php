<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        return $data;;
    }
}
