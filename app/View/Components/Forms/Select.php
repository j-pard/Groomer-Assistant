<?php

namespace App\View\Components\Forms;

use App\View\Component as ViewComponent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class Select extends ViewComponent
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
        public ?string $class = null,
        public ?string $classContainer = null,
        public bool $required = false,
        public bool $readonly = false,
        public bool $disabled = false,
        public array $options = [],
        public bool $hasEmptyRow = false,
    ) {
        $this->name = $this->wire;
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
        return in_array($key, Arr::wrap($this->value));
    }
}
