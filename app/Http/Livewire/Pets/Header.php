<?php

namespace App\Http\Livewire\Pets;

use App\Models\Pet;
use Livewire\Component;

class Header extends Component
{
    public Pet $pet;

    public string $backUrl;
    public array $navigation;
    public array $menu;

    /**
     * Mount component
     */
    public function mount(string $backUrl)
    {
        $this->backUrl = $backUrl;
        $this->navigation = $this->getNavigation();
    }

    public function rules()
    {
        return [
            'date' => 'string',
            'time' => 'string',
            'appointment.notes' => 'string|nullable',
        ];
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.pets.header');
    }

    /**
     * Delete the model
     *
     */
    public function deletePet()
    {
        $this->pet->delete();

        return redirect()->route('pets.index');
    }
    
    /**
     * Return array of navigation links
     *
     * @return array
     */
    private function getNavigation() :array
    {
        $nav = [];

        if ($this->pet->exists) {
            $nav = [
                'Détails' => route('pets.edit', ['pet' => $this->pet]),
                'Rendez-vous'=> route('pets.appointments', ['pet' => $this->pet]),
                'Gallerie'=> route('pets.gallery', ['pet' => $this->pet]),
            ];
        }

        return $nav;
    }
}
