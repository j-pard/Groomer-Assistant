<div>
    <div class="d-flex flex-column pt-3 pb-1 mb-1" wire:loading.class="opacity-50">
        @php
            // Define years to display separation wetween years
            $currentYear = 0;
            $previousYear = 0;
        @endphp

        @foreach ($items as $item)
            @php
                $currentYear = Carbon\Carbon::parse($item->time)->format('Y');
            @endphp

            @if ($loop->first || ($currentYear !== $previousYear))
                <div class="text--quartz p-1 ms-2 mb-1 h5 {{ !$loop->first ? 'mt-4' : '' }}">{{ $currentYear }}</div>
            @endif

            <div class="list-element mx-2 my-1 py-2 px-1 px-sm-3" data-id="{{ $item->id }}">
                <div class="d-flex flex-row col-md-5">
                    <div class="d-flex flex-row align-items-center">
                        <div class="avatar mx-2 mx-sm-4">
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        {{ $item->time !== null ? Carbon\Carbon::parse($item->time)->translatedFormat('d F h:i') : '-' }}
                        <span class="text--quartz">Rendez-vous</span>
                    </div>
                </div>

                <div class="cell-desktop col-md-3">
                    <div class="d-flex">
                        <p class="text--quartz mb-0">{{ $item->shortNote }}</p>
                    </div>
                </div>

                <div class="d-flex flex-column text-end justify-content-between col-md-4">
                    <div class="d-flex justify-content-end flex-no-wrap">
                        <span class="badge rounded-pill {{ 'bg-' . App\Enums\AppointmentStatus::getColor($item->status) }}">{{ App\Enums\AppointmentStatus::getText($item->status) }}</span>
                    </div>
                    <div>{{ $item->price ?? '' }}</div>
                </div>
            </div>

            @php
                $previousYear = $currentYear;
            @endphp
        @endforeach
    </div>
</div>