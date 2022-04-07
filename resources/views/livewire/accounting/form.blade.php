<div>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off"
        x-data="{}"
    >
        <button type="submit" onclick="return false;" style="display:none;"></button>
        
        @include('livewire.accounting.partials.header')

        <fieldset>
            <table class="table table-hover px-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
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
                            <tr class="bg-gray h5">
                                <td class="px-3" colspan="7">{{ ucfirst($date->translatedFormat('l jS F')) }}</td>
                            </tr>
                        @endif

                        <tr>
                            <th class="py-3" scope="row">{{ $loop->iteration }}</th>
                            <td class="py-3">{{ $appt['formatted_date'] }}</td>
                            <td class="py-3">
                                <a class="text-dark" href="{{ route('pets.edit', ['pet' => $appt['pet_id']]) }}" target="_blank">
                                    {{ $appt['pet_name'] }}
                                </a>
                            </td>
                            <td class="py-3">
                                <a class="text-dark" href="{{ route('customers.edit', ['customer' => $appt['customer_id']]) }}" target="_blank">
                                    {{ $appt['customer_lastname'] }}
                                </a>
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
                                    :options="$availableStatus"
                                    wiremodifier="lazy"
                                    :disabled="in_array($appt['status'], $offStatus) && !array_key_exists($key, $apptsToUpdate)"
                                    x-on:change="
                                        $wire.emit('apptUpdated', {
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

                                @if ($appt['pet_status'] == 'private')
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
        
        <div class="form-actions-buttons">
            <x-buttons.save />
        </div>
    </form>

    @include('livewire.accounting.partials.modal')
</div>
