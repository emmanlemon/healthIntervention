<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index(){
        if(empty(Auth::user())){
            return view('auth/login');
        }else{
            $role = Auth::user()->role;
            if($role == "0")
            {
                return redirect('/page/questionnaire');
            }
            else
            {
                return redirect('/admin');
            }
        }
    }
}
