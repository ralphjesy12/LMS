<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\UserInfo;
use Validator;
use Illuminate\Validation\Rule;

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
        if(Auth::user()->hasRole('principal')) return redirect()->intended('principal');

        return redirect()->intended('subjects');
    }

    public function account(){
        return view('account',[
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request,$id){
        $validator = Validator::make([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ], [
            'email' => [
                'email',
                'required',
                'min:6',
                Rule::unique('users')->ignore($id),
            ],
            'name' => 'required',
            'password' => 'required_with:password_confirmation|confirmed',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput(
                $request->except('password')
            );
        }

        $toUpdate = [
            'email' => $request->email,
            'name' => $request->name,
        ];

        if(!empty($request->password)){
            $toUpdate['password'] = bcrypt($request->password);
        }

        User::find($id)->update($toUpdate);

        $userInfo = [
            'birthday' => $request->birthday,
            'idnum' => $request->idnum,
        ];

        foreach ($userInfo as $key => $value) {
            UserInfo::updateOrCreate([
                'user_id' => $id,
                'key' => $key,
            ],[
                'value' => $value
            ]);
        }

        return back()->with([
            'status' => 'Profile Updated Successfuly'
        ]);
    }


}
