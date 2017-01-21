@extends('layouts.app')

@section('content')
    <div class="container has-text-centered is-dark">
        <div class="columns is-vcentered">
            <div class="column is-12 has-text-centered">
                <h1 class="title is-2 text-white">
                    Something went wrong. We will fix it now.
                </h1>
                <h2 class="subtitle is-4 text-white">
                    While waiting. You can easily go back to our homepage
                </h2>
                <p class=" has-text-centered">
                    <a href="{{ url('/') }}" class="is-block button is-large is-danger">
                        Back to Homepage
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
