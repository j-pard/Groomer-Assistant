<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textarea extends Component
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
        public ?string $placeholder = null,
        public ?string $class = null,
        public ?string $id = null,
        public bool $required = false,
        public bool $readonly = false,
        public bool $disabled = false,
        public ?string $value = null,
        public ?int $cols = null,
        public ?int $rows = null,
        public ?string $maxlength = null,
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
        return view('components.forms.textarea');
    }
}
