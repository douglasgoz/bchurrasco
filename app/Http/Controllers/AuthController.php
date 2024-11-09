<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('authentication.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([            
            'email'=>'required|email:users',
            'password'=>'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('userID', $user->id);
                return redirect('products');
            } else {
                return back()->with('fail','Password not match!');
            }
        } else {
            return back()->with('fail','User not found');
        }
    }

    public function logout()
    {
        if (Session::has('userID')){
            Session::pull('userID');
        }
        
        return redirect('login');
    }
}
