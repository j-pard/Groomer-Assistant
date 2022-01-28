<div>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off"
    x-data="{isShowing: true}"
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appts as $key => $appt)
                        <tr class="{!! ((!isset($appt['price']) || $appt['price'] == '') && $appt['status'] != 'cancelled') ? 'table-danger' : '' !!}">
                            <th class="py-3" scope="row">{{ $loop->iteration }}</th>
                            <td class="py-3">{{ $appt['formatted_date'] }}</td>
                            <td class="py-3">{{ $appt['pet_name'] }}</td>
                            <td class="py-3">{{ $appt['customer_lastname'] }}</td>
                            <td class="py-3 {{ $appt['status'] == 'cancelled' ? 'line-through' : ''}}">
                                @if ($appt['status'] == 'cancelled')
                                    {!! isset($appt['price']) ? $appt['price'] . ' €' : '&mdash;' !!}
                                @else
                                    {!! (!isset($appt['price']) || $appt['price'] == '') ? '<i class="fas fa-exclamation-triangle text-danger mt-1"></i>' : $appt['price'] . ' €' !!}
                                @endif
                            </td>
                            <td>
                                <div class="col-md-6">
                                    <x-forms.select
                                        class="mb-0"
                                        classContainer="mb-0"
                                        wire="appts.{{$key}}.status"
                                        :options="$availableStatus"
                                        wiremodifier="lazy"
                                        :disabled="in_array($appt['status'], $offStatus)"
                                        x-on:change="
                                            $wire.emit('apptUpdated', {
                                                target: {{ $key }},
                                                status: this.event.target.value
                                            })
                                        "
                                    />
                                </div>
                            </td>
                        </tr>
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
</div>