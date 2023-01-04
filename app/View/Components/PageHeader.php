<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageHeader extends Component
{
    public $pageTitle;
    public $subTitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $pageTitle, 
        $subTitle
    )
    {
        $this->pageTitle = $pageTitle;
        $this->subTitle = $subTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page-header');
    }
}
