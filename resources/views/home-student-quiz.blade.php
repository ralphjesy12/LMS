@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-student',[
            'tab' => 'quizzes'
        ])

        <div class="spacer"></div>

        <div class="columns is-multiline">
            @foreach ($quizzes as $key => $quiz)
                <div class="column is-4">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title min-height-65">
                                {{ $quiz->title }}<br>
                            </p>
                            <a class="card-header-icon">
                                <span class="icon">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <p class="min-height-100">
                                    <strong><small>{{ $quiz->lesson->subject->title }} : {{ $quiz->lesson->title }}</small></strong><br>

                                    <?php
                                    $answers = [];
                                    $score = 0;
                                    $scoreTotal = 0;

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

                                    ?>
                                    @if($answers->count() == $quiz->quizQuestions->count())
                                        <strong><small>You scored {{ $score }} out of {{ $scoreTotal }} ({{ number_format((($score/$scoreTotal)*100),2) }}%)</small></strong>
                                    @elseif($answers->count())
                                        <strong><small>You answered {{ $answers->count() }} out of {{ $quiz->quizQuestions->count() }}</small></strong>
                                    @else
                                        <strong><small>{{ $quiz->quizQuestions->count() }} items</small></strong>
                                    @endif

                                    <br>
                                    {{ str_limit($quiz->description,100) }}
                                </p>
                                <small>Last updated {{ $quiz->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <footer class="card-footer">
                            @if($answers->count() == $quiz->quizQuestions->count())
                                <a href="#" class="card-footer-item is-disabled "><span class="has-danger">You've already taken this quiz</span></a>
                            @elseif($answers->count())
                                <a href="{{ url( 'student/quiz/' . $quiz->id .'/question/' . ($answers->count() + 1) ) }}" class="card-footer-item" target="_blank">Continue Quiz</a>
                            @else
                                <a href="{{ url( 'student/quiz/' . $quiz->id .'' ) }}" class="card-footer-item" target="_blank">Take Quiz</a>
                            @endif
                        </footer>
                    </div>
                </div>
            @endforeach

        </div>

        @if($quizzes->hasPages())
            <div class="box">
                {{ $quizzes->links('vendor.pagination.simple-bulma') }}
            </div>
        @endif
    </div>
@endsection
