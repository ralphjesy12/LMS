@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'exams'
        ])

        <div class="spacer"></div>

        <div class="columns is-multiline">

            @foreach ($exams as $key => $exam)
                <div class="column is-3">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title min-height-65">
                                {{ $exam->title }}
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
                                    {{ str_limit($exam->description,100) }}
                                </p>
                                <small>Last updated {{ $exam->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="{{ url( 'teacher/exam/' . $exam->id . '')  }}" class="card-footer-item">Preview</a>
                            <a href="{{ url( 'teacher/exam/' . $exam->id . '/edit' ) }}" class="card-footer-item">Edit</a>
                            <a href="{{ url( 'teacher/exam/' . $exam->id . '/delete' ) }}" class="card-footer-item btn-exam-delete">Delete</a>
                        </footer>
                    </div>
                </div>
            @endforeach
            <div class="column is-3">
                <form class="card" action="{{ action('ExamController@create') }}" method="GET">
                    <header class="card-header">
                        <p class="card-header-title">
                            Create exam
                        </p>
                        <a class="card-header-icon">
                            <span class="icon">
                                <i class="fa fa-plus"></i>
                            </span>
                        </a>
                    </header>
                    <div class="card-content">
                        <p class="control">
                            <span class="select is-fullwidth">
                                <select name="subject">
                                    @foreach ($subjects as $key => $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->title }}</option>
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
        {{ $exams->links() }}
    </div>
@endsection
