<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class row extends Component
{
    public string $class;
    public string $url;
    public string $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = '', $url = '#', $icon = '')
    {
        $this->class = $class;
        $this->url = $url;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.buttons.row');
    }
}
