<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if(Auth::user()->hasRole('teacher')) return redirect()->intended('teacher');
        if(Auth::user()->hasRole('student')) return redirect()->intended('subjects');
        if(Auth::user()->hasRole('parent')) return redirect()->intended('parent');

        return redirect()->intended('subjects');
    }


}
