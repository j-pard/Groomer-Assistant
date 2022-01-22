<div>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off">
        <button type="submit" onclick="return false;" style="display:none;"></button>
        
        @include('livewire.accounting.partials.header')

        <fieldset>
            BODY
        </fieldset>
        
        <div class="form-actions-buttons">
            <x-buttons.save />
        </div>
    </form>
</div>