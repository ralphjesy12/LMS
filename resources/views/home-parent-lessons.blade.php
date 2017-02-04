@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-parent',[
            'tab' => 'lessons'
        ])

        <div class="spacer"></div>

        <div class="columns is-multiline">
            @foreach ($lessons as $key => $lesson)
                <div class="column is-full">
                    <div class="box">
                        <article class="media">
                            <div class="media-left">
                                <figure class="image is-64x64">
                                    <img src="{{ $lesson->imagepath ?: '/img/'.(strtolower(studly_case($lesson->subject->title))).'/icon' . ($key==0 ? '' : ' ('.$key.')') . '.png' }}" alt="Image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>{{ $lesson->title }}</strong> <small>{{ $lesson->subject->title }}</small> <small style="float:right;">{{ $lesson->updated_at->diffForHumans() }}</small>
                                    </p>
                                    <div class="columns">
                                        <div class="column">
                                            <p>
                                                <label><strong>Description</strong> : {{ $lesson->description }}</label><br>

                                            </p>
                                        </div>
                                        <div class="column">
                                            <div class="content">
                                                <div class="columns is-multiline">
                                                    @foreach ($lesson->logs as $key => $log)
                                                            <div class="column is-half is-paddingless">
                                                                <small class="is-block">
                                                                    <span class="icon is-small">
                                                                        @if($log['status'] == 'OK')
                                                                            <i class="fa fa-check"></i>
                                                                        @else
                                                                            <i class="fa fa-circle-o"></i>
                                                                        @endif
                                                                    </span>
                                                                    <span>{!! $log['message'] !!}</span>
                                                                </small>
                                                            </div>
                                                            <div class="column is-half is-paddingless">
                                                                @if($log['time'])
                                                                    <small class="is-block">
                                                                        <span title="{{ $log['time']->toDateTimeString() }}">{{ $log['time']->diffForHumans() }}</span>
                                                                    </small>
                                                                @endif
                                                            </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <nav class="level">
                                    <div class="level-left">
                                        <a href="{{ url('lesson/'. $lesson->id . '') }}" target="_blank" class="level-item has-icon">
                                            <span class="icon is-small"><i class="fa fa-eye"></i></span>
                                            <small>&nbsp;VIEW LESSON</small>
                                        </a>
                                    </div>
                                </nav>
                            </div>
                        </article>
                    </div>
                </div>
            @endforeach

        </div>
        @if($lessons->hasPages())
            <div class="box">
                {{ $lessons->links('vendor.pagination.simple-bulma') }}
            </div>
        @endif
    </div>
@endsection
