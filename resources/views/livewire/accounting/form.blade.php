<div>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off">
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
                        <th scope="col"><p class="text-end m-0 p-0">Actions</p></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appointments as $_appointment)
                        <tr wire:ignore class="{!! ((!isset($_appointment->price) || $_appointment->price == '') && $_appointment->status != 'cancelled') ? 'table-danger' : '' !!} {{ in_array($_appointment->status, $offStatus) ? 'table-secondary disabled' : '' }}">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $_appointment->formatted_date }}</td>
                            <td>{{ $_appointment->pet_name }}</td>
                            <td>{{ $_appointment->customer_lastname }}</td>
                            <td class="{{ $_appointment->status == 'cancelled' ? 'line-through' : ''}}">
                                @if ($_appointment->status == 'cancelled')
                                    {{ isset($_appointment->price) ? $_appointment->price . ' €' : '' }}
                                @else
                                    {!! (!isset($_appointment->price) || $_appointment->price == '') ? '<i class="fas fa-exclamation-triangle text-danger mt-1"></i>' : $_appointment->price . ' €' !!}
                                @endif
                            </td>
                            <td>{{ $availableStatus[$_appointment->status] }}</td>
                            <td class="text-end">
                                <span class="mx-2" wire:key="{{ $_appointment->id }}" wire:click="loadAppointment('{{ $_appointment->id }}')">
                                    <i class="fas fa-eye"></i>
                                </span>
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

    @include('livewire.accounting.partials.modal')
</div>