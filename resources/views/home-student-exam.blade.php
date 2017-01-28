@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-student',[
            'tab' => 'exams'
        ])

        <div class="spacer"></div>

        <div class="columns is-multiline">
            @foreach ($exams as $key => $exam)
                <div class="column is-4">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title min-height-65">
                                {{ $exam->title }}<br>
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
                                    <strong><small>{{ $exam->subject->title }}</small></strong><br>

                                    <?php
                                    $answers = [];
                                    $score = 0;
                                    $scoreTotal = 0;

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

                                    ?>
                                    @if($answers->count() == $exam->examQuestions->count())
                                        <strong><small>You scored {{ $score }} out of {{ $scoreTotal }} ({{ number_format((($score/$scoreTotal)*100),2) }}%)</small></strong>
                                    @elseif($answers->count())
                                        <strong><small>You answered {{ $answers->count() }} out of {{ $exam->examQuestions->count() }}</small></strong>
                                    @else
                                        <strong><small>{{ $exam->examQuestions->count() }} items</small></strong>
                                    @endif

                                    <br>
                                    {{ str_limit($exam->description,100) }}
                                </p>
                                <small>Last updated {{ $exam->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <footer class="card-footer">
                            @if($answers->count() == $exam->examQuestions->count())
                                <a href="#" class="card-footer-item is-disabled "><span class="has-danger">You've already taken this exam</span></a>
                            @elseif($answers->count())
                                <a href="{{ url( 'student/exam/' . $exam->id .'/question/' . ($answers->count() + 1) ) }}" class="card-footer-item" target="_blank">Continue Exam</a>
                            @else
                                <a href="{{ url( 'student/exam/' . $exam->id .'' ) }}" class="card-footer-item" target="_blank">Take Exam</a>
                            @endif
                        </footer>
                    </div>
                </div>
            @endforeach

        </div>

        @if($exams->hasPages())
            <div class="box">
                {{ $exams->links('vendor.pagination.simple-bulma') }}
            </div>
        @endif
    </div>
@endsection
