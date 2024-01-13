<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Toggle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $wire = null,
        public ?string $name = null,
        public ?string $label = null,
        public bool $inline = false,
        public bool $checked = false,
        public ?string $icon = null,
        public string $iconClass = 'h4'
    ) {
        $this->name = $this->name ?: $this->wire;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.toggle');
    }
}
