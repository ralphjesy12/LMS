<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\Subject;
use App\Question;
use App\Choice;
use App\Answer;
use Auth;

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
    public function show($id ,$q = false)
    {
        //

        $exam = Exam::findOrFail($id);

        if(Auth::user()->hasRole('teacher')){
            return view('home-teacher-exam-preview',[
                'exam' => $exam,
            ]);
        }

        $question = false;
        $answers = [];
        $score = 0;
        $scoreTotal = 0;
        if($q){
            $question = $exam->examQuestions->get($q-1);
            if(!$question){
                return redirect()->intended('student/exam/'.$id);
            }

        }else{
            $answers = $exam->answers->where('user_id',Auth::id());


            foreach ($answers as $key => $answer) {

                $diff = array_diff(
                    explode(',',$answer->answer),
                    explode(',',$answer->question->answer)
                );

                if(count($diff)==0){
                    $score += $answer->question->score;
                }
                $scoreTotal += $answer->question->score;

            }
        }

        return view('exam',[
            'exam' => $exam,
            'q' => $q,
            'question' => $question,
            'answers' => $answers,
            'score' => $score,
            'scoreTotal' => $scoreTotal,
        ]);
    }

    public function submitAnswer(Request $request,$id,$q){

        Answer::updateOrCreate([
            'user_id' => Auth::id() ,
            'question_id' => $request->question ,
        ],[
            'answer' => implode(',',$request->answer)
        ]);

        return redirect()->intended( 'student/exam/'.$id.'/question/' . ($q+1) );
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
            'status' => 'Exam updated successfully!',
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
