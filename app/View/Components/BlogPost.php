<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class BlogPost extends Component
{
    public $postTitle;
    public $postContent;
    public $postThumbnail;
    public $postPublishedAt;
    public $postRoute;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $postTitle, 
        $postContent, 
        $postThumbnail, 
        $postPublishedAt,
        $postRoute
    )
    {
        $this->postTitle = $postTitle;
        $this->postContent = $postContent;
        $this->postThumbnail = $postThumbnail;
        $this->postPublishedAt = Carbon::createFromTimestamp(strtotime($postPublishedAt))->diffForHumans();
        $this->postRoute = $postRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blog-post');
    }
}
