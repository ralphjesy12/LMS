<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
    * Where to redirect users after login.
    *
    * @var string
    */
    protected $redirectTo = '/home';

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            Activity::create([
                'user_id' => Auth::id(),
                'type' => 'login',
                'description' => 'USER logged in',
                'info' => json_encode(['email' => $request->email]),
            ]);

            return redirect()->intended('home');
        }else{
            Activity::create([
                'user_id' => 0,
                'type' => 'login',
                'description' => 'USER loggin attempt failed',
                'info' => json_encode(['email' => $request->email,'password' => $request->password]),
            ]);
            return back()->withErrors([
                'email' => 'Email or Password does not exist'
            ])->withInput();
        }
    }
}
