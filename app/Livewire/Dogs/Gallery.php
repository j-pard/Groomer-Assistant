<?php

namespace App\Livewire\Dogs;

use App\Models\Dog;
use App\Traits\Livewire\WithModals;
use App\Traits\Livewire\WithToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallery extends Component
{
    use WithFileUploads;
    use WithModals;
    use WithToast;

    public Dog $dog;
    public Collection $medias;
    public array $uploadedFiles = [];

    /**
     * Call on component mount.
     *
     * @param Dog $dog
     * @return void
     */
    public function mount(Dog $dog) 
    {
        $this->dog = $dog;
        $this->loadMedias();
    }

    /**
     * Render the table.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.dogs.gallery');
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
     * Display skeleton during component loading.
     *
     * @param array $params
     * @return View
     */
    public function placeholder(array $params = []): View
    {
        $params['rows'] = 10;
        $params['search'] = false;
        $params['pagination'] = false;

        return view('livewire.placeholders.table-skeleton', $params);
    }

    /**
     * Upload media and attach them to current dog.
     *
     * @return void
     */
    public function addMedia()
    {
        $this->validate();

        foreach ($this->uploadedFiles as $media) {
            $this->dog->addMedia($media)->toMediaCollection('gallery');
        }
        
        $this->showSuccessMessage();
        $this->resetMedia();
        $this->loadMedias();
        $this->render();
        $this->hideModal('cameraModal');
    }

    /**
     * Delete specified media.
     *
     * @param integer $mediaId
     * @return void
     */
    public function deleteMedia(int $mediaId)
    {
        Media::findOrFail($mediaId)->delete();

        $this->showSuccessMessage();
        $this->loadMedias();
    }

    /**
     * Reset uploaded files.
     *
     * @return void
     */
    public function resetMedia()
    {
        $this->uploadedFiles = [];
    }

    /**
     * Open camera modal.
     *
     * @return void
     */
    public function loadCameraModal()
    {
        $this->resetMedia();
        $this->showModal('cameraModal');
    }

    /**
     * Load media for active dog.
     *
     * @return void
     */
    private function loadMedias()
    {
        $this->medias = $this->dog->getMedia('gallery');
    }
}
