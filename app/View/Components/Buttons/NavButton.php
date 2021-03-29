<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class Nav extends Component
{
    public string $class;
    public string $url;
    public string $icon;
    public string $section;
    public bool $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = '', $url = '', $icon = '', $section = '', $active = false)
    {
        $this->class = $class;
        $this->url = $url;
        $this->icon = $icon;
        $this->section = $section;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.buttons.nav');
    }
}
