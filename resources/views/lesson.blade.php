@extends('layouts.app')

@section('content')
    <div class="container lesson ">
        <article class="notification is-success">
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

        <div class="owl-carousel owl-theme">

            @if($lesson->uploads->where('type','=','video')->count())
                <div class="item">
                    <article class="notification is-danger has-text-centered">
                        <p class="title">Watch Video</p>
                        <?php
                        $url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"853\" height=\"505\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen style=\"margin:0px auto;display:block;\" \></iframe>",$lesson->uploads->where( 'type','video' )->first()->path);
                        echo $url;
                        ?>
                        <br>
                        <small>{{ $lesson->uploads->where( 'type','video' )->first()->description }}</small>
                    </article>
                </div>
            @endif
            <div class="item">
                <article class="notification is-primary">
                    <p class="title">Photos</p>
                    @if(count($lesson->uploads->where('type','=','image'))==0)
                        <h2 class="subtitle is-block has-text-centered">No Images Yet</h2>
                    @else
                        <div class="columns is-multiline">
                            @foreach ($lesson->uploads->where('type','=','image') as $key => $image)
                                <div class="column is-4">
                                    <figure class="image is-1by1 lesson-image">
                                        <img src="{{ asset($image->path) }}" alt="{{ $image->description }}">
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </article>
            </div>
            <div class="item">
                <article class="notification is-info">
                    <h1 class="title">Lesson Content</h1>
                    <div class="content text-pre" style="color: #fff;">
                        {!! $lesson->content !!}
                    </div>
                </article>
            </div>
            <?php
            $quiz = $lesson->quiz;
            ?>
            @if($quiz)
                <div class="item">
                    <article class="notification is-warning">
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

        </div>

        @if(Auth::user() && (!Auth::user()->hasRole('student')))
            <div class="tile is-parent">
                <div class="tile is-child box">
                    @if(!Auth::user()->hasRole('principal'))
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
                    @endif
                    @php
                    @endphp
                    @if($comments->count()>0)
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
                                    @if($comment->user->id == Auth::id())
                                        <nav class="level">
                                            <div class="level-left">
                                                <a class="level-item" href="comment/{{ $comment->id }}/delete">
                                                    <span class="icon is-small"><i class="fa fa-trash"></i></span>
                                                    <spam>Delete</spam>
                                                </a>
                                            </div>
                                        </nav>
                                    @endif
                                </div>
                            </article>
                        @endforeach

                    @else
                        @if(Auth::user()->hasRole('principal'))
                            <article class="media has-text-centered ">
                                <h1 class="title is-block is-4">No comments yet</h1>
                            </article>
                        @endif
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
                <small></small>
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
            $('.modal .image small').text($(this).find('img').attr('alt'));
            $('.modal').toggleClass('is-active');
        });
    });
    </script>
@endpush



@push('styles')
    <link href="{{ asset('owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('owlcarousel/assets/owl.theme.green.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
    $(function(){
        $('.owl-carousel').owlCarousel({
            loop:false,
            margin:10,
            autoplay:false,
            nav:true,
            dots:true,
            autoHeight:true,
            items: 1,
        });
    });
    </script>
@endpush
