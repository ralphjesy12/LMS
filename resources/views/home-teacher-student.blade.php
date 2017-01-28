@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'students'
        ])

        <div class="spacer"></div>
        <div class="box">
            <div class="container">
                <div class="content">
                    <a href="{{ url('teacher/student/create') }}" class="button is-primary">Add Student</a>
                </div>
            </div>
        </div>
        <div class="box">

            @foreach ($students as $key => $student)
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="https://www.gravatar.com/avatar/{{ md5( $student->email ) }}?d=retro" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{ $student->name }}</strong> <small>{{ $student->email }}</small> <small style="float:right;">{{ $student->updated_at->diffForHumans() }}</small>
                                <br>
                                <label><strong>ID Number</strong> : {{ $student->infos()->where('key','idnum')->value('value') }}</label><br>
                                <label><strong>Birthday</strong> : {{ $student->infos()->where('key','birthday')->value('value') }}</label>
                            </p>
                        </div>
                        <nav class="level">
                            <div class="level-left">
                                <a href="{{ url('teacher/student/'. $student->id . '/edit') }}" class="level-item has-icon">
                                    <span class="icon is-small"><i class="fa fa-pencil"></i></span>
                                    <small>&nbsp;EDIT</small>
                                </a>
                                <a href="{{ url('teacher/student/'. $student->id . '/delete') }}" class="level-item has-icon">
                                    <span class="icon is-small"><i class="fa fa-trash-o"></i></span>
                                    <small>&nbsp;DELETE</small>
                                </a>
                            </div>
                        </nav>
                    </div>
                </article>
            @endforeach
        </div>

        @if($students->hasPages())
            <div class="box">
                {{ $students->links('vendor.pagination.simple-bulma') }}
            </div>
        @endif
    </div>
@endsection
