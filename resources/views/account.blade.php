@extends('layouts.app')

@section('content')
    <div class="container profile ">

        <div class="columns">
            <div class="column is-full">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p class="title">Edit Profile</p>
                            @if (session('status'))
                                <div class="notification is-primary">
                                    <button class="delete"></button>
                                    {{ session('status') }}
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

                            <form action="{{ action('HomeController@update',['id'=>$user->id]) }}" method="POST"  accept="image/*"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="columns">
                                    <div class="column">
                                        <label class="label">Name</label>
                                        <p class="control">
                                            <input class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" type="text" placeholder="Your Name" value="{{ $user->name }}" >
                                            @if ($errors->has('name'))
                                                <span class="help is-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </p>
                                        <label class="label">Email</label>
                                        <p class="control">

                                            @if ($errors->has('email'))
                                                <input class="input is-danger" name="email" type="email" placeholder="jsmith@example.org" value="{{ old('email') }}" >
                                                <span class="help is-danger">{{ $errors->first('email') }}</span>
                                            @else
                                                <input class="input" name="email" type="email" placeholder="jsmith@example.org" value="{{ $user->email }}" >
                                            @endif
                                        </p>
                                        <hr />
                                        <label class="label">Old Password</label>
                                        <p class="control">
                                            <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" type="password" placeholder="*********">
                                            @if ($errors->has('password'))
                                                <span class="help is-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </p>


                                        <label class="label">New Password</label>
                                        <p class="control">
                                            <input class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" name="password_confirmation" type="password" placeholder="*********">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help is-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </p>
                                        <hr>
                                        <button class="button is-primary">Update Profile</button>
                                        <a class="button" href="{{ url('/') }}">Back</a>
                                    </div>
                                    <div class="column">
                                        @if(!$user->hasRole('parent'))
                                            <label class="label">ID Number</label>
                                            <p class="control">
                                                <input class="input" name="idnum" type="text" placeholder="00-000-000" value="{{ $user->infos()->where('key','idnum')->value('value') }}" >
                                            </p>
                                        @endif
                                        <label class="label">Birthday</label>
                                        <p class="control">
                                            <input class="input" name="birthday" type="date" placeholder="Your Birthday" value="{{ $user->infos()->where('key','birthday')->value('value')}}" >
                                        </p>
                                        <label class="label">Profile</label>
                                        <p class="control">
                                            <div class="is-clearfix">
                                                <div class="image is-128x128 is-pulled-left">
                                                    <img src="{{ $user->infos()->where('key','avatar')->value('value') ?: 'https://www.gravatar.com/avatar/' . md5( Auth::user()->email ) . '?d=retro' }}" class=" ">
                                                </div>
                                            </div>
                                            <br>
                                            <input class="input" name="avatar" type="file" >
                                        </p>
                                        <label class="label">Address</label>
                                        <p class="control">
                                            <input class="input" name="address" type="text" placeholder="Complete Address" value="{{ $user->infos()->where('key','address')->value('value') }}" >
                                        </p>
                                        <label class="label">Contact Number</label>
                                        <p class="control">
                                            <input class="input" name="contact" type="text" placeholder="Contact Number" value="{{ $user->infos()->where('key','contact')->value('value') }}" >
                                        </p>
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
