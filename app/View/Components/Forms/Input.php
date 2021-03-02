<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $type;
    public $class;
    public $id;
    public bool $required;
    public bool $readonly;
    public bool $disabled;
    public $value;
    public $min;
    public $max;

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
        $max = null
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
