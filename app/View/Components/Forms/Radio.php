<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Radio extends Component
{
    public string $name;
    public string $value;
    public string $label;
    public bool $inline;
    public bool $selected;
    public bool $isIcon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = '', $value = '', $label = '', $inline = false, $selected = false, $isIcon = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->inline = $inline;
        $this->selected = $selected;
        $this->isIcon = $isIcon;
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
