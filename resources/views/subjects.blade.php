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
                            <article class="tile is-child notification is-primary">
                                <p class="title">{{ $subjects[0]->title }}</p>
                                <p class="subtitle">{{ str_limit($subjects[0]->description,30) }}</p>
                            </article>
                        @endif
                        @if(isset($subjects[1]))
                            <article class="tile is-child notification is-warning">
                                <p class="title">{{ $subjects[1]->title }}</p>
                                <p class="subtitle">{{ str_limit($subjects[1]->description,30) }}</p>
                            </article>
                        @endif
                    </div>
                    @if(isset($subjects[2]))
                        <div class="tile is-parent">
                            <article class="tile is-child notification is-info">
                                <p class="title">{{ $subjects[2]->title }}</p>
                                <p class="subtitle">{{ str_limit($subjects[2]->description,30) }}</p>
                                <figure class="image is-4by3">
                                    <img src="http://placehold.it/640x480">
                                </figure>
                            </article>
                        </div>
                    @endif
                </div>
                @if(isset($subjects[4]))
                    <div class="tile is-parent is-bold">

                        <article class="tile is-child notification is-danger">
                            <p class="title">{{ $subjects[4]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[4]->description,30) }}</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </article>

                    </div>
                @endif
            </div>
            @if(isset($subjects[3]))
                <div class="tile is-parent is-4">

                    <article class="tile is-child notification is-success">
                        <div class="content">
                            <p class="title">{{ $subjects[3]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[3]->description,30) }}</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </article>

                </div>
            @endif
        </div>
        <div class="tile is-ancestor">
            @if(isset($subjects[5]))
                <div class="tile is-4 is-parent">

                    <article class="tile is-child notification is-success">
                        <div class="content">
                            <p class="title">{{ $subjects[5]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[5]->description,30) }}</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </article>

                </div>
            @endif
            @if(isset($subjects[6]))
                <div class="tile is-4 is-parent">

                    <article class="tile is-child notification is-warning">
                        <div class="content">
                            <p class="title">{{ $subjects[6]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[6]->description,30) }}</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </article>

                </div>
            @endif
            @if(isset($subjects[7]))
                <div class="tile is-4 is-parent">

                    <article class="tile is-child notification is-danger">
                        <div class="content">
                            <p class="title">{{ $subjects[7]->title }}</p>
                            <p class="subtitle">{{ str_limit($subjects[7]->description,30) }}</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </article>

                </div>
            @endif
        </div>

        <div class="box">
            {{ $subjects->links('vendor.pagination.simple-bulma') }}
        </div>

    </div>



@endsection
