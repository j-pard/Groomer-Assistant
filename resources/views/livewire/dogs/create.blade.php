<div class="p-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5 mb-5">

            <div class="{{ $activeStep !== 'dog' ? 'd-none' : '' }}">
                @include('livewire.dogs.steps.dog_step')
            </div>

            <div class="{{ $activeStep !== 'owner' ? 'd-none' : '' }}">
                @include('livewire.dogs.steps.owner_step')
            </div>

            <div class="{{ $activeStep !== 'creation' ? 'd-none' : '' }}">
                @include('livewire.dogs.steps.creation_step')
            </div>
            
        </div>
    </div>
</div>
