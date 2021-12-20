<?php

namespace App\Http\Livewire\Pets;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Pet;
use Livewire\WithFileUploads;

class SheetsForm extends LivewireForm
{
    use WithFileUploads;

    public Pet $pet;

    public array $sheets = [];
    public $sheet;

    protected $listeners = ['refreshSheets' => '$refresh'];

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->sheets = $this->loadMedia();
    }
    
    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'sheet' => 'image|mimes:jpg,jpeg|max:7168', // 7mb
        ];
    }

    /**
     * Render the component
     *
     */
    public function render()
    {
        return view('livewire.pets.sheets');
    }

    /**
     * Save the model
     */
    public function save()
    {
        $this->validate();

        $this->pet
            ->addMedia($this->sheet)
            ->toMediaCollection('sheets');
            
        $this->emit('refreshSheets');
    }

    private function loadMedia()
    {
        $sheets = [];

        $mediaCollection = $this->pet->getMedia('sheets');
        foreach ($mediaCollection as $media) {
            $sheets[] = $media->getUrl();
        }

        return $sheets;
    }
}
