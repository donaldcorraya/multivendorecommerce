<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('admin-login')->with('message','You have successfully logged out');
    }
}
