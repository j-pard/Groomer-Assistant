<div>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off"
        x-data="{}"
    >
        <button type="submit" onclick="return false;" style="display:none;"></button>
        
        @include('livewire.accounting.partials.header')

        <div class="rounded-3" wire:loading.class="opacity-50">
            <fieldset>
                <table class="table table-dark table-hover bg--dark-700 px-2 mt-3">
                    <thead class="table--sticky-head">
                        <tr class="pe-3">
                            <th scope="col ps-3">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Chien</th>
                            <th scope="col">Client</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $appts = collect($appts)->sortBy('time');
                            $dateSeparator = null;
                        @endphp
                        @forelse ($appts as $key => $appt)
                            @php
                                $date = Carbon\Carbon::parse($appt['time']);
                            @endphp
                            @if ($dateSeparator != $date->format('d F'))
                                <tr class="h5">
                                    <td class="p-3 bg--dark-500" colspan="7">
                                        <span class="text--copper">
                                            {{ ucfirst($date->translatedFormat('l jS F')) }}
                                        </span>
                                    </td>
                                </tr>
                            @endif

                            <tr class="pe-3">
                                <th class="py-3 ps-3" scope="row">{{ $loop->iteration }}</th>
                                <td class="py-3">{{ $appt['formatted_date'] }}</td>
                                <td class="py-3">
                                    <a class="text-white" href="{{ route('dogs.show', ['dog' => $appt['dog_id']]) }}" target="_blank">
                                        {{ $appt['dog_name'] }}
                                    </a>
                                </td>
                                <td class="py-3">
                                    <span>{{ $appt['owner_name'] }}</span>
                                </td>
                                <td class="py-3 {{ $appt['status'] == 'cancelled' ? 'line-through' : ''}}">
                                    @if ($appt['status'] == 'cancelled')
                                        {!! isset($appt['price']) ? $appt['price'] . ' €' : '&mdash;' !!}
                                    @else
                                        {!! (!isset($appt['price']) || $appt['price'] == '') ? '<i class="fas fa-exclamation-triangle text-danger mt-1"></i>' : $appt['price'] . ' €' !!}
                                    @endif
                                </td>
                                <td>
                                    <x-forms.select
                                        class="mb-0"
                                        classContainer="mb-0"
                                        wire="appts.{{$key}}.status"
                                        :options="$statuses"
                                        wiremodifier="lazy"
                                        :disabled="in_array($appt['status'], $offStatus) && !array_key_exists($key, $apptsToUpdate)"
                                        x-on:change="
                                            $wire.apptUpdated({
                                                target: {{ $key }},
                                                status: this.event.target.value
                                            })
                                        "
                                    />
                                </td>
                                <td class="py-3 text-end">
                                    <span class="text-success {{ array_key_exists($key, $apptsToUpdate) ? '' : 'd-none' }}">
                                        <i class="fas fa-sync"></i>
                                    </span>

                                    @if ($appt['dog_status'] == 'private')
                                        <i class="fab fa-product-hunt text-secondary ms-2"></i>
                                    @endif

                                    <span role="button" class="mx-2 text-secondary" wire:key="{{ $key }}" wire:click="loadAppointment('{{ $key }}')">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </td>
                            </tr>

                            @php
                                $dateSeparator = Carbon\Carbon::parse($appt['time'])->format('d F');
                            @endphp
                        @empty
                            <tr></tr>
                        @endforelse
                    </tbody>
                </table>
            </fieldset>
        </div>
        
        <div class="form-actions-buttons">
            <x-buttons.save />
        </div>
    </form>

    @include('livewire.accounting.partials.modal')
</div>
