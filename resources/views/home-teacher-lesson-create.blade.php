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
                            <p class="title">Add New Lesson</p>
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
                            @else

                                <form id="create-lesson" action="{{ route('lesson.store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <label class="label">Title *</label>
                                    <input type="hidden" name="subject_id" value="{{ $subject->id }}"/>
                                    <input type="hidden" name="teacher_id" value="{{ Auth::id() }}"/>
                                    <p class="control">
                                        <input class="input" type="text" name="title" placeholder="Subject Title" required>
                                    </p>
                                    <label class="label">Description *</label>
                                    <p class="control">
                                        <textarea class="textarea" name="description" placeholder="Description" required rows="5"></textarea>
                                    </p>
                                    <label class="label">Content *</label>
                                    <p class="control">
                                        <input type="hidden" name="content"/>
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
                                        <div id="editor"></div>
                                    </p>
                                    <label class="label">Video *</label>
                                    <p class="control">
                                        <input type="text" class="input" name="video" placeholder="Youtube Video URL e.g. https://www.youtube.com/watch?v=-Nc0wCrkk00"/>
                                    </p>
                                    <label class="label">Photo *</label>
                                    <p class="control has-addons">
                                        <input name="photo[]" type="file" class="input" multiple />
                                    </p>

                                    <div class="control is-grouped is-pulled-right" >
                                        <p class="control">
                                            <a href="{{ url('home/subjects') }}" class="button is-link">Go Back</a>
                                        </p>
                                    </div>
                                    <div class="control is-grouped">
                                        <p class="control">
                                            <button class="button is-primary" type="submit">Save</button>
                                        </p>
                                        <p class="control">
                                            <button class="button is-link" type="reset">Cancel</button>
                                        </p>

                                    </div>
                                </form>
                            @endif
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
            placeholder: 'Lesson Content...',
            theme: 'snow',
            modules: {
                toolbar: '#toolbar-container'
            },
        });

        function imageHandler() {
            var range = this.quill.getSelection();
            var value = prompt('What is the image URL?');
            this.quill.insertEmbed(range.index, '', value, Quill.sources.USER);
        }

        var toolbar = quill.getModule('toolbar');
        toolbar.addHandler('image', imageHandler);

        $('#create-lesson').submit(function(event){
            var tempCont = document.createElement("div");
            (new Quill(tempCont)).setContents(quill.getContents());
            $('input[name=content').val(tempCont.getElementsByClassName("ql-editor")[0].innerHTML);
            if($('input[name=content').val()!='') return true;
                event.preventDefault();
        });
    });
    </script>
@endpush
