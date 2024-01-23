@extends('manager.layouts.new_app')

@section('content')
    <div class="d-flex flex-column align-items-center my-3 px-5">
        <h2 class="my-3">Bonjour <strong class="text--copper">{{ $user->name }}</strong></h2>

        <p class="mt-4">
            Aujourd'hui, tu as <strong class="text--copper">{{ $todayCount }}</strong> rendez-vous sur ta journée.
        </p>

        @if($reminders->count() > 0)
            <p>
                Penses à envoyer tes messages de rappel pour {{ $isWeekend ? 'lundi' : 'demain' }}
                <ul>
                    @foreach ($reminders as $reminder)
                        <li>
                            {{ $reminder->name }}, {{ $reminder->owner_name }} - <strong>{{ $reminder->phone }}</strong>
                        </li>
                    @endforeach
                </ul>
            </p>
        @endif

        <p class="mt-3">
            Il ne tient qu'à toi de faire de cette journée une <strong class="text--copper">belle journée</strong>.
        </p>
@endsection
