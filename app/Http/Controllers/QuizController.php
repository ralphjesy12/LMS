<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Subject;
use App\Question;
use App\Lesson;
use App\Choice;
use App\Answer;
use Auth;

class QuizController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
        return view('home-teacher-quizzes',[
            'quizzes' => Quiz::paginate(8),
            'lessons' => Lesson::orderBy('subject_id')->get()->all()
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
        return view('home-teacher-quiz-create',[
            'lessons' => Lesson::orderBy('subject_id')->get()->all()
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

        $e = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'lesson_id' => $request->lesson_id,
            'order' => 0,
        ]);

        foreach ($request->question as $key => $question) {
            $q = Question::create([
                'content' => $question,
                'score' => 1,
                'type' => 'text',
                'answer' => '',
                'exam_id' => null,
                'quiz_id' => $e->id,
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
            'status' => 'Quiz created successfully!',
            'quiz' => $e->id
        ]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id,$q = false)
    {
        //
        $quiz = Quiz::findOrFail($id);
        if(Auth::user()->hasRole('teacher')){
            return view('home-teacher-quiz-preview',[
                'quiz' => $quiz,
            ]);
        }

        $question = false;
        $answers = [];
        $score = 0;
        $scoreTotal = 0;
        if($q){
            $question = $quiz->quizQuestions->get($q-1);
            if(!$question){
                return redirect()->intended('student/quiz/'.$id);
            }

        }else{
            $answers = $quiz->answers->where('user_id',Auth::id());


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

        return view('quiz',[
            'quiz' => $quiz,
            'q' => $q,
            'question' => $question,
            'answers' => $answers,
            'score' => $score,
            'scoreTotal' => $scoreTotal,
        ]);


    }

    public function submitAnswer(Request $request,$id,$q){

        Answer::create([
            'user_id' => Auth::id() ,
            'question_id' => $request->question ,
            'answer' => implode(',',$request->answer) ,
        ]);

        return redirect()->intended( 'student/quiz/'.$id.'/question/' . ($q+1) );
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
        $quiz = quiz::findOrFail($id);
        return view('home-teacher-quiz-edit',[
            'lessons' => Lesson::orderBy('subject_id')->get()->all(),
            'quiz' => $quiz,
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
        $e = Quiz::findOrFail($id);

        $e->update([
            'title' => $request->title,
            'description' => $request->description,
            'lesson_id' => $request->lesson_id,
            'order' => 0,
        ]);

        Question::where('quiz_id',$e->id)->each(function($ee){

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
                'exam_id' => null,
                'quiz_id' => $e->id,
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
            'status' => 'Quiz updated successfully!',
            'quiz' => $e->id
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
        Quiz::findOrFail($id)->delete();

        Question::where('quiz_id',$id)->each(function($ee){
                $choices = $ee->choices();
                if(count($choices)){
                    $choices->delete();
                }
                $ee->delete();
        });

        return back()->with([
            'status' => 'Quiz deleted successfully!',
        ]);
    }
}
