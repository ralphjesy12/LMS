@extends('layouts.app')

@section('content')

    <div class="container lesson ">
        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
                <div class="tile">
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-success">
                            <article class="media">
                                <figure class="media-left">
                                    <p class="image is-128x128">
                                        <img src="{{ $lesson->imagepath }}">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="content">
                                        <h1 class="title">{{ $lesson->title }}</h1>
                                        <small>{{ $lesson->updated_at->diffForHumans() }}</small>
                                        <br>
                                        <br>
                                        <p>
                                            {{ $lesson->description }}
                                        </p>
                                        <div class="control is-group">
                                            <a href="{{ url('subject/'.$lesson->subject_id.'/lessons') }}" class="button is-warning"><span>Back to Lessons</span></a>
                                            @if(Auth::user() && Auth::user()->hasRole('teacher'))
                                                <a href="{{ url('/teacher/lesson/'.$lesson->id.'/edit') }}" class="button is-default" target="_blank"><span>Edit Lesson</span></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </article>
                    </div>
                </div>
                <div class="tile">
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-info">
                            <h1 class="title">Lesson Content</h1>
                            <p class="text-pre">
                                {{ $lesson->content }}
                            </p>
                        </article>
                    </div>
                </div>
            </div>
            <div class="tile">
                <div class="tile is-vertical">
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-danger">
                            <p class="title">Watch Video</p>
                            <p class="subtitle">Video Title</p>
                            <figure class="image is-4by3">
                                <img src="http://bulma.io/images/placeholders/640x480.png">
                            </figure>
                        </article>
                    </div>
                    <?php
                    $quiz = $lesson->quiz;
                    ?>
                    @if($quiz)


                        <div class="tile is-parent">
                            <article class="tile is-child notification is-warning">
                                <p class="title">Quiz</p>
                                <p class="subtitle is-3 has-text-centered">
                                    {{ $quiz->title }}
                                </p>

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
                                @if($answers->count())
                                    <p class="subtitle is-6 has-text-centered">
                                        <label class="title is-3">{{ $score }} out of {{ $scoreTotal }} ({{ number_format((($score/$scoreTotal)*100),2) }}%)</label><br>
                                    </p>
                                    <nav class="level">
                                        @if(Auth::user() && Auth::user()->hasRole('student'))
                                            <a href="#" class="level-item button is-warning is-disabled">
                                                <span class="icon"><i class="fa fa-check"></i></span><span>You've already taken up this quiz</span>
                                            </a>
                                        @endif
                                    </nav>
                                @else
                                    <p class="subtitle is-6 has-text-centered">
                                        {{ $quiz->quizQuestions()->count() }} items
                                    </p>

                                    <nav class="level">
                                        @if(Auth::user() && Auth::user()->hasRole('teacher'))
                                            <a href="{{ url('teacher/quiz/' . $quiz->id . '/edit ') }}" target="_blank" class="level-item button is-primary">
                                                <span class="icon"><i class="fa fa-pencil"></i></span><span>Edit Quiz</span>
                                            </a>
                                        @elseif(Auth::user() && Auth::user()->hasRole('student'))
                                                <a href="{{ url('student/quiz/' . $quiz->id) }}" class="level-item button is-primary">
                                                    <span class="icon"><i class="fa fa-check"></i></span><span>Start Quiz Now</span>
                                                </a>
                                        @endif
                                    </nav>
                                @endif
                            </article>
                        </div>
                    @endif
                    <div class="tile is-parent">
                        <article class="tile is-child notification is-primary">
                            <p class="title">Photos</p>
                            <div class="columns is-multiline">
                                @for ($i=0; $i < 9 ; $i++)
                                    <div class="column is-4">
                                        <figure class="image is-1by1">
                                            <a href="#">
                                                <img src="http://bulma.io/images/placeholders/64x64.png">
                                            </a>
                                        </figure>
                                    </div>
                                @endfor
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
