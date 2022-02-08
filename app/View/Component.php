<?php

namespace App\View;

use Illuminate\Support\Str;
use Illuminate\View\Component as BaseComponent;

abstract class Component extends BaseComponent
{
    /**
     * ID for this component.
     *
     * @var string
     */
    protected $id;

    /**
     * Generates an ID, once, for this component.
     *
     * @return string
     */
    public function id(): string
    {
        if ($this->id) {
            return $this->id;
        }

        if ($this->name) {
            return $this->id = $this->generateIdByName();
        }

        return $this->id = Str::random(6);
    }

    /**
     * Generates an ID by the name attribute.
     *
     * @return string
     */
    protected function generateIdByName(): string
    {
        return 'auto_id_' . $this->name;
    }
}
