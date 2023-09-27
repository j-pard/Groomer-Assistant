<?php

namespace App\Traits\Livewire;

trait WithToast {

    /**
     * Dispatch event to display save success toast.
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
     * Dispatch event to display custom toast.
     *
     * @param string $message
     * @param string $style
     * @return void
     */
    protected function showMessage(string $message, string $style = 'success')
    {
        $this->dispatch('show-toast', [
            'message' => $message,
            'style' => $style,
        ]);
    }

}