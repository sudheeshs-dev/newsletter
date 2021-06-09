<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login_action(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 1])) {
           return redirect('dashboard');
        }else{
            return redirect()->back()->withErrors(['err'=>'Not Found']);
        }
    }
}
