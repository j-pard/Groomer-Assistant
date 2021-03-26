<?php

namespace App\View\Components\Forms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class InputImage extends Component
{
    public ?string $name = '';
    public ?string $label = '';
    public ?string $id = '';
    public Model $model;
    public ?string $collection = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name = null,
        $label = null,
        $model = null,
        $id = null,
        $collection = null
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->id = $id;
        $this->model = $model;
        $this->collection = isset($collection) ? $collection : $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.input-image');
    }
}
