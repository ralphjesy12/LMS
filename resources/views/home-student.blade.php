@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-student',[
            'tab' => 'activity'
        ])

        <div class="spacer"></div>

        <div class="box">
            @for ($i=0; $i < 10; $i++)
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="http://placehold.it/128x128" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>John Smith</strong> <small>@johnsmith</small> <small style="float:right;">31m</small>
                                <br>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                            </p>
                        </div>
                        <nav class="level">
                            <div class="level-left">
                                <a class="level-item">
                                    <span class="icon is-small"><i class="fa fa-reply"></i></span>
                                </a>
                                <a class="level-item">
                                    <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                                </a>
                                <a class="level-item">
                                    <span class="icon is-small"><i class="fa fa-heart"></i></span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </article>
            @endfor
        </div>
    </div>
@endsection
