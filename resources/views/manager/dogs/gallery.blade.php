@extends('manager.layouts.app', ['secondNav' => 'dog'])

@section('content')
    <livewire:dogs.gallery :dog="$dog" lazy />
@endsection
