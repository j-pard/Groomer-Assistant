<?php

namespace App\Http\Livewire\Pets;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Pet;
use Livewire\WithFileUploads;

class GalleryForm extends LivewireForm
{
    use WithFileUploads;

    public Pet $pet;

    public array $medias = [];
    public $media;

    protected $listeners = ['refreshGallery' => '$refresh'];

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->medias = $this->loadMedia();
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

        $this->pet
            ->addMedia($this->media)
            ->toMediaCollection();
            
        $this->emit('refreshGallery');
    }

    private function loadMedia()
    {
        $medias = [];

        $mediaCollection = $this->pet->getMedia();
        foreach ($mediaCollection as $media) {
            $medias[] = $media->getUrl();
        }

        return $medias;
    }
}
