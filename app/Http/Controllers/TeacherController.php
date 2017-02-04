<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Auth;
use DB;
use App\Subject;
use App\Lesson;
use App\User;
use Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {

        if (!Auth::check()) {
            return redirect()->intended('teacher/login');
        }

    }

    public function create(){
        return view('principal-teacher-create');
    }
    public function store(Request $request){

        $validator = Validator::make([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ], [
            'email' => [
                'email',
                'required',
                'unique:users',
                'min:6',
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

        $user->attachRole(3);

        return back()->with([
            'status' => 'Teacher Profile Created Successfuly'
        ]);
    }

    public function edit($id){
        return view('principal-teacher-edit',[
            'teacher' => User::findOrFail($id),
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

        return back()->with([
            'status' => 'Teacher Profile Updated Successfuly'
        ]);
    }

    public function destroy($id){
        User::findOrFail($id)->delete();
        return back();
    }

    /**
    * Show the application dashboard for Teachers.
    *
    * @return \Illuminate\Http\Response
    */
    public function home()
    {


        return view('home-teacher');
    }


    /**
    * Show the application dashboard for Teachers.
    *
    * @return \Illuminate\Http\Response
    */
    public function subjects()
    {
        $subjects = Subject::simplePaginate(15);
        return view('home-teacher-subjects',[
            'subjects' => $subjects
        ]);
    }

    /**
    * Show the form for creating Subjects.
    *
    * @return \Illuminate\Http\Response
    */
    public function subjectCreate()
    {
        return view('home-teacher-subject-create');
    }


    /**
    * Show the form for creating Lessons.
    *
    * @return \Illuminate\Http\Response
    */
    public function lessonCreate($id)
    {
        return view('home-teacher-lesson-create',[
            'subject' => Subject::findOrFail($id)
        ]);
    }

    /**
    * Show the form for creating Subjects.
    *
    * @return \Illuminate\Http\Response
    */
    public function subjectEdit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('home-teacher-subject-edit',[
            'subject' => $subject
        ]);
    }

    /**
    * Show the details for a Subject.
    *
    * @return \Illuminate\Http\Response
    */
    public function subjectView($id)
    {
        $subject = Subject::findOrFail($id);
        $lessons = $subject->lessons()->paginate(20);

        return view('home-teacher-subject-view',[
            'subject' => $subject,
            'lessons' => $lessons
        ]);
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function login()
    {
        return view('auth.login',[
            'level' => 2
        ]);
    }
}
