@extends('layouts.app')

@section('content')
    <div class="container profile ">
        <div class="columns">
            <div class="column is-full">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p class="title">Backup and Restore</p>
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
                            <div class="columns">


                            @if($lastRestore)
                                <div class="column is-3">
                                    <div class="card">
                                        <header class="card-header">
                                            <p class="card-header-title">
                                                Last Restore
                                            </p>
                                            <a class="card-header-icon">
                                                <span class="icon">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                            </a>
                                        </header>
                                        <div class="card-content">
                                            <div class="content">
                                                <p>
                                                    Backup Size : {{ $lastRestore['size'] }}
                                                </p>
                                                <small>{{ $lastRestore['date']->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        <footer class="card-footer">
                                            <a class="card-footer-item" href="{{ action('BackupRestoreController@restore') }}">Restore</a>
                                            <a class="card-footer-item" href="{{ action('BackupRestoreController@delete') }}">Delete</a>
                                        </footer>
                                    </div>
                                </div>
                            @else
                                <div class="column is-3">
                                    <div class="card">
                                        <header class="card-header">
                                            <p class="card-header-title">
                                                Last Restore
                                            </p>
                                            <a class="card-header-icon">
                                                <span class="icon">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                            </a>
                                        </header>
                                        <div class="card-content">
                                            <div class="content">
                                                <p>
                                                    No Backups yet.
                                                </p>
                                            </div>
                                        </div>
                                        <footer class="card-footer">
                                            <a class="card-footer-item" href="{{ action('BackupRestoreController@create') }}">Create Backup Now</a>
                                        </footer>
                                    </div>
                                </div>
                            @endif


</div>
@if(Auth::user()->hasRole('principal'))
    <a href="{{ action('HomeController@account') }}" class="button is-default">Go Back</a>
@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
