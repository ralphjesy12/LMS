@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-principal',[
            'tab' => 'teachers'
        ])
        <div class="spacer"></div>

        <div class="columns">
            <div class="column is-full">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p class="title">Create Teacher</p>
                            @if (session('status'))
                                <div class="notification is-primary">
                                    <button class="delete"></button>
                                    {{ session('status') }}
                                </div>

                                <div class="control is-grouped">
                                    <p class="control">
                                        <a href="{{ url('principal/teachers') }}" class="button is-link" type="reset">Go Back to Teachers List</a>
                                    </p>
                                </div>
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

                            <form action="{{ action('TeacherController@store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="columns">
                                    <div class="column">
                                        <label class="label">Name</label>
                                        <p class="control">
                                            <input class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" type="text" placeholder="Teacher&apos;s Name" value="{{ old('name') }}" >
                                            @if ($errors->has('name'))
                                                <span class="help is-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </p>
                                        <label class="label">Email</label>
                                        <p class="control">
                                            <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" type="email" placeholder="Teacher&apos;s Email" value="{{ old('email') }}" >
                                            @if ($errors->has('email'))
                                                <span class="help is-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </p>
                                        <hr />
                                        <label class="label">Password</label>
                                        <p class="control">
                                            <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" type="password" placeholder="*********" required>
                                            @if ($errors->has('password'))
                                                <span class="help is-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </p>


                                        <label class="label">Confirm Password</label>
                                        <p class="control">
                                            <input class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" name="password_confirmation" type="password" placeholder="*********" required>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help is-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </p>
                                        <hr>
                                        <button class="button is-primary">Create Student</button>
                                    </div>
                                    <div class="column">

                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
