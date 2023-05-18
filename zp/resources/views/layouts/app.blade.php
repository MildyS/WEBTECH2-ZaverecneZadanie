<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('translation.fl')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{--    @push('styles')--}}
    {{--        <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">--}}
    {{--    @endpush--}}


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md shadow-sm navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand"  href="{{ url('/') }}">
                <h2>@lang('translation.fl')</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manual') }}">@lang('translation.manual')</a>
                    </li>


                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item my-element">
                                <a class="nav-link" href="{{ route('login') }}">@lang('translation.login') <i class="bi bi-box-arrow-in-right"></i></a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item my-element">
                                <a class="nav-link" href="{{ route('register') }}">@lang('translation.register')<i class="bi bi-file-person-fill"></i> </a>
                            </li>
                        @endif
                    @else

                        @if(Auth::user()->hasRole('Teacher'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('teacher.addFiles') }}">@lang('translation.addFiles')</a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
    <footer class="navbar navbar-expand-md shadow-sm navbar-dark bg-dark">
        <div class="container">
            <div class="col mb-3">
                <h4 class="y">@2023</h4>
            </div>
            <div class="col mb-6 names">
                <span>@lang('translation.autors')</span>
                <span class="n">Miloš Ilovský,</span>
                <span class="n">Katarína Poláčiková,</span>
                <span class="n">Eunika Farkašová,</span>
                <span class="n">Peter Plavy</span>
            </div>
        </div>

    </footer>
</div>
@stack('scripts')
<script>
    function setMainMinHeight() {
        var height = document.documentElement.clientHeight - document.querySelector("nav").clientHeight - document.querySelector("footer").clientHeight
        document.querySelector("main").style.minHeight = height + 'px'
        console.log(height)
    }

    setMainMinHeight()
    window.addEventListener('resize', setMainMinHeight);

</script>
<style>
    #app {
        background-color: #202124;
    }

    .navbar{
        color: #e5e7eb;
        font-weight: bolder;
        font-size: larger;
    }

    .navbar-brand,
    .y,
    .n{
        font-weight: bolder;
        color: #da3c8b
    }

    h2{
        font-weight: bolder;
    }

    .nav-item :hover{
        color: #da3c8b;
        text-shadow: 0 0 1px #da3c8b;
    }

    .names{
        text-align: right;
    }
</style>
</body>
</html>





