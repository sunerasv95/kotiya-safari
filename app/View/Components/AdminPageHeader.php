<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminPageHeader extends Component
{
    public $pageTitle;
    public $hasButton;
    public $buttonUrl;
    public $buttonIcon;

    public function __construct(
        // $pageTitle,
        // $hasButton = false,
        // $buttonUrl = "",
        // $buttonIcon = ""
    )
    {
        // $this->pageTitle    = $pageTitle;
        // $this->hasButton    = $hasButton;
        // $this->buttonUrl    = $buttonUrl;
        // $this->buttonIcon   = $buttonIcon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-page-header');
    }
}
