@extends('layouts.app')

@section('content')
    <div class="container subjects ">
        <div class="box content">
            <!-- Main container -->
            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong>{{ $subjects->total() }}</strong> subjects
                        </p>

                    </div>
                    <div class="level-item">
                        <p class="control has-addons">
                            <input class="input" type="text" placeholder="Find a subject">
                            <button class="button">
                                Search
                            </button>
                        </p>
                    </div>
                </div>
            </nav>
        </div>

        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
                <div class="tile">
                    <div class="tile is-parent is-vertical">
                        @if(isset($subjects[0]))
                            <a href="{{ url('subject/'.$subjects[0]->id.'/lessons') }}" class="is-block tile is-child notification is-subject-tile is-primary is-{{ str_slug($subjects[0]->title) }}">
                                <p class="title">{{ $subjects[0]->title }}</p>
                                <p class="subtitle">{{ str_limit(strip_tags($subjects[0]->description),30) }}</p>
                            </a>
                        @endif
                        @if(isset($subjects[1]))
                            <a href="{{ url('subject/'.$subjects[1]->id.'/lessons') }}" class="is-block tile is-child notification is-subject-tile is-warning is-{{ str_slug($subjects[1]->title) }}">
                                <p class="title">{{ $subjects[1]->title }}</p>
                                <p class="subtitle">{{ str_limit(strip_tags($subjects[1]->description),30) }}</p>
                            </a>
                        @endif
                    </div>
                    @if(isset($subjects[2]))
                        <div class="tile is-parent">
                            <a href="{{ url('subject/'.$subjects[2]->id.'/lessons') }}" class="is-block tile is-child notification is-subject-tile is-info is-{{ str_slug($subjects[2]->title) }}">
                                <p class="title">{{ $subjects[2]->title }}</p>
                                <p class="subtitle">{{ str_limit($subjects[2]->description,30) }}</p>
                            </a>
                        </div>
                    @endif
                </div>
                @if(isset($subjects[4]))
                    <div class="tile is-parent is-bold">
                        <a href="{{ url('subject/'.$subjects[4]->id.'/lessons') }}" class="tile is-block is-child notification is-subject-tile is-danger is-{{ str_slug($subjects[4]->title) }}">
                            <p class="title">{{ $subjects[4]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[4]->description,30) }}</p>
                        </a>
                    </div>
                @endif
            </div>
            @if(isset($subjects[3]))
                <div class="tile is-parent is-4">

                    <a href="{{ url('subject/'.$subjects[3]->id.'/lessons') }}" class="is-block tile is-child notification is-subject-tile is-success is-{{ str_slug($subjects[3]->title) }}">
                        <div class="content">
                            <p class="title">{{ $subjects[3]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[3]->description,30) }}</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </a>

                </div>
            @endif
        </div>
        <div class="tile is-ancestor">
            @if(isset($subjects[5]))
                <div class="tile is-4 is-parent">

                    <a href="{{ url('subject/'.$subjects[5]->id.'/lessons') }}" class="is-block tile is-child notification is-subject-tile is-success is-{{ str_slug($subjects[5]->title) }}">
                        <div class="content">
                            <p class="title">{{ $subjects[5]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[5]->description,30) }}</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </a>

                </div>
            @endif
            @if(isset($subjects[6]))
                <div class="tile is-4 is-parent">

                    <a href="{{ url('subject/'.$subjects[6]->id.'/lessons') }}" class="is-block tile is-child notification is-subject-tile is-warning is-{{ str_slug($subjects[6]->title) }}">
                        <div class="content">
                            <p class="title">{{ $subjects[6]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[6]->description,30) }}</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </a>

                </div>
            @endif
            @if(isset($subjects[7]))
                <div class="tile is-4 is-parent">

                    <a href="{{ url('subject/'.$subjects[7]->id.'/lessons') }}" class="is-block tile is-child notification is-subject-tile is-danger is-{{ str_slug($subjects[7]->title) }}">
                        <div class="content">
                            <p class="title">{{ $subjects[7]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[7]->description,30) }}</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </a>

                </div>
            @endif
        </div>
        @if($subjects->hasPages())
            <div class="box">
                {{ $subjects->links('vendor.pagination.simple-bulma') }}
            </div>
        @endif
    </div>



@endsection
