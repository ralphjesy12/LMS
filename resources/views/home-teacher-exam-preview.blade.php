@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'exams'
        ])
        <div class="spacer"></div>

        <div class="columns">
            <div class="column is-full">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p class="title">Preview Exam</p>
                            <p class="subtitle">{{ $exam->subject->title }}</p>

                            <label class="label">{{ $exam->title }}</label>
                            <p>
                                {{ $exam->description }}
                            </p>

                            @foreach ($exam->examQuestions as $k => $question)
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
                                    <a href="{{ url('teacher/exam/'.$exam->id.'/edit') }}" class="button is-primary" type="submit">Edit Exam</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
