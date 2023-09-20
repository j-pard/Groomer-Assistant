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
<body data-page="{{ $page ?? '' }}" @guest class="bg-guest" @endguest>
    @guest
        @yield('login')
    @endguest
    
    @auth
        <div id="app">
            <header class="d-flex justify-content-between align-items-center text--light-200 py-3">
                <div>
                    <h1 class="m-2"><strong class="text--copper">G</strong>roomer <strong class="text--copper">A</strong>ssistant</h1>
                </div>
                <div class="dropdown">
                    <div class="dropdown-toggle--no-arrow d-flex align-items-center me-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-circle-user text--light-200 h1 m-0"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Se déconnecter
                            </a>
                        </li>
                    </ul>
                </div>
            </header>

            <nav id="bottom-nav" class="d-flex justify-content-between align-items-center px-3 py-1">
                <div class="my-2 mx-3 h3">
                    <a href="" class="nav-item" {{ Route::currentRouteName() === 'home' ? 'active' : '' }}>
                        <i class="fa-solid fa-house p-1"></i>
                    </a>
                </div>
                <div class="text--dark-700 my-2 mx-3 h3">
                    <a href="" class="nav-item" {{ Str::startsWith(Route::currentRouteName(), 'appointments.')? 'active' : '' }}>
                        <i class="fa-solid fa-calendar-days p-1"></i>
                    </a>
                </div>
                <div class="text--dark-700 my-2 mx-3 h3">
                    <a href="{{ route('dogs.index') }}" class="nav-item" {{ Str::startsWith(Route::currentRouteName(), 'dogs.')? 'active' : '' }}>
                        <i class="fa-solid fa-paw p-1"></i>
                    </a>
                </div>
                <div class="my-2 mx-3 h3">
                    <a href="" class="nav-item" {{ Str::startsWith(Route::currentRouteName(), 'accounting.') ? 'active' : '' }}>
                        <i class="fa-solid fa-coins p-1"></i>
                    </a>
                </div>
            </nav>

            <main>
                @yield('content')
            </main>
            
        </div>

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

        {{-- Logout --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        {{-- Scripts --}}
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