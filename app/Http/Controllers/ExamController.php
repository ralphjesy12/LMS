<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\Subject;
use App\Question;
use App\Choice;

class ExamController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
        return view('home-teacher-exams',[
            'exams' => Exam::paginate(8),
            'subjects' => Subject::all()
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
        return view('home-teacher-exam-create',[
            'subjects' => Subject::all()
        ]);
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

        $e = Exam::create([
            'title' => $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'order' => 0,
        ]);

        foreach ($request->question as $key => $question) {
            $q = Question::create([
                'content' => $question,
                'score' => 1,
                'type' => 'text',
                'answer' => '',
                'exam_id' => $e->id,
                'lesson_id' => null,
                'order' => 0,
            ]);

            $ans = [];
            foreach ($request->choice[$key] as $kk => $choice) {
                $c = Choice::create([
                    'content' => $choice,
                    'type' => 'text',
                    'question_id' => $q->id,
                    'order' => $kk,
                ]);

                if(in_array($kk,$request->answer[$key])){
                    $ans[] = $c->id;
                }
            }

            $q->update([
                'answer' => implode(',',$ans)
            ]);

        }

        return back()->with([
            'status' => 'Exam created successfully!',
            'exam' => $e->id
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
        $exam = Exam::findOrFail($id);
        return view('home-teacher-exam-preview',[
            'exam' => $exam,
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
        $exam = Exam::findOrFail($id);
        return view('home-teacher-exam-edit',[
            'subjects' => Subject::all(),
            'exam' => $exam,
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
        $e = Exam::findOrFail($id);

        $e->update([
            'title' => $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'order' => 0,
        ]);

        Question::where('exam_id',$e->id)->each(function($ee){

                $choices = $ee->choices();
                if(count($choices)>0){
                    $choices->delete();
                }

                $ee->delete();

        });

        foreach ($request->question as $key => $question) {
            $q = Question::create([
                'content' => $question,
                'score' => 1,
                'type' => 'text',
                'answer' => '',
                'exam_id' => $e->id,
                'lesson_id' => null,
                'order' => 0,
            ]);

            $ans = [];
            foreach ($request->choice[$key] as $kk => $choice) {
                $c = Choice::create([
                    'content' => $choice,
                    'type' => 'text',
                    'question_id' => $q->id,
                    'order' => $kk,
                ]);

                if(in_array($kk,$request->answer[$key])){
                    $ans[] = $c->id;
                }
            }

            $q->update([
                'answer' => implode(',',$ans)
            ]);

        }

        return back()->with([
            'status' => 'Exam created successfully!',
            'exam' => $e->id
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
        Exam::findOrFail($id)->delete();

        Question::where('exam_id',$id)->each(function($ee){
                $choices = $ee->choices();
                if(count($choices)){
                    $choices->delete();
                }
                $ee->delete();
        });

        return back()->with([
            'status' => 'Exam deleted successfully!',
        ]);
    }
}
