<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        if(Auth::check()){return redirect('dashboard');}
        return view('login');
    }

    public function dashboard()
    {
        $data['title']='Dashboard';
        return view('dashboard',$data);
    }
}
