<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Subject;

class StudentController extends Controller
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
    public function home()
    {
        return view('home-student');
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
