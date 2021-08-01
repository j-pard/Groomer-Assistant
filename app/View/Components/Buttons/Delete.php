<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class Delete extends Component
{
    public string $id;
    public string $text;
    public $wire;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $id,
        string $text = 'Supprimer',
        $wire = null
    )
    {
        $this->id = 'dropBtn' . $id;
        $this->text = $text;
        $this->wire = $wire;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.delete');
    }
}
