@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'subjects'
        ])

        <div class="box content">
            <!-- Main container -->
            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong>123</strong> posts
                        </p>
                    </div>
                    <div class="level-item">
                        <p class="control has-addons">
                            <input class="input" type="text" placeholder="Find a post">
                            <button class="button">
                                Search
                            </button>
                        </p>
                    </div>
                </div>

                <!-- Right side -->
                <div class="level-right">
                    <p class="level-item"><strong>All</strong></p>
                    <p class="level-item"><a>Published</a></p>
                    <p class="level-item"><a>Drafts</a></p>
                    <p class="level-item"><a>Deleted</a></p>
                    <p class="level-item"><a href="{{ url('home/subject/new') }}" class="button is-success">New</a></p>
                </div>
            </nav>
        </div>

        <div class="spacer"></div>

        <div class="columns is-multiline">
            @foreach ($subjects as $key => $subject)
                <div class="column is-3">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                {{ $subject->title }}
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
                                    {{ str_limit($subject->description,50) }}
                                </p>
                                <small>Last updated {{ $subject->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="{{ url( 'home/subject/' . $subject->id ) }}" class="card-footer-item">View</a>
                            <a href="{{ url( 'home/subject/edit/' . $subject->id ) }}" class="card-footer-item">Edit</a>
                            <a href="{{ url( 'home/subject/delete/' . $subject->id ) }}" class="card-footer-item">Delete</a>
                        </footer>
                    </div>
                </div>
            @endforeach

        </div>
        {{ $subjects->links() }}
    </div>
@endsection
