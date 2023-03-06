<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home()
    {
        $pizza = Product::get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart'));
    }


    //direct cart page
    public function cartList()
    {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as image')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();
        // dd($cartList->toArray());
        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }
        return view('user.main.cart', compact('cartList', 'totalPrice'));
    }


    //direct user details page
    public function details()
    {
        return view('user.account.details');
    }



    //direct user edit page
    public function edit()
    {
        return view('user.account.edit');
    }


    //filter
    public function filter($categoryId)
    {
        $pizza = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart'));
        // dd($categoryId);
    }

    //direct history page
    public function history()
    {
        return view('user.main.history');
    }


    //direct pizza page
    public function pizzaDetails($pizzaId)
    {
        // dd($pizzaId);

        $pizza = Product::where('id', $pizzaId)->first();
        // dd($pizza->toArray());
        $pizzaList = Product::get();
        // dd($pizzaList->toArray());
        return view('user.main.details', compact('pizza', 'pizzaList'));
    }


    //direct change password page
    public function changePasswordPage()
    {
        return view('user.account.changePassword');
    }


    //update account info
    public function update($id, Request $request)

    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        //for image
        if (request()->hasFile('image')) {
            //1 old image | check and delete | store
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if (
                $dbImage != null
            ) {
                Storage::delete('public/' . $dbImage);
            }
            // dd($dbImage);
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            // dd($fileName);
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where(
            'id',
            Auth::user()->id
        )->update($data);

        return redirect()->route('user#details')->with(['UpdateSuccess' => 'User Account Updated..']);
    }

    //get user data
    private function getUserData($request)
    {
        return [
            // 'name' => $request->name,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'updated_at' => Carbon::now()
        ];
    }

    //account validation Check
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,png,jpeg'
        ])->validate();
    }


    //change password
    public function changePassword(Request $request)
    {
        $this->passwordValitationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password; //hash value
        if ((Hash::check($request->oldPassword, $dbHashValue)) && (Hash::check($request->newPassword, $dbHashValue))) {
            return back()->with(['samePsw' => 'This is your old password!']);
        } elseif (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = ['password' => Hash::make($request->newPassword)];
            User::where('id', Auth::user()->id)->update($data);
            // Auth::logout();
            return redirect()->route('user#home')->with(['changeSuccess' => 'Password changed..']);
            // return redirect()->route('auth#loginPage');
        }
        return back()->with(['notMatch' => 'The old password do not match. Try Again!']);
    }


    //password Valitation check
    private function passwordValitationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ], [
            'oldPassword.required' => 'Old psw lo ak pr tl'
        ])->validate();
    }
}