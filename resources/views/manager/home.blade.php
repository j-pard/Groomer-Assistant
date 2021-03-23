@extends('layouts.app', ['page' => 'home'])

@section('content')
    <h4 class="mb-3">
        Bonjour <span class="text-pink">{{ Auth::user()->name }}</span>, voici tes rendez-vous de la journée.
    </h4>

    <div class="d-flex justify-content-start flex-wrap">
        <div class="custom-card-m card-more border shadow rounded" type="button" data-bs-toggle="modal" data-bs-target="#newRdvModal">
            <div class="more-btn">+</div>
        </div>

        <div class="custom-card-m border shadow rounded" data-toggle="modal" data-target="#petModal">
            <h5>Leya</h5>
            <div class="mid">
                <i class="fas fa-paw"></i>
            </div>
            <div class="tel"><i class="fas fa-phone-alt"></i>0497/29.09.35</div>
        </div>

        <div class="custom-card-m border shadow rounded" data-toggle="modal" data-target="#petModal">
            <h5>Cacahuète</h5>
            <div class="mid">
                <i class="fas fa-paw"></i>
            </div>
            <div class="tel"><i class="fas fa-phone-alt"></i>0471/39.23.01</div>
        </div>

        <div class="custom-card-m border shadow rounded" data-toggle="modal" data-target="#petModal">
            <h5>Kiwi</h5>
            <div class="mid">
                <i class="fas fa-paw"></i>
            </div>
            <div class="tel"><i class="fas fa-phone-alt"></i>0471/39.23.01</div>
        </div>
    </div>
@endsection

@include('manager.partials.modals')