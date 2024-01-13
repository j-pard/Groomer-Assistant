<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class Delete extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $class = '',
        public string $text = 'Confirmer la suppression ?',
        public string $button = '',
        public string $method = '',
        public string $icon = 'fas fa-trash',
        public bool $dropdown = false
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.delete');
    }
}
