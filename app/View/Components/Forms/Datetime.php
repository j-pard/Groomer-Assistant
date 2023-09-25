<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Datetime extends Component
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
        public ?string $class = null,
        public ?string $id = null,
        public bool $required = false,
        public bool $readonly = false,
        public bool $disabled = false,
        public ?string $value = null,
        public ?string $min = null,
        public ?string $max = null
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
        return view('components.forms.datetime');
    }
}
