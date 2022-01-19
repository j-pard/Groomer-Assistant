<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class Form extends Component
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function updated($propertyName)
    {
        // Validate the specified property
        $this->validateOnly($propertyName);
    }

    protected function showMessage(string $message = 'Données sauvegardées', string $style = 'success')
    {
        $this->dispatchBrowserEvent('show-toast', [
            'message' => $message,
            'style' => $style,
        ]);
    }
}
