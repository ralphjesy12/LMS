<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Subject;
use App\User;
use App\UserInfo;
use App\Comment;
use Validator;
use Illuminate\Validation\Rule;

class PrincipalController extends Controller
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

    public function home()
    {
        return view('principal-home',[
            'teachers' => User::whereHas('roles',function($q){
                $q->where('display_name','=','teacher');
            })->latest('updated_at')->paginate(10),
            'activities' => Auth::user()->activities()->latest('updated_at')->paginate(10)
        ]);
    }

    public function subjects()
    {
        $subjects = Subject::simplePaginate(15);
        return view('home-principal-subjects',[
            'subjects' => $subjects
        ]);
    }
    public function comments()
    {
        $comments = Comment::simplePaginate(15);
        return view('home-principal-comments',[
            'comments' => $comments
        ]);
    }
    public function students()
    {
        $users = User::whereHas('roles',function($q){
            $q->where('display_name','=','student');
        })->orderby('name','ASC')->paginate(10);

        foreach ($users as $key => $u) {
            $users[$key]->parent = User::find($u->infos()->where('key','parent')->value('value'));
        }

        return view('home-principal-students',[
            'subjects' => Subject::all(),
            'students' => $users,
        ]);
    }

}
