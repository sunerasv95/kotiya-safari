<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HeroWithImage extends Component
{
    public $imgUrl;
    public $title;
    public $description;
    public $col;

    public function __construct(
       $imgUrl,
       $title,
       $description,
       $col="reserve"
    )
    {
        $this->imgUrl = $imgUrl;
        $this->title = $title;
        $this->description = $description;
        $this->col = $col;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.hero-with-image');
    }
}
