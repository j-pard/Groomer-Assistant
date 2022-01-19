<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class Save extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.buttons.save');
    }
}
