<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') . '?' . time()}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/126bbe9047.js" crossorigin="anonymous"></script>
    <!-- The "defer" attribute is important to make sure Alpine waits for Livewire to load first. -->
    @livewireStyles

</head>
<body data-page="{{ $page ?? '' }}">
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
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item d-flex">
                            <a class="nav-link text-white me-3" href="#">{{ Auth::user()->name }}</a>
                            <div>
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                >
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            </li>
                        </li>
                    @endguest
                    <!-- Authentication Links -->
                </ul>
            </div>
        </div>
    </nav>
    
    @guest
        <div class="row">
            <main class="container-fluid">
                @yield('login')
            </main>
        </div>
    @endguest

    @auth    
        <nav id="aside-nav" class="nav-bg-dark">
            <x-buttons.nav
                icon="fas fa-calendar-alt"
                :url="route('home')" 
                :active="Route::currentRouteName() == 'home'"
            />
            <x-buttons.nav
                icon="fas fa-paw"
                :url="route('pets.index')"
                :active="Str::startsWith(Route::currentRouteName(), 'pets.')"
            />
            <x-buttons.nav
                icon="fas fa-users"
                :url="route('customers.index')"
                :active="Str::startsWith(Route::currentRouteName(), 'customers.')"
            />
            <x-buttons.nav
                icon="fas fa-coins"
                :url="route('accounting.index')"
                :active="Str::startsWith(Route::currentRouteName(), 'accounting.')"
            />
        </nav>

        <main class="container-fluid">
            @yield('content')
        </main>

        <nav id="mobile-nav" class="nav-bg-dark">
            <x-buttons.nav
                icon="fas fa-calendar-alt"
                :url="route('home')"
                :active="Route::currentRouteName() == 'home'"
            />
            <x-buttons.nav
                icon="fas fa-paw"
                :url="route('pets.index')"
                :active="Str::startsWith(Route::currentRouteName(), 'pets.')"
            />
            <x-buttons.nav
                icon="fas fa-users"
                :url="route('customers.index')"
                :active="Str::startsWith(Route::currentRouteName(), 'customers.')"
            />
        </nav>

        <div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3"></div>

        <!-- Modals -->
        <div class="modal modal__popup fade" id="modalConfirmation" tabindex="-1" aria-labelledby="modalConfirmationLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="modalConfirmationLabel">Confirmation</h2>
                        <button type="button" class="btn-close btn-icon btn-icon--base btn-icon--dark" data-bs-dismiss="modal" aria-label="Annuler"></button>
                    </div>
                    <div class="modal-body js-confirmation-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger js-confirmation-button" data-text="Supprimer"></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        @stack('scripts')
        @livewireScripts
    
        <script>
            window.groomer = window.groomer || {};
        </script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        {{-- Toasts --}}
        @if (session('message_success'))
            <script>window.groomer.showMessage(@json(session('message_success')))</script>
        @endif
        @if (session('message_danger'))
            <script>window.groomer.showMessage(@json(session('message_danger')), 'danger')</script>
        @endif
    @endauth
    

</body>
</html>