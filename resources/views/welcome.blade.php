@extends('layouts.app')

@section('content')
    <div class="container has-text-centered is-dark">
        <div class="columns is-vcentered">
            <div class="column is-5">
                <figure class="image is-4by3">
                    <img src="{{ asset('img/34-min.jpg') }}" class="promo-img" alt="Description">
                </figure>
            </div>
            <div class="column is-6 is-offset-1">
                <h1 class="title is-2 text-white">
                    Welcome to Kaunlaran
                </h1>
                <h2 class="subtitle is-4 text-white">
                    where learning can be FUN
                </h2>
                <br>
            </div>
        </div>
    </div>
@endsection
