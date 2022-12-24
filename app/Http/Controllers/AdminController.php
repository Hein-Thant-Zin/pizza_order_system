<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage()
    {
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request)
    {
        // dd($request->all());
        /*
        1. all field must be fill
        2. new password and confirm password length must be greater than 6 and less than 10
        3. new password and confirm password must be the same
        4. old password must be the same with db password
          if old password and new password were the same show message('This is your old password!')
        5. change password
        */
        $this->passwordValitationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password; //hash value
        if ((Hash::check($request->oldPassword, $dbHashValue)) && (Hash::check($request->newPassword, $dbHashValue))) {
            return back()->with(['samePsw' => 'This is your old password!']);
        } elseif (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = ['password' => Hash::make($request->newPassword)];
            User::where('id', Auth::user()->id)->update($data);
            // Auth::logout();
            return back()->with(['changeSuccess' => 'Password changed..']);
            // return redirect()->route('auth#loginPage');
        }
        return back()->with(['notMatch' => 'The old password do not match. Try Again!']);

        // $hashValue = Hash::make('code lab');
        // if (Hash::check(' lab', $hashValue)) {
        //     dd('correct');
        // } else {
        //     dd('incorrect');
        // }
        // dd($dbPassword);

        // dd($user->toArray());
        // dd('changed psw');
    }

    //password Valitation check
    private function passwordValitationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ], [
            'oldPassword.required' => 'Old psw lo ak pr tl'
        ])->validate();
    }

    //direct details page
    public function details()
    {
        return view('admin.account.details');
    }
}