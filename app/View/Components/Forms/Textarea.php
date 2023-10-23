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
        public ?string $classContainer = null,
        public ?string $id = null,
        public bool $required = false,
        public bool $readonly = false,
        public bool $disabled = false,
        public ?string $value = null,
        public ?int $cols = null,
        public ?string $rows = null,
        public ?string $maxlength = null,
        public bool $lazy = false
    ) {
        $this->name = $this->name ?: $this->wire;
        $this->rows = $this->rows . 'rem' ?: '1rem';
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
