<div class="form-group">
    <div class="mb-0">
        <label for="{{ $name }}">
            {{ $label }}
        </label>
        
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">€</span>
            </div>

            <input 
                class="form-control"
                type="number"
                name="{!! $name !!}"
                {!! $id ? 'id="' . $id . '"' : "" !!}
                wire:model="{{ $wire }}"
            >
        </div>

        @if (isset($help))
            <small class="text--quartz ps-2">{!! $help !!}</small>
        @endif
    </div>
</div>