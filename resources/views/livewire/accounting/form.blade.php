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
                    @forelse ($appointments as $appointment)
                        <tr class="{!! ((!isset($appointment->price) || $appointment->price == '') && $appointment->status != 'cancelled') ? 'table-danger' : '' !!} {{ in_array($appointment->status, $offStatus) ? 'table-secondary disabled' : '' }}">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $appointment->formatted_date }}</td>
                            <td>{{ $appointment->pet_name }}</td>
                            <td>{{ $appointment->customer_lastname }}</td>
                            <td class="{{ $appointment->status == 'cancelled' ? 'line-through' : ''}}">
                                @if ($appointment->status == 'cancelled')
                                    {{ isset($appointment->price) ? $appointment->price . ' €' : '' }}
                                @else
                                    {!! (!isset($appointment->price) || $appointment->price == '') ? '<i class="fas fa-exclamation-triangle text-danger mt-1"></i>' : $appointment->price . ' €' !!}
                                @endif
                            </td>
                            <td>{{ $availableStatus[$appointment->status] }}</td>
                            @if (in_array($appointment->status, $offStatus))
                                <td class="text-end"></td>
                            @else
                                <td class="text-end">+ + +</td>
                            @endif
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