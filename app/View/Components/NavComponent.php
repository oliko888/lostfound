<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavComponent extends Component
{
    public $currentPage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.nav-component');
    }
}
