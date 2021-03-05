<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class NavButton extends Component
{
    public string $class;
    public string $url;
    public string $icon;
    public string $section;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = '', $url = '', $icon = '', $section = '')
    {
        $this->class = $class;
        $this->url = $url;
        $this->icon = $icon;
        $this->section = $section;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.buttons.nav-button');
    }
}
