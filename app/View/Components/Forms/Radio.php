<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Radio extends Component
{
    public string $name;
    public string $value;
    public bool $inline;
    public bool $selected;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = '', $value = '', $inline = false, $selected = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->inline = $inline;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.radio');
    }
}
