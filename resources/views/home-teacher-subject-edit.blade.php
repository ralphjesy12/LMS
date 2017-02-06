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
                            <p class="title">Edit Subject</p>
                            @if (session('status'))
                                <div class="notification is-primary">
                                    <button class="delete"></button>
                                    {{ session('status') }}
                                </div>

                                <div class="control is-grouped">
                                    <p class="control">
                                        <a href="{{ url('subject/'.session('subject').'/lessons') }}" class="button is-link">View</a>
                                    </p>
                                    <p class="control">
                                        <a href="{{ url('teacher/subjects') }}" class="button is-link" type="reset">Go Back</a>
                                    </p>
                                </div>
                            @endif

                            <form id="update-subject" action="{{ action('SubjectController@update',['id'=>$subject->id]) }}" method="POST">
                                {{ csrf_field() }}
                                <label class="label">Title *</label>
                                <p class="control">
                                    <input class="input" type="text" name="title" placeholder="Subject Title" required value="{{ $subject->title }}">
                                </p>
                                <label class="label">Description *</label>
                                <p class="control">
                                    <input type="hidden" name="description"/>
                                    <div id="toolbar-container">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-header"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="editor">
                                        {!! $subject->description !!}
                                    </div>
                                </p>
                                <div class="control is-grouped is-pulled-right" >
                                    <p class="control">
                                        <a href="{{ url('teacher/subject/'.$subject->id.'/lessons') }}" class="button is-link">Go Back</a>
                                    </p>
                                </div>
                                <div class="control is-grouped">
                                    <p class="control">
                                        <button class="button is-primary" type="submit">Update</button>
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

@push('styles')
    <link href="{{ asset('js/quill/quill.snow.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/quill/quill.min.js') }}"></script>
    <script>

    $(function(){
        var quill = new Quill('#editor', {
            placeholder: 'Subject Overview...',
            theme: 'snow',
            modules: {
                toolbar: '#toolbar-container'
            },
        });

        $('#update-subject').submit(function(event){


            var tempCont = document.createElement("div");
            (new Quill(tempCont)).setContents(quill.getContents());
            $('input[name=description').val(tempCont.getElementsByClassName("ql-editor")[0].innerHTML);

            if($('input[name=description').val()!='') return true;

                event.preventDefault();

        });
    });
    </script>
@endpush
