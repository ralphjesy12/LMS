@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'subjects'
        ])
        <div class="spacer"></div>

        <div class="columns">
            <div class="column is-full">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p class="title">{{ $subject->title }}</p>
                            <p class="text-pre">{!! $subject->description !!}</p>
                            <div class="control is-grouped">
                                <p class="control">
                                    <a href="{{ url('teacher/subject/' . $subject->id . '/edit') }}" class="button is-primary">Edit Subject</a>
                                </p>
                                <p class="control">
                                    <a href="{{ url('home/subjects') }}" class="button is-link" type="reset">Go Back</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer"></div>

        <div class="columns is-multiline">
            @foreach ($lessons as $key => $lesson)
                <div class="column is-half">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title min-height-65">
                                {{ $lesson->title }}
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
                                    {{ str_limit(strip_tags($lesson->description),100) }}
                                </p>
                                <small>Last updated {{ $lesson->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="{{ url( 'lesson/' . $lesson->id . '')  }}" target="_blank" class="card-footer-item">View</a>
                            <a href="{{ url( 'teacher/lesson/' . $lesson->id . '/edit' ) }}" class="card-footer-item">Edit</a>
                            <a href="{{ url( 'teacher/lesson/' . $lesson->id . '/delete' ) }}" class="card-footer-item btn-lesson-delete">Delete</a>
                        </footer>
                    </div>
                </div>
            @endforeach
            <div class="column is-half">
                <div class="card">
                    <div class="card-content">
                        <div class="content min-height-100 has-text-centered">
                            <p class="">
                                <h1>Add Lesson</h1>
                                <a href="{{ action('TeacherController@lessonCreate',['id' => $subject->id]) }}">
                                    <span class="icon is-large"><i class="fa fa-plus"></i></span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ $lessons->links() }}
    </div>
@endsection
