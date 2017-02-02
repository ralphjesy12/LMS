@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'quizzes'
        ])

        <div class="spacer"></div>

        <div class="columns is-multiline">

            @foreach ($quizzes as $key => $quiz)
                <div class="column is-3">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title min-height-65">
                                {{ $quiz->title }}
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
                                    {{ str_limit($quiz->description,100) }}
                                </p>
                                <small>Last updated {{ $quiz->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="{{ url( 'teacher/quiz/' . $quiz->id . '')  }}" class="card-footer-item">Preview</a>
                            <a href="{{ url( 'teacher/quiz/' . $quiz->id . '/edit' ) }}" class="card-footer-item">Edit</a>
                            <a href="{{ url( 'teacher/quiz/' . $quiz->id . '/delete' ) }}" class="card-footer-item btn-quiz-delete">Delete</a>
                        </footer>
                    </div>
                </div>
            @endforeach
            <div class="column is-3">
                <form class="card" action="{{ action('QuizController@create') }}" method="GET">
                    <header class="card-header">
                        <p class="card-header-title">
                            Create quiz
                        </p>
                        <a class="card-header-icon">
                            <span class="icon">
                                <i class="fa fa-plus"></i>
                            </span>
                        </a>
                    </header>
                    <div class="card-content">
                        <label class="label">Lesson</label>
                        <p class="control">
                            <span class="select is-fullwidth">
                                <select name="subject">
                                    <?php
                                    $subjectGroup = [];

                                    foreach ($lessons as $key => $lesson) {
                                        if(isset($lesson->subject)){
                                            if(!isset($subjectGroup[$lesson->subject->title])){
                                                $subjectGroup[$lesson->subject->title] = [];
                                            }
                                            $subjectGroup[$lesson->subject->title][] = $lesson;
                                        }
                                    }
                                    ?>
                                    @foreach ($subjectGroup as $subject => $lessons)
                                        <optgroup label="{{ $subject }}">
                                        @foreach ($lessons as $key => $lesson)
                                            <option value="{{ $lesson->id }}" {{ (!empty($_GET['lesson']) && $lesson->id==$_GET['lesson'] ? 'selected' : '') }}>{{ $lesson->title }}</option>
                                        @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </span>
                        </p>
                    </div>
                    <footer class="card-footer">
                        <div class="card-footer-item">
                            <button type="submit" class="button is-link card-footer-item">Create</button>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
        @if($quizzes->hasPages())
            <div class="box">
                {{ $quizzes->links('vendor.pagination.simple-bulma') }}
            </div>
        @endif
    </div>
@endsection
