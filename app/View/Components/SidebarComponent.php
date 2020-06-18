<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarComponent extends Component
{
    /**
     * The current page.
     *
     * @var string
     */
    public $currentPage;

    /**
     * The categories.
     *
     * @var Collection
     */
    public $categories;

    /**
     * Create a new component instance.
     * 
     * @param  Collection $categories
     *
     * @return void
     */
    public function __construct($currentPage, $categories)
    {
        $this->currentPage = $currentPage;
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebar-component');
    }
}
