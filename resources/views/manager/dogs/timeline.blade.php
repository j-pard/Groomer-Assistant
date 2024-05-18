@extends('manager.layouts.app', ['secondNav' => 'dog'])

@section('content')
    <livewire:dogs.timeline :dog="$dog" lazy />
@endsection
