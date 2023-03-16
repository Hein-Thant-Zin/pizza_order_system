<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //direct user list page
    public function userList()
    {
        $orderForDate = Order::latest()->first();
        $order = Order::paginate(4);
        $user = User::where('role', 'user')->paginate(4);
        return view('admin.user.list', compact('user', 'order', 'orderForDate'));
    }

    //ajax change role
    public function changeRole(Request $request)
    {
        $updateSource =  [
            'role' => $request->role
        ];
        User::where('id', $request->userId)->update($updateSource);
    }
}
