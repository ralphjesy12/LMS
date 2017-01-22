@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'exams'
        ])
        <div class="spacer"></div>

        <div class="columns">
            <div class="column is-full">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p class="title">Create New Exam</p>
                            @if (session('status'))
                                <div class="notification is-primary">
                                    <button class="delete"></button>
                                    {{ session('status') }}
                                </div>

                                <div class="control is-grouped">
                                    <p class="control">
                                        <a href="{{ url('teacher/exam/'.session('exam')) }}" class="button is-link">View</a>
                                    </p>
                                    <p class="control">
                                        <a href="{{ url('teacher/exams') }}" class="button is-link" type="reset">Go Back</a>
                                    </p>
                                </div>
                            @endif

                            <form id="exam-create" action="{{ route('exam.store') }}" method="post">
                                {{ csrf_field() }}
                                <label class="label">Title *</label>
                                <p class="control">
                                    <input class="input" type="text" name="title" placeholder="Exam Title" required>
                                </p>
                                <label class="label">Subject *</label>
                                <p class="control">
                                    <span class="select is-fullwidth">
                                        <select name="subject_id">
                                            @foreach ($subjects as $key => $subject)
                                                <option value="{{ $subject->id }}" {{ ($subject->id==$_GET['subject'] ? 'selected' : '') }}>{{ $subject->title }}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </p>
                                <label class="label">Directions *</label>
                                <p class="control">
                                    <textarea class="textarea" name="description" placeholder="General Directions" required></textarea>
                                </p>

                                <div class="question-group">
                                    <hr>
                                    <label class="is-pulled-right">
                                        <p class="control">
                                            <button class="button is-danger is-small btn-delete-question is-disabled">
                                                <span class="icon is-small"><i class="fa fa-trash"></i></span>
                                            </button>
                                        </p>
                                    </label>
                                    <label class="label">Question</label>
                                    <p class="control">
                                        <textarea class="textarea input-question" name="question[0]" placeholder="Whats your question?" required></textarea>

                                        <p class="help">
                                            Note: Check atleast one of the choices. Checking two or more makes the question a multiple choice type.
                                        </p>
                                    </p>
                                    <label class="label">Choices</label>
                                    <div class="columns is-multiline choices-wrapper">
                                        <?php $minChoices = 2; ?>
                                        @for ($i=0; $i < $minChoices; $i++)
                                            <div class="column is-half choice-group">
                                                <p class="control is-grouped has-addons has-addons-right">
                                                    <span class="checkbox">
                                                        <input type="checkbox" name="answer[0][]" class="input-answer" value="{{$i}}" />
                                                    </span>
                                                    <input type="text" name="choice[0][{{$i}}]" class="input is-expanded input-choice" placeholder="Choice content here" required/>
                                                    <a href="#" class="button is-danger btn-remove-choice is-disabled">
                                                        <span class="icon">
                                                            <i class="fa fa-trash-o"></i>
                                                        </span>
                                                    </a>
                                                </p>
                                            </div>
                                        @endfor
                                        <div class="column is-half">
                                            <p class="has-text-centered is-bordered-dashed">
                                                <a href="#" class="btn-add-choices">Add more choices</a>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                <hr>

                                <p class="has-text-centered is-bordered-dashed">
                                    <a href="#" class="btn-add-questions">Add more questions</a>
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
