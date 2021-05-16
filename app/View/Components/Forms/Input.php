<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public ?string $name = '';
    public ?string $label = '';
    public ?string $placeholder = '';
    public ?string $type = '';
    public ?string $class = '';
    public ?string $id = '';
    public bool $required;
    public bool $readonly;
    public bool $disabled;
    public ?string $value;
    public ?string $min  = '';
    public ?string $max  = '';
    public ?string $step  = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name = null,
        $label = null,
        $placeholder = null,
        $type = 'text',
        $class = null,
        $id = null,
        $required = false,
        $readonly = false,
        $disabled = false,
        $value = null,
        $min = null,
        $max = null,
        $step = null
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->class = $class;
        $this->id = $id;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->disabled = $disabled;
        $this->value = $value;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
