<?php

namespace App\Traits\Livewire;

trait WithModals
{
    /**
     * Show modal with specified id.
     *
     * @param string $modalId
     * @return void
     */
    protected function showModal(string $modalId)
    {
        $this->dispatch('form-modal-loaded', modalId: $modalId);
    }

    /**
     * Hide modal with specified id.
     *
     * @param string $modalId
     * @return void
     */
    protected function hideModal(string $modalId)
    {
        $this->dispatch('form-modal-saved', modalId: $modalId);
    }
}
