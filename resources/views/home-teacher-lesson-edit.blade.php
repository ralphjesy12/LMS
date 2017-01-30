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
                            <p class="title">Edit Lesson</p>
                            <p class="subtitle">{{ $subject->title }}</p>
                            @if (session('status'))
                                <div class="notification is-primary">
                                    <button class="delete"></button>
                                    {{ session('status') }}
                                </div>

                                <div class="control is-grouped">
                                    <p class="control">
                                        <a href="{{ url('lesson/'.session('lesson')) }}" class="button is-link" target="_blank">View</a>
                                    </p>
                                    <p class="control">
                                        <a href="{{ url('teacher/subject/'.$subject->id.'/lessons') }}" class="button is-link" type="reset">Go Back</a>
                                    </p>
                                </div>
                            @endif

                            <form action="{{ action('LessonController@update',['id'=>$lesson->id]) }}" method="post"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <label class="label">Title *</label>
                                <input type="hidden" name="subject_id" value="{{ $subject->id }}"/>
                                <input type="hidden" name="teacher_id" value="{{ Auth::id() }}"/>
                                <p class="control">
                                    <input class="input" type="text" name="title" placeholder="Subject Title" required value="{{ $lesson->title }}">
                                </p>
                                <label class="label">Description *</label>
                                <p class="control">
                                    <textarea class="textarea" name="description" placeholder="Overview" required rows="3">{{ $lesson->description }}</textarea>
                                </p>
                                <label class="label">Content *</label>
                                <p class="control">
                                    <textarea class="textarea" name="content" placeholder="Overview" required rows="10">{{ $lesson->content }}</textarea>
                                </p>
                                <label class="label">Video *</label>
                                <p class="control">

                                    @if(count($lesson->uploads->where('type','=','video')))
                                        <input class="input" type="text" name="video" placeholder="Youtube Video URL e.g. https://www.youtube.com/watch?v=-Nc0wCrkk00" value="{{ $lesson->uploads->where('type','=','video')->first()->path }}"/>   
                                    @else
                                        <input class="input" type="text" name="video" placeholder="Youtube Video URL e.g. https://www.youtube.com/watch?v=-Nc0wCrkk00" value=""/>
                                    @endif


                                </p>
                                <label class="label">Photo *</label>
                                <div class="columns is-multiline">
                                    @foreach ($lesson->uploads->where('type','=','image') as $key => $image)
                                        <div class="column is-one-quarter">
                                            <div class="notification  has-text-centered">
                                                <button class="delete"></button>
                                                <figure class="image is-128x128 is-block">
                                                    <img src="{{ asset($image->path) }}" style="max-height: 128px;">
                                                </figure>
                                                <input type="hidden" name="photoSave[]" value="{{ $image->id }}"/>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>


                                <p class="control has-addons">
                                    <input name="photo[]" type="file" multiple />
                                </p>
                                <div class="control is-grouped is-pulled-right" >
                                    <p class="control">
                                        <a href="{{ url('home/subjects') }}" class="button is-link">Go Back</a>
                                    </p>
                                </div>
                                <div class="control is-grouped">
                                    <p class="control">
                                        <button class="button is-primary" type="submit">Update</button>
                                    </p>
                                    <p class="control">
                                        <button class="button is-link" type="reset">Cancel</button>
                                    </p>

                                </div>
                            </form>
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
