@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="content">
                    <p class="title">{{ $quiz->title }}</p>
                    <p class="subtitle">{{ $quiz->lesson->subject->title }} : {{ $quiz->lesson->title }}</p>

                    <p>
                        {{ $quiz->description }}
                    </p>
                    <hr />

                    @if($question)
                        <form action="{{ action('QuizController@submitAnswer',[ 'id' => $quiz->id , 'q' => $q])}}" method="POST">
                            {{ csrf_field() }}
                            <p><strong>Question # {{ $q }} : </strong>
                                {{ $question->content }}
                            </p>
                            <input type="hidden" name="quiz" value="{{ $quiz->id }}"/>
                            <input type="hidden" name="question" value="{{ $question->id }}"/>
                            <div class="columns is-multiline">
                                @foreach ($question->choices as $kk => $choice)
                                    <div class="column is-half">
                                        <p class="control">
                                            @if(count(explode(',',$question->answer)) > 1)
                                                <span class="checkbox">
                                                    <input id="choice-{{ $kk }}" type="checkbox" name="answer[]" value="{{ $choice->id }}" required/>
                                                </span>
                                            @else
                                                <span class="radio">
                                                    <input id="choice-{{ $kk }}" type="radio" name="answer[]" value="{{ $choice->id }}" required/>
                                                </span>
                                            @endif

                                            <label for="choice-{{ $kk }}">{{ $choice->content }}</label>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="control is-group">
                                <button type="submit" class="button is-warning">Submit &amp; Continue</button>
                            </div>
                        </form>
                    @else
                        <label class="label">{{ $quiz->quizQuestions->count() }} items</label>

                        @if($answers->count())
                            <label class="label">{{ $answers->count() }} answered</label>

                            @if($quiz->quizQuestions->count() == $answers->count())
                                <label class="title is-3">{{ $score }} out of {{ $scoreTotal }} ({{ number_format((($score/$scoreTotal)*100),2) }}%)</label>
                                <hr />
                                <div class="control is-group">
                                    <a href="{{ url('lesson/' . $quiz->lesson->id) }}" class="button is-warning"><span>Back to Lesson</span></a>
                                </div>
                            @else
                                <div class="control is-group">
                                    <a href="{{ url('student/quiz/'.$quiz->id.'/question/' . ($answers->count() + 1)) }}" class="button is-warning"><span>Continue Quiz</span></a>
                                </div>
                            @endif
                        @else
                            <div class="control is-group">
                                <a href="{{ url('student/quiz/'.$quiz->id.'/question/1') }}" class="button is-warning"><span>Start Quiz Now</span></a>
                            </div>

                        @endif

                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
    jQuery(function($){

        var requiredCheckboxes = $(':checkbox[required]');

        requiredCheckboxes.change(function(){

            if(requiredCheckboxes.is(':checked')) {
                requiredCheckboxes.removeAttr('required');
            }

            else {
                requiredCheckboxes.attr('required', 'required');
            }
        });

    });

    </script>
@endpush
