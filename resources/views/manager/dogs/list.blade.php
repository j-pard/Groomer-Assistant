@extends('manager.layouts.new_app')

@section('content')
    <div class="d-flex flex-column py-4">
        @foreach ($dogs as $dog)
            <div class="list-element mx-2 my-1 py-2 px-1 px-sm-3">
                <div class="d-flex flex-row">
                    <div class="d-flex flex-row align-items-center">
                        <div class="avatar mx-2 mx-sm-4">{{ $dog->avatar }}</div>
                    </div>
                    <div class="d-flex flex-column">
                        <div>{{ $dog->name }}</div>
                        <em class="text--quartz">{{ $dog->owner_name }}</em>
                    </div>
                </div>
                <div class="d-flex flex-column text-end justify-content-between">
                    <div>{{ $dog->mainBreed->breed }}</div>
                    <div class="d-flex justify-content-end flex-no-wrap">
                        @if ($dog->second_breed_id !== null)
                            <span class="badge rounded-pill bg--quartz me-2">Croisé</span>
                        @endif
                        <span class="badge rounded-pill {{ 'bg-' . App\Enums\DogStatus::getColor($dog->status) }}">{{ App\Enums\DogStatus::getText($dog->status) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mb-5 pb-5 px-2">
        {{ $dogs->onEachSide(1)->links() }}
    </div>
@endsection
