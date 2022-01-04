<?php

namespace App\Http\Livewire\Pets;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Pet;
use Livewire\WithFileUploads;

class GalleryForm extends LivewireForm
{
    use WithFileUploads;

    public Pet $pet;

    public $medias;
    public $media;

    protected $listeners = ['refreshGallery' => '$refresh'];

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        //
    }
    
    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'media' => 'image|mimes:jpg,jpeg|max:7168', // 7mb
        ];
    }

    /**
     * Render the component
     *
     */
    public function render()
    {
        return view('livewire.pets.gallery');
    }

    /**
     * Save the model
     */
    public function save()
    {
        $this->validate();

        $this->emit('refreshGallery');
    }
}
