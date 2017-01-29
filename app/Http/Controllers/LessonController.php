<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Activity;
use App\Lesson;
use App\UserInfo;
use Auth;
use Carbon\Carbon;

class LessonController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //

        if(Auth::user()->hasRole('parent')){

            $lessons = Lesson::latest('subject_id')->paginate(10);

            $child = UserInfo::where([
                'key' => 'parent',
                'value' => Auth::id()
                ])->first()->value('user_id');

                foreach ($lessons as $key => $l) {

                    $logs = [];


                    // Check if child already viewed this lesson

                    $log = Activity::where([
                        'type' => 'lesson-visit',
                        'user_id' => $child,
                        'info' => json_encode(['lesson' => $l->id])
                        ])->first();

                    if($log){
                        $logs[] = [
                            'status' => 'OK',
                            'message' => 'You&apos;re child read this lesson',
                            'time' => $log->updated_at
                        ];
                    }else{
                        $logs[] = [
                            'status' => 'WAITING',
                            'message' => 'You&apos;re child haven&apos;t read this yet',
                            'time' => false
                        ];
                    }

                    // Check if child already took the quiz

                    $log = Activity::where([
                        'type' => 'quiz-take',
                        'user_id' => $child,
                        'info' => json_encode(['quiz' => $l->quiz->id])
                        ])->first();

                    if($log){
                        $logs[] = [
                            'status' => 'OK',
                            'message' => 'You&apos;re child took the quiz',
                            'time' => $log->updated_at
                        ];
                    }else{
                        $logs[] = [
                            'status' => 'WAITING',
                            'message' => 'You&apos;re child haven&apos;t taken the quiz yet',
                            'time' => false
                        ];
                    }

                    $lessons[$key]->logs = $logs;

                }

                return view('home-parent-lessons',[
                    'lessons' => $lessons
                ]);

            }

        }

        /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function create()
        {
            //
        }

        /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
        public function store(Request $request)
        {
            //
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'description' => 'required|string',
                'content' => 'required|string',
            ]);


            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $lesson = Lesson::create($request->all());

            return back()->with([
                'status' => 'Lesson created successfully!',
                'lesson' => $lesson->id
            ]);
        }

        /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function show($id)
        {
            //

            // Check if user visited this lesson for the past hour
            $lesson = Lesson::findOrFail($id);

            $logs = Auth::user()->activities()->where( 'updated_at', '>=', Carbon::now()->subHour())->where('type','lesson-visit')->latest()->get();

            $readAlready = false;

            foreach ($logs as $key => $log) {
                if(json_decode($log->info)->lesson == $id){
                    $readAlready = true;
                    break;
                }
            }

            if(!$readAlready){
                Activity::create([
                    'user_id' => Auth::id(),
                    'type' => 'lesson-visit',
                    'description' => 'USER visited lesson '.$lesson->title,
                    'info' => json_encode(['lesson' => (int)$id]),
                ]);
            }

            return view('lesson',[
                'lesson' => $lesson
            ]);
        }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function edit($id)
        {
            //
            $lesson = Lesson::findOrFail($id);
            return view('home-teacher-lesson-edit',[
                'lesson' => $lesson,
                'subject' => $lesson->subject
            ]);
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id)
        {
            //
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'description' => 'required|string',
                'content' => 'required|string',
            ]);


            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $lesson = Lesson::findOrFail($id)->update($request->only(['title','description','content']));

            return back()->with([
                'status' => 'Subject updated successfully!',
                'lesson' => $id
            ]);
        }

        /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function destroy($id)
        {
            //
            Lesson::findOrFail($id)->delete();

            return back()->with([
                'status' => 'Lesson deleted successfully!',
            ]);
        }
    }
