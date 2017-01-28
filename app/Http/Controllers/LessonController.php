<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Activity;
use App\Lesson;
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
                'info' => json_encode(['lesson' => $id]),
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
