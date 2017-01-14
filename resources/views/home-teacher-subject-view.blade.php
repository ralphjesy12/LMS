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
                            <p>{{ $subject->description }}</p>
                            <div class="control is-grouped">
                                <p class="control">
                                    <a href="{{ url('home/subject/edit/'.session('subject')) }}" class="button is-primary">Edit Subject</a>
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
    </div>
@endsection
