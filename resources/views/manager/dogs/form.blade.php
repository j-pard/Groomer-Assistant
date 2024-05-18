@extends('manager.layouts.app', ['secondNav' => 'dog'])

@section('content')
    <livewire:dogs.form :dog="$dog" />
@endsection
