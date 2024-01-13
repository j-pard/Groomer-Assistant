<?php

namespace App\Http\Livewire\Pets;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Pet;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryForm extends LivewireForm
{
    use WithFileUploads;

    public Pet $pet;

    public $medias;
    public array $urls = [];
    public $uploadedFiles = [];

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
            'uploadedFiles.*' => 'image|mimes:jpg,jpeg|max:12288', // 12mb
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

        foreach ($this->uploadedFiles as $media) {
            $this->pet->addMedia($media)->toMediaCollection('gallery');
        }
        $this->medias = $this->getMediaUrls();

        $this->emit('refreshGallery');
    }

    private function getMediaUrls()
    {
        $medias = $this->pet->getMedia('gallery');
        $urls = [];
        foreach ($medias as $media) {
            $urls[$media->file_name] = $media->getUrl();
        }
        return $urls;
    }

    public function refreshGallery()
    {
        return redirect()->route('pets.gallery', ['pet' => $this->pet]);
    }

    public function deleteMedia($fileName)
    {
        Media::where([
            'model_id' => $this->pet->id,
            'file_name' => $fileName,
        ])->delete();

        $this->emit('refreshGallery');
    }
}
