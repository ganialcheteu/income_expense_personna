<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class onlySuperAdmin extends Component
{
    public $role;
    /**
     * Create a new component instance.
     */
    public function __construct($role)
    {
        $this ->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.only-super-admin');
    }
}
