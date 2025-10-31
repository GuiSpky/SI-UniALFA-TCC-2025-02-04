<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectField extends Component
{
    public $name;
    public $label;
    public $options;
    public $selected;
    public $required;

    /**
     * Cria um componente select reutilizável
     */
    public function __construct($name, $label, $options = [], $selected = null, $required = true)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->selected = $selected;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.select-field');
    }
}
