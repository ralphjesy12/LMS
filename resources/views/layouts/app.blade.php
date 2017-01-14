<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Landing - Free Bulma template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bulma.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lms.css') }}">

    <!-- Scripts -->
    <script>
    window.Laravel = "{{ json_encode([ 'csrfToken' => csrf_token(), ]) }}";
    </script>
</head>
<body>


    <section class="hero is-fullheight has-bgimage">
        <div class="hero-head">
            <div class="container">
                <nav class="nav">
                    <div class="container">
                        <div class="nav-left">
                            <a class="nav-item" href="{{ asset('/') }}">
                                <img src="{{ asset('img/kaunlaran.png') }}" alt="Description">
                            </a>
                        </div>
                        <span class="nav-toggle">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <div class="nav-right nav-menu">
                            <a class="nav-item">
                                About
                            </a>
                            <a class="nav-item">
                                Tour
                            </a>
                            <a class="nav-item">
                                FAQ
                            </a>
                            <a class="nav-item">
                                Contact
                            </a>

                            @if (Auth::guest())
                                <span class="nav-item">
                                    <a href="{{ url('/login') }}" class="button is-borderless">
                                        <span class="icon">
                                            <i class="fa fa-user-circle-o"></i>
                                        </span>
                                    </a>
                                </span>

                                <span class="nav-item">
                                    <a href="{{ url('/register') }}" class="button is-default">
                                        ENROLL NOW
                                    </a>
                                </span>
                            @else
                                <a class="nav-item">
                                    Hi, {{ Auth::user()->name }} !
                                </a>
                                <span class="nav-item">
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="button is-default">
                                        SIGN OUT
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </span>
                            @endif


                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="hero-body">

                @yield('content')
        </div>

        <div class="hero-foot">
            <div class="container">
                <div class="tabs is-centered">
                    <ul>
                        <li><a class="text-white" href="http://bulma.io">Made with bulma</a></li>
                        <li><a class="text-white">Copyright 2016 Bulma</a></li>
                        <li><a class="text-white" href="http://unsplash.com">Images via unsplash</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <script async type="text/javascript" src="{{ asset('js/embed.js') }}"></script>
    <!-- Scripts -->
</body>
</html>
