@extends('manager.layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center mb-2">
        <h2><span class="text-pink">C</span>omptabilité</h2>
    </header>

    <livewire:accounting.form />
@endsection

@push('scripts')
    <script>
        // When the user scrolls the page, execute myFunction
        window.onscroll = function() {
            setSticky()
        };

        // Get the header
        let header = document.getElementById('sticky-header');

        // Get the offset position of the navbar
        let sticky = header.offsetTop;

        // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function setSticky() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>
@endpush
