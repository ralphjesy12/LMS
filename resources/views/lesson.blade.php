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
                    @if($lesson->uploads->where('type','=','video')->count())
                        <div class="tile is-parent">
                            <article class="tile is-child notification is-danger">
                                <p class="title">Watch Video</p>
                                <?php
                                $url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$lesson->uploads->where('type','=','video')->first()->value('path'));

                                echo $url;
                                ?>
                            </article>
                        </div>
                    @endif
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
                            @if(count($lesson->uploads->where('type','=','image'))==0)
                                <h2 class="subtitle is-block has-text-centered">No Images Yet</h2>
                            @else
                                <div class="columns is-multiline">
                                    @foreach ($lesson->uploads->where('type','=','image') as $key => $image)
                                        <div class="column is-4">
                                            <figure class="image is-1by1 lesson-image">
                                                <img src="{{ asset($image->path) }}">
                                            </figure>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </article>
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::user() && (Auth::user()->hasRole('parent') || Auth::user()->hasRole('teacher')))
            <div class="tile is-parent">
                <div class="tile is-child box">
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="https://www.gravatar.com/avatar/{{ md5( Auth::user()->email ) }}?d=retro">
                            </p>
                        </figure>
                        <form class="media-content" method="POST" action="{{ action('LessonController@saveComment',[
                            'lesson' => $lesson->id
                            ]) }}">
                            {{ csrf_field() }}
                            <p class="control">
                                <textarea class="textarea" name="content" placeholder="Add a comment..."></textarea>
                            </p>
                            <nav class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        <button type="submit" class="button is-info">Post comment</button>
                                    </div>
                                </div>
                            </nav>
                        </form>
                    </article>
                    @if($comments->count())
                        <hr />

                        @foreach ($comments as $key => $comment)
                            <article class="media">
                                <figure class="media-left">
                                    <p class="image is-64x64">
                                        <img src="https://www.gravatar.com/avatar/{{ md5( $comment->user->email ) }}?d=retro">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong>{{ $comment->user->id == Auth::id() ? 'You' : $comment->user->name }}</strong> <small>{{ $comment->user->email }} · {{ $comment->updated_at->diffForHumans() }}</small>
                                            <br>
                                            {{ $comment->content }}
                                            <br>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>
            </div>
        @endif

    </div>
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <p class="image">
                <img src="">
            </p>
        </div>
        <button class="modal-close"></button>
    </div>
@endsection

@push('scripts')
    <script>
    jQuery(function($){
        $('.image.lesson-image').click(function(e){
            e.stopImmediatePropagation();
            $('.modal img').attr('src',$(this).find('img').attr('src'));
            $('.modal').toggleClass('is-active');
        });
    });
    </script>
@endpush
