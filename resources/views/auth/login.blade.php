@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-vcentered">
            <div class="column is-4 is-offset-4">
                <h1 class="title text-white">
                    <?php
                    if(isset($level)):
                        echo [
                            0 => '',
                            1 => 'Student',
                            2 => 'Teacher',
                            3 => 'Parent',
                            4 => 'Principal',
                        ][$level];
                    else:
                        echo 'Student';
                    endif;
                    ?> Login
                </h1>
                <form class="box content" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <label class="label">Email</label>
                    <p class="control">
                        <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" type="email" placeholder="jsmith@example.org" value="{{ old('email') }}" >
                        @if ($errors->has('email'))
                            <span class="help is-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </p>

                    <label class="label">Password</label>
                    <p class="control">
                        <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required type="password" placeholder="*********">
                        @if ($errors->has('password'))
                            <span class="help is-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </p>
                    <p class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
                            Remember me
                        </label>
                    </p>

                    <?php if(isset($level)): ?>
                        <input type="hidden" name="level" value="{{ $level }}"/>
                    <?php endif; ?>
                    <hr>
                    <p class="control">
                        <button class="button is-primary" type="submit">Login</button>
                        <button class="button is-default" type="reset">Cancel</button>
                    </p>
                </form>
                <p class="has-text-centered">
                    <a href="{{ url('register') }}">Register an Account</a>
                    |
                    <a href="{{ url('/password/reset') }}">Forgot password</a>
                </p>
            </div>
        </div>
    </div>
@endsection
