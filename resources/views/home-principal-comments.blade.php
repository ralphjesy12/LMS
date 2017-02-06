@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-principal',[
            'tab' => 'comments'
        ])

        <div class="spacer"></div>
        <div class="box">
            @if($comments->count()>0)
                @foreach($comments as $comment)
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="https://www.gravatar.com/avatar/{{ md5( $comment->user->email ) }}?d=retro">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>{{ $comment->user->id == Auth::id() ? 'You' : $comment->user->name }}</strong> <small>{{ $comment->user->email }} &middot; commented on <a href="{{ url('/lesson/'.str_ireplace('lesson-','',$comment->type)) }}" target="_blank">lesson</a> &middot; {{ $comment->updated_at->diffForHumans() }}</small>
                                    <br>
                                    {{ $comment->content }}
                                    <br>
                                </p>
                            </div>
                            @if($comment->user->id == Auth::id())
                                <nav class="level">
                                    <div class="level-left">
                                        <a class="level-item" href="comment/{{ $comment->id }}/delete">
                                            <span class="icon is-small"><i class="fa fa-trash"></i></span>
                                            <spam>Delete</spam>
                                        </a>
                                    </div>
                                </nav>
                            @endif
                        </div>
                    </article>
                @endforeach
            @else
                <article class="media has-text-centered ">
                    <h1 class="title is-block is-4">No comments yet</h1>
                </article>
            @endif
        </div>
        {{ $comments->links() }}
    </div>
@endsection
