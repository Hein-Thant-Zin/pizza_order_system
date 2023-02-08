<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //user home page
    public function home()
    {
        $pizza = Product::get();
        $category = Category::get();
        return view('user.main.home', compact('pizza', 'category'));
    }
}
