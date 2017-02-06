@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-student',[
            'tab' => 'grades'
        ])
        <div class="spacer"></div>

        <div class="columns">
            <div class="column is-full">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p class="title">View Grades</p>
                            @if (session('status'))
                                <div class="notification is-primary">
                                    <button class="delete"></button>
                                    {{ session('status') }}
                                </div>

                                <div class="control is-grouped">
                                    <p class="control">
                                        <a href="{{ url('teacher/students') }}" class="button is-link" type="reset">Go Back to Student List</a>
                                    </p>
                                </div>
                            @endif

                            @if (count($errors))
                                <div class="notification is-danger">
                                    <button class="delete"></button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <div class="columns is-multiline">

                                    @foreach ($subjects as $key => $subject)
                                        <div class="column is-full">
                                            <div class="columns">
                                                <div class="column">
                                                    <label class="label">{{ $subject->title }}</label>
                                                </div>
                                                <div class="column">

                                                    <p>
                                                        <div class="columns">
                                                            <div class="column">
                                                                <small><strong>Lessons Viewed</strong></small>
                                                            </div>
                                                            <div class="column">
                                                                <small><strong>{{ $subject->lessonsViewed }} / {{ $subject->lessons->count() }}</strong></small>
                                                            </div>
                                                            <div class="column">
                                                                <small><strong>{{ $subject->lessons->count() ? number_format( ($subject->lessonsViewed / $subject->lessons->count())*100,2) : 0 }}%</strong></small>
                                                            </div>
                                                        </div>
                                                        <div class="columns">
                                                            <div class="column">
                                                                <small><strong>Quizzes Taken</strong></small>
                                                            </div>
                                                            <div class="column">
                                                                <small><strong>{{ $subject->lessonsQuizTook }} / {{ $subject->lessonsQuizTotal }}</strong></small>
                                                            </div>
                                                            <div class="column">
                                                                <small><strong>{{ $subject->lessonsQuizTotal ? number_format(($subject->lessonsQuizTook / $subject->lessonsQuizTotal)*100,2) : 0 }}%</strong></small>
                                                            </div>
                                                        </div>
                                                        <div class="columns">
                                                            <div class="column">
                                                                <small><strong>Exams Taken</strong></small>
                                                            </div>
                                                            <div class="column">
                                                                <small><strong>{{ $subject->examsTaken }} / {{ $subject->examsTotal }}</strong></small>
                                                            </div>
                                                            <div class="column">
                                                                <small><strong>{{ $subject->examsTotal ? number_format(($subject->examsTaken / $subject->examsTotal)*100,2)  : 0  }}%</strong></small>
                                                            </div>
                                                        </div>
                                                    </p>
                                                </div>
                                                <div class="column is-2">
                                                    <p class="control">
                                                        <input class="input" type="text" readonly=" "value="{{ Auth::user()->grade()->where(['subject_id' => $subject->id])->value('grade') }}%">
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                    <div class="column is-full">
                                        <div class="columns">
                                            <div class="column">
                                                <label class="label">Total Grade</label>
                                            </div>
                                            <div class="column">

                                            </div>
                                            <div class="column is-2">
                                                <p class="control">
                                                    <input class="input is-large" readonly type="text" value="{{ number_format(Auth::user()->grade()->avg('grade'),2) }}%">
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
