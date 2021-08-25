<?php

namespace App\View\Components\Forms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $wire = null,
        public string $wireModifier = 'defer',
        public ?string $name = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public string $type = 'text',
        public ?string $class = null,
        public ?string $id = null,
        public bool $required = false,
        public bool $readonly = false,
        public bool $disabled = false,
        public ?string $value = null,
        public ?string $min = null,
        public ?string $max = null,
        public ?string $step = null,
        public array $options = []
    ) {
        if ($this->wire) {
            $this->name = $this->wire;
        }
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

    /**
     * Check if the specified value is selected.
     *
     * @param  string $key
     * @return bool
     */
    public function isSelected($key): bool
    {
        return array_key_exists($key, $this->options);
    }
}
