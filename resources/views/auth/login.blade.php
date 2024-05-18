@extends('manager.layouts.app')

@section('login')
    <div id="login-container">
        <div class="row h-100">
            <div id="form-container" class="col-md-6 p-4">
                <div>
                    <div class="head">
                        <h1><span class="text--copper">G</span>roomer <span class="text--copper">A</span>ssistant</h1>
                        <h2 class="ms-1">Le meilleur moyen de prédire le futur c’est de le créer</h2>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-4">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="floatingEmail" placeholder="name@example.com" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <label for="floatingEmail">Adresse email</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required autocomplete="current-password">
                            <label for="floatingPassword">Mot de passe</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label text-light" for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>
                        </div>

                        <div class="my-5">
                            <button type="submit" class="text-white btn btn-primary--copper w-100 mx-2">
                                Se connecter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="logo-container" class="col-md-6 d-none d-md-block">
            </div>
        </div>
    </div>
@endsection
