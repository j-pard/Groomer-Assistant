@extends('manager.layouts.app', ['page' => 'settings'])

@section('content')
    <header>
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-global-tab" data-bs-toggle="pill" data-bs-target="#pills-global" type="button" role="tab" aria-controls="pills-global" aria-selected="true">Options générales</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-breeds-tab" data-bs-toggle="pill" data-bs-target="#pills-breeds" type="button" role="tab" aria-controls="pills-breeds" aria-selected="false">Races</button>
            </li>
        </ul>
    </header>

    <div class="tab-content p-3" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-global" role="tabpanel" aria-labelledby="pills-global-tab">
            ...
        </div>

        <div class="tab-pane fade" id="pills-breeds" role="tabpanel" aria-labelledby="pills-breeds-tab">
            <div>
                <form id="breedForm" action="{{ route('settings.breed.update') }}" method="POST">
                    @csrf
                    <livewire:tables.breeds-table />
                </form>
            </div>
        </div>
    </div>
@endsection
