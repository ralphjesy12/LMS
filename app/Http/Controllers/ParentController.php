<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Subject;
use App\User;
use App\UserInfo;
use Validator;
use Illuminate\Validation\Rule;

class ParentController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        if (!Auth::check()) {
            return redirect()->intended('login');
        }
    }

    /**
    * Show the application dashboard for Teachers.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('home-teacher-student',[
            'students' => User::whereHas('roles',function($q){
                $q->where('display_name','=','student');
            })->latest('updated_at')->paginate(10),
        ]);
    }

    public function create($id){
        return view('home-teacher-student-parent-create',[
            'student' => User::findOrFail($id)
        ]);
    }

    public function edit($id){

        $student = User::findOrFail($id);

        $student->parent = User::find($student->infos()->where('key','parent')->value('value'));

        return view('home-teacher-student-parent-edit',[
            'student' => $student,
        ]);
    }
    public function destroy($id){
        User::findOrFail($id)->delete();
        return back();
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
                Rule::unique('users')->ignore($request->parent_id),
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

        User::find($request->parent_id)->update($toUpdate);


        return back()->with([
            'status' => 'Student Parent Profile Updated Successfuly'
        ]);
    }

    public function store(Request $request,$id){
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
                'unique:users'
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

        $user = User::create($toUpdate);

        $user->attachRole(4);

        $userInfo = [
            'parent' => $user->id,
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
            'status' => 'Parent Profile Created Successfuly'
        ]);
    }

    public function home()
    {

        return view('home-parent',[
            'subjects' => Subject::all(),
            'activities' => Auth::user()->activities()->latest('updated_at')->paginate(10)
        ]);
    }

    /**
    * Show the application dashboard for Teachers.
    *
    * @return \Illuminate\Http\Response
    */
    public function subjects()
    {
        $subjects = Subject::simplePaginate(15);
        return view('home-student-subjects',[
            'subjects' => $subjects
        ]);
    }
    /**
    * Show the application dashboard for Teachers.
    *
    * @return \Illuminate\Http\Response
    */
    public function subjectLessons($id)
    {
        $subjects = Subject::findOrFail($id)->lessons()->simplePaginate(15);
        return view('home-student-subjects',[
            'subjects' => $subjects
        ]);
    }


}
