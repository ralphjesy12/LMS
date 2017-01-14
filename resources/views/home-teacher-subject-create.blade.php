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
                            <p class="title">Create New Subject</p>
                            @if (session('status'))
                                <div class="notification is-primary">
                                    <button class="delete"></button>
                                    {{ session('status') }}
                                </div>

                                <div class="control is-grouped">
                                    <p class="control">
                                        <a href="{{ url('home/subject/'.session('subject')) }}" class="button is-link">View</a>
                                    </p>
                                    <p class="control">
                                        <a href="{{ url('home/subjects') }}" class="button is-link" type="reset">Go Back</a>
                                    </p>
                                </div>
                            @else

                                <form action="{{ route('subject.store') }}" method="post">
                                    {{ csrf_field() }}
                                    <label class="label">Title *</label>
                                    <p class="control">
                                        <input class="input" type="text" name="title" placeholder="Subject Title" required>
                                    </p>
                                    <label class="label">Description *</label>
                                    <p class="control">
                                        <textarea class="textarea" name="description" placeholder="Overview" required></textarea>
                                    </p>
                                    <div class="control is-grouped is-pulled-right" >
                                        <p class="control">
                                            <a href="{{ url('home/subjects') }}" class="button is-link">Go Back</a>
                                        </p>
                                    </div>
                                    <div class="control is-grouped">
                                        <p class="control">
                                            <button class="button is-primary" type="submit">Save</button>
                                        </p>
                                        <p class="control">
                                            <button class="button is-link" type="reset">Cancel</button>
                                        </p>

                                    </div>
                                </form>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
