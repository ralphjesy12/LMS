@extends('layouts.app')

@section('content')
    <div class="container subjects ">
        <div class="box content">
            <!-- Main container -->
            <h1 class="title is-block has-text-centered">{{ $subject->title }}</h1>
            <div>
                {!! $subject->description !!}
            </div>
            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong>{{ $lessons->total() }}</strong> lessons

                        </p>

                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <p class="control has-addons">
                            <input class="input" type="text" placeholder="Find a lesson">
                            <button class="button">
                                Search
                            </button>


                        </p>
                    </div>
                    <div class="level-item">
                        @if(Auth::user() && Auth::user()->hasRole('teacher'))
                            <a href="{{ url('/teacher/subject/'.$subject->id.'/edit') }}" class="button is-default" target="_blank"><span>Edit Subject</span></a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
        <div class="columns is-multiline">

            @if($lessons->count())
                @foreach ($lessons as $key => $lesson)
                    <div class="column is-6">
                        <div class="box notification {{ [
                            'is-warning',
                            'is-info',
                            'is-success',
                            'is-danger',
                            'is-primary'
                            ][$key%5] }}">
                            <a href="{{ url('lesson/'.$lesson->id) }}" class="content">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-128x128">
                                            <img src="{{ $lesson->imagepath ?: '/img/'.(strtolower(studly_case($lesson->subject->title))).'/icon' . ($key==0 ? '' : ' ('.$key.')') . '.png' }}" alt="Image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>

                                                <strong>{{ $lesson->title }}</strong><br>
                                                <small>{{ $lesson->updated_at->diffForHumans() }}</small><br>
                                                {{ str_limit($lesson->description,200) }}

                                                @if($lesson->quiz && $lesson->quiz->count() && Auth::id())
                                                    <br><br>
                                                    <?php
                                                    $answers = [];
                                                    $score = 0;
                                                    $scoreTotal = 0;

                                                    $answers = $lesson->quiz->answers->where('user_id',Auth::id());

                                                    ?>
                                                    @if($answers->count())
                                                        <?php
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
                                                        <label class="tag is-success">You scored {{ $score }} out of {{ $scoreTotal }} ({{ number_format((($score/$scoreTotal)*100),2) }}%) last {{ $answers->last()->updated_at->diffForHumans() }}</label>
                                                    @else
                                                        <label class="tag is-info">Quiz of {{ $lesson->quiz->quizQuestions->count() }} items</label>
                                                    @endif
                                                @else
                                                    <br><br>
                                                    @if($lesson->quiz)
                                                        <label class="tag is-info">Quiz of {{ $lesson->quiz->quizQuestions->count() }} items</label>
                                                    @endif
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="column is-full">
                    <div class="box">
                        <div class="content has-text-centered">
                            No lessons yet
                        </div>
                    </div>
                </div>
            @endif

            @if($subject->exam && $subject->exam->count())
                <div class="column is-full">
                    <div class="box notification is-primary  has-text-centered">
                        <label class="title is-4 is-block">{{ $subject->exam->title }}</label>

                        <?php
                        $answers = [];
                        $score = 0;
                        $scoreTotal = 0;

                        $answers = $subject->exam->answers->where('user_id',Auth::id());

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
                            @if($answers->count()==$subject->exam->examQuestions->count())
                                <p class="subtitle is-6 has-text-centered">
                                    <label class="title is-3">{{ $score }} out of {{ $scoreTotal }} ({{ number_format((($score/$scoreTotal)*100),2) }}%)</label><br>
                                </p>
                                <nav class="level">
                                    @if(Auth::user() && Auth::user()->hasRole('student'))
                                        <a href="#" class="level-item button is-warning is-disabled">
                                            <span class="icon"><i class="fa fa-check"></i></span><span>You've already taken up this exam</span>
                                        </a>
                                    @else
                                        <a href="#" class="level-item button is-warning is-disabled">
                                            <span class="icon"><i class="fa fa-check"></i></span><span>Your child already took up this exam</span>
                                        </a>
                                    @endif

                                </nav>
                            @else
                                <p class="subtitle is-6 has-text-centered">
                                    <label class="title is-3">{{ $answers->count() }} out of {{ $subject->exam->examQuestions->count() }} answered</label><br>
                                </p>
                                <nav class="level">
                                    <a href="{{ url('student/exam/'.$subject->exam->id.'/question/' . ($answers->count() + 1)) }}" class="level-item button is-warning">
                                        <span class="icon"><i class="fa fa-check"></i></span><span>Continue Exam</span>
                                    </a>
                                </nav>
                            @endif
                        @else
                            <p class="subtitle is-6 has-text-centered">
                                {{ $subject->exam->examQuestions()->count() }} items
                            </p>

                            <nav class="level">
                                @if(Auth::user() && Auth::user()->hasRole('teacher'))
                                    <a href="{{ url('teacher/exam/' . $subject->exam->id . '/edit ') }}" target="_blank" class="level-item button is-primary">
                                        <span class="icon"><i class="fa fa-pencil"></i></span><span>Edit Exam</span>
                                    </a>
                                @else
                                    @if(Auth::user() && Auth::user()->hasRole('student'))
                                        <a href="{{ url('student/exam/' . $subject->exam->id) }}" class="level-item button is-primary">
                                            <span class="icon"><i class="fa fa-check"></i></span><span>Start Exam Now</span>
                                        </a>
                                    @endif
                                @endif
                            </nav>
                        @endif

                    </div>
                </div>
            @endif
        </div>

        @if($lessons->hasPages())

            <div class="box">
                {{ $lessons->links('vendor.pagination.simple-bulma') }}
            </div>

        @endif
    </div>
@endsection
