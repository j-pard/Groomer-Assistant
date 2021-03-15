<?php

namespace App\View\Components\Forms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Select extends Component
{
    public ?string $name = '';
    public ?string $label = '';
    public ?string $class = '';
    public ?string $id = '';
    public bool $required;
    public bool $readonly;
    public bool $disabled;
    public array $options;
    public ?string $model = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $options,
        $model = null,
        $name = null,
        $label = null,
        $class = null,
        $id = null,
        $required = false,
        $readonly = false,
        $disabled = false
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->class = $class;
        $this->id = $id;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->disabled = $disabled;
        $this->model = $model;
        $this->options = $options;
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
