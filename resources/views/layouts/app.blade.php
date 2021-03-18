<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/126bbe9047.js" crossorigin="anonymous"></script>
    @livewireStyles

    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>

</head>
<body>
    <div id="app">
        <nav id="topBar" class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid px-md-5">
                <h1>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="text-pink">G</span>roomer <span class="text-pink">A</span>ssistant
                    </a>
                </h1>

                <div class="d-flex justify-content-end">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    <i class="fas fa-user"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        @auth    
            <nav id="aside-nav">
                <x-buttons.nav
                    icon="fas fa-calendar-alt"
                    :url="route('home')" 
                    section="calendar"
                />
                <x-buttons.nav
                    icon="fas fa-paw"
                    :url="route('pets')"
                    section="pets"
                />
                <x-buttons.nav
                    icon="fas fa-users"
                    :url="route('customers')"
                    section="customers"
                />
                <x-buttons.nav
                    :icon="'fas fa-cog'"
                    :url="route('settings')"
                    section="settings"
                />
            </nav>
        @endauth
        <div class="row">
            <main class="container-fluid">
                @yield('content')
            </main>
        </div>

        @stack('scripts')
        @livewireScripts
    </div>
</body>
</html>