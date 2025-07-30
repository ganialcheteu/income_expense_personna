<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class activeUserCircle extends Component
{
    public $active;
    public $src;
    public $width;
    public $height;
    /**
     * Create a new component instance.
     */
    public function __construct($active, $src,
        $width, $height) {
        $this->active = $active;
        $this->src    = $src;
        $this->width  = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.active-user-circle');
    }
}
