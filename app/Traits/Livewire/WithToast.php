<?php

namespace App\Traits\Livewire;

trait WithToast
{
    /**
     * Dispatch event to display success toast.
     *
     * @return void
     */
    protected function showSuccessMessage()
    {
        $this->dispatch('show-toast', [
            'message' => 'Données sauvegardées',
            'style' => 'success',
        ]);
    }

    /**
     * Dispatch event to display error toast.
     *
     * @return void
     */
    protected function showErrorMessage()
    {
        $this->dispatch('show-toast', [
            'message' => "Tout ne s'est pas passé comme prévu =(",
            'style' => 'danger',
        ]);
    }

    /**
     * Dispatch event to display custom toast.
     *
     * @param string $message
     * @param string $style
     * @return void
     */
    protected function showMessage(string $message, string $style)
    {
        $this->dispatch('show-toast', [
            'message' => $message,
            'style' => $style,
        ]);
    }

}
