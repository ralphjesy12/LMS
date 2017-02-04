@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-principal',[
            'tab' => 'teachers'
        ])

        <div class="spacer"></div>
        <div class="box">
            <div class="container">
                <div class="content">
                    <a href="{{ url('principal/teacher/create') }}" class="button is-primary">Add New Teacher</a>
                </div>
            </div>
        </div>

        <div class="spacer"></div>

        <div class="box">
            @foreach ($teachers as $key => $teacher)
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="https://www.gravatar.com/avatar/{{ md5( $teacher->email ) }}?d=retro" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{ $teacher->name }}</strong> <small>{{ $teacher->email }}</small> <small style="float:right;">{{ $teacher->updated_at->diffForHumans() }}</small>
                            </p>
                            <div class="columns">
                                <div class="column">
                                    <p>
                                    
                                    </p>
                                </div>
                                <div class="column">
                                    <p>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <nav class="level">
                            <div class="level-left">
                                <a href="{{ url('principal/teacher/'. $teacher->id . '/edit') }}" class="level-item has-icon">
                                    <span class="icon is-small"><i class="fa fa-pencil"></i></span>
                                    <small>&nbsp;EDIT</small>
                                </a>
                                <a href="{{ url('principal/teacher/'. $teacher->id . '/delete') }}" class="level-item has-icon">
                                    <span class="icon is-small"><i class="fa fa-trash-o"></i></span>
                                    <small>&nbsp;DELETE</small>
                                </a>
                            </div>
                        </nav>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
