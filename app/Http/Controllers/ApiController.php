<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function api()
    {
        return redirect()->route('user#details');
    }
    //
}
