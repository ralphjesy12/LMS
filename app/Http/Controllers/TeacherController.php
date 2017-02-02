<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Auth;
use DB;
use App\Subject;
use App\Lesson;
use App\User;
use Illuminate\Support\Facades\View;

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
