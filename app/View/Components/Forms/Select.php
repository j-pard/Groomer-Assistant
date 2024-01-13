<?php

namespace App\View\Components\Forms;

use App\View\Component as ViewComponent;

class Select extends ViewComponent
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
        public ?string $classContainer = null,
        public bool $required = false,
        public bool $readonly = false,
        public bool $disabled = false,
        public array $options = [],
        public bool $hasEmptyRow = false,
        public bool $lazy = false
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
        return view('components.forms.select');
    }
}
