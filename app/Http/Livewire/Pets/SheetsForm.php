<?php

namespace App\Http\Livewire\Pets;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Breed;
use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class SheetsForm extends LivewireForm
{
    use WithFileUploads;

    public Pet $pet;

    public $sheets;
    public $sheet;

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
     * Mount the component
     *
     */
    public function mount()
    {
        //
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
dd($this->sheet);
        $this->sheet->save();

        $this->showMessage();
    }
}
