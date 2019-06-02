<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>welcome to bokémon world</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('get_post_index') }}">
                        <img src="{{ asset('turtle.png') }}" height="40" width="40">
                        bokémon~
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <form action="{{ route('post_post_index') }}" method="get">
                        @csrf
                        <input type="text" name="keyword" class="search" placeholder="what do you like?" value="{{ app('request')->input('keyword') }}">
                        <input type="submit" class="btn btn-info" value="search!">
                    </form>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            @php  $user_id = Auth::user()->id ?? null @endphp

                            @if (!$user_id == false)
                                <a class="navbar-brand" href="{{ route('get_message_inbox') }}" title="you have {{ count(Auth::user()->messages->where('unread_flg',0)) }} unread messages">
                                    <span style="color:red">
                                        {{ count(Auth::user()->messages->where('unread_flg',0)) }}
                                    </span>
                                    <img src="{{ asset('vdzvdvdzfvxbtrd.jpg') }}" height="20" width="20">
                                </a>
                            @endif

                            <a class="navbar-brand" href="{{ route('get_post_add') }}" title="creat post">
                                <img src="{{ asset('SoftwareIcons-68-512.png') }}" height="20" width="20">
                            </a>
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="{{ asset(Auth::user()->image) }}" height="40" width="40">
                                        {{ Auth::user()->name }}
                                        <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('get_user_edit') }}">
                                        User Settings
                                    </a>

                                    <a class="dropdown-item" href="{{ route('get_post_order_by_user',['username' => Auth::user()->name]) }}">
                                        My posts
                                    </a>

                                    <a class="dropdown-item" href="{{ route('get_friend_index') }}">
                                        Friend requests
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <main class="py-4">
            @yield('second')
        </main>

        <main class="py-4">
            @yield('third')
        </main>
    </div>
</body>

</html>
