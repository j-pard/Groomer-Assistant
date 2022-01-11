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
    public array $urls = [];
    public $media;

    protected $listeners = ['refreshGallery'];

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->medias = $this->getMediaUrls();
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

        $this->pet->addMedia($this->media)->toMediaCollection('gallery');
        $this->medias = $this->getMediaUrls();

        $this->emit('refreshGallery');
    }

    private function getMediaUrls()
    {
        $medias = $this->pet->getMedia('gallery');
        $urls = [];
        foreach ($medias as $media) {
            $urls[] = $media->getUrl();
        }
        return $urls;
    }

    public function refreshGallery()
    {
        return redirect()->route('pets.gallery', ['pet' => $this->pet]);
    }
}
