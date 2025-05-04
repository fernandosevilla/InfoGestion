<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toast extends Component
{
    public string $name;
    public string $icon;
    public string $message;

    /**
     * @param  string  $name     // ej. 'success', 'danger', 'warning'
     * @param  string  $icon     // SVG en crudo o nombre de icono
     * @param  string  $message  // texto a mostrar
     */
    public function __construct(string $name = 'success', string $icon = '', string $message = '')
    {
        $this->name    = $name;
        $this->icon    = $icon;
        $this->message = $message;
    }

    public function render()
    {
        return view('components.toast');
    }
}
