@extends('layouts.app')

@section('content')
    <script>
    window.location.assign('/');
    </script>
    <div class="container">
        <div class="columns is-vcentered">
            <div class="column is-4 is-offset-4">
                <h1 class="title">
                    Create an Account
                </h1>
                <form class="box content" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                    <label class="label">Name</label>
                    <p class="control">
                        <input class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" type="text" placeholder="Your Name" value="{{ old('name') }}" >
                        @if ($errors->has('name'))
                            <span class="help is-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </p>
                    <label class="label">Email</label>
                    <p class="control">
                        <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" type="email" placeholder="jsmith@example.org" value="{{ old('email') }}" >
                        @if ($errors->has('email'))
                            <span class="help is-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </p>
                    <hr />
                    <label class="label">Password</label>
                    <p class="control">
                        <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required type="password" placeholder="*********">
                        @if ($errors->has('password'))
                            <span class="help is-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </p>


                    <label class="label">Confirm Password</label>
                    <p class="control">
                        <input class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" name="password_confirmation" required type="password" placeholder="*********">
                        @if ($errors->has('password_confirmation'))
                            <span class="help is-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </p>
                    <hr>
                    <p class="control">
                        <button class="button is-primary" type="submit">Register</button>
                        <button class="button is-default" type="reset">Cancel</button>
                    </p>
                </form>
                <p class="has-text-centered">
                    <a href="{{ url('login') }}">Already have an account?</a>
                    |
                    <a href="{{ url('/password/reset') }}">Forgot password</a>
                </p>
            </div>
        </div>
    </div>
@endsection
