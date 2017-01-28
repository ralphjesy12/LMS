@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'quizzes'
        ])
        <div class="spacer"></div>

        <div class="columns">
            <div class="column is-full">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p class="title">Preview Quiz</p>
                            <p class="subtitle">
                                Quiz: {{ $quiz->title }}<br>
                                <small class="label">Lesson : {{ $quiz->lesson->title }}</small>
                            </p>
                            <p>
                                {{ $quiz->description }}
                            </p>

                            @foreach ($quiz->quizQuestions as $k => $question)
                                <hr>
                                <p><strong>Question # {{ $k+1 }} : </strong>
                                    {{ $question->content }}
                                </p>
                                <div class="columns is-multiline">
                                    @foreach ($question->choices as $kk => $choice)
                                        <div class="column is-full">
                                            <p class="control">
                                                @if(count(explode(',',$question->answer)) > 1)
                                                    <span class="checkbox">
                                                        <input disabled type="checkbox" name="answer[{{ $k }}][]" value="{{ $choice->id }}" {{ (in_array($choice->id,explode(',',$question->answer)) ? 'checked' : '') }}/>
                                                    </span>
                                                @else
                                                    <span class="radio">
                                                        <input disabled type="radio" name="answer[{{ $k }}]" value="{{ $choice->id }}" {{ ($choice->id==$question->answer ? 'checked' : '') }}/>
                                                    </span>
                                                @endif

                                                <span>{{ $choice->content }}</span>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            <div class="control is-grouped">
                                <p class="control">
                                    <a href="{{ url('teacher/quiz/'.$quiz->id.'/edit') }}" class="button is-primary" type="submit">Edit Quiz</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
