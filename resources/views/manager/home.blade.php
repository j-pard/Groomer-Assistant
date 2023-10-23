@extends('manager.layouts.new_app')

@section('content')
    <h2 class="text-center">Bonjour <strong class="text--copper">{{ Auth::user()->name }}</strong></h2>
@endsection
