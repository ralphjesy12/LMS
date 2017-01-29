<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Subject;
use App\Activity;
use App\UserInfo;
use App\Grade;
use Auth;

class GradeController extends Controller
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

    public function index(){

        if(Auth::user()->hasRole('student')){
            $id = Auth::id();

            return view('home-student-grade-view',[
                'subjects' => Subject::all()->map(function($s) use($id){
                    $read = 0;
                    $quizTook = 0;
                    $quizTotal = 0;

                    foreach ($s->lessons as $key => $l) {
                        $isRead = Activity::where([ 'user_id' => $id, 'type' => 'lesson-visit', 'info' => json_encode([ 'lesson' =>  $l->id ]) ])->count() != 0;

                        if($isRead){
                            $read++;
                        }

                        $isQuizDone = Activity::where([ 'user_id' => $id, 'type' => 'quiz-take', 'info' => json_encode([ 'quiz' =>  $l->quiz->id ]) ])->count() != 0;

                        if($isQuizDone){
                            $quizTook++;
                        }

                        if($l->quiz){
                            $quizTotal++;
                        }
                    }

                    $examsTaken = 0;
                    $examsTotal = 0;

                    if(count($s->exam)){
                        $isExamDone = Activity::where([
                            'user_id' => $id,
                            'type' => 'exam-take',
                            'info' => json_encode([ 'exam' =>  $s->exam->id ])
                            ])->count() != 0;

                            if($isExamDone){
                                $examsTaken++;
                            }

                            $examsTotal++;
                        }

                        $s->lessonsViewed = $read;
                        $s->lessonsQuizTook = $quizTook;
                        $s->lessonsQuizTotal = $quizTotal;
                        $s->examsTaken = $examsTaken;
                        $s->examsTotal = $examsTotal;
                        return $s;
                    })
                ]);
            }


            if(Auth::user()->hasRole('parent')){
                $id = UserInfo::where([ 'key' => 'parent', 'value' => Auth::id() ])->first()->value('user_id');
                $student = User::findOrFail($id);
                return view('home-parent-student-grade-view',[
                    'student' => $student,
                    'subjects' => Subject::all()->map(function($s) use($id){
                        $read = 0;
                        $quizTook = 0;
                        $quizTotal = 0;

                        foreach ($s->lessons as $key => $l) {
                            $isRead = Activity::where([
                                'user_id' => $id,
                                'type' => 'lesson-visit',
                                'info' => json_encode([ 'lesson' =>  $l->id ])
                                ])->count() != 0;

                                if($isRead){
                                    $read++;
                                }

                                $isQuizDone = Activity::where([
                                    'user_id' => $id,
                                    'type' => 'quiz-take',
                                    'info' => json_encode([ 'quiz' =>  $l->quiz->id ])
                                    ])->count() != 0;

                                    if($isQuizDone){
                                        $quizTook++;
                                    }

                                    if($l->quiz){
                                        $quizTotal++;
                                    }
                                }

                                $examsTaken = 0;
                                $examsTotal = 0;

                                if(count($s->exam)){
                                    $isExamDone = Activity::where([
                                        'user_id' => $id,
                                        'type' => 'exam-take',
                                        'info' => json_encode([ 'exam' =>  $s->exam->id ])
                                        ])->count() != 0;

                                        if($isExamDone){
                                            $examsTaken++;
                                        }

                                        $examsTotal++;
                                    }

                                    $s->lessonsViewed = $read;
                                    $s->lessonsQuizTook = $quizTook;
                                    $s->lessonsQuizTotal = $quizTotal;
                                    $s->examsTaken = $examsTaken;
                                    $s->examsTotal = $examsTotal;
                                    return $s;
                                })
                            ]);
                        }

                    }

                    /**
                    * Show the application dashboard.
                    *
                    * @return \Illuminate\Http\Response
                    */
                    public function edit($id)
                    {
                        $student = User::findOrFail($id);

                        return view('home-teacher-student-grade-edit',[
                            'student' => $student,
                            'subjects' => Subject::all()->map(function($s) use($id){
                                $read = 0;
                                $quizTook = 0;
                                $quizTotal = 0;
                                foreach ($s->lessons as $key => $l) {
                                    $isRead = Activity::where([
                                        'user_id' => $id,
                                        'type' => 'lesson-visit',
                                        'info' => json_encode([ 'lesson' =>  $l->id ])
                                        ])->count() != 0;

                                        if($isRead){
                                            $read++;
                                        }

                                        $isQuizDone = Activity::where([
                                            'user_id' => $id,
                                            'type' => 'quiz-take',
                                            'info' => json_encode([ 'quiz' =>  $l->quiz->id ])
                                            ])->count() != 0;

                                            if($isQuizDone){
                                                $quizTook++;
                                            }

                                            if($l->quiz){
                                                $quizTotal++;
                                            }
                                        }

                                        $examsTaken = 0;
                                        $examsTotal = 0;

                                        if(count($s->exam)){
                                            $isExamDone = Activity::where([
                                                'user_id' => $id,
                                                'type' => 'exam-take',
                                                'info' => json_encode([ 'exam' =>  $s->exam->id ])
                                                ])->count() != 0;

                                                if($isExamDone){
                                                    $examsTaken++;
                                                }

                                                $examsTotal++;
                                            }

                                            $s->lessonsViewed = $read;
                                            $s->lessonsQuizTook = $quizTook;
                                            $s->lessonsQuizTotal = $quizTotal;
                                            $s->examsTaken = $examsTaken;
                                            $s->examsTotal = $examsTotal;
                                            return $s;
                                        })
                                    ]);
                                }

                                public function update(Request $request,$id){

                                    foreach ($request->grade as $subject => $grade) {
                                        Grade::updateOrCreate([
                                            'user_id' => $id,
                                            'subject_id' => $subject
                                        ],[
                                            'grade' => $grade
                                        ]);
                                    }

                                    return back()->with([
                                        'status' => 'Student Grades Updated Successfuly'
                                    ]);
                                }

                            }
