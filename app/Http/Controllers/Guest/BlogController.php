<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\Contracts\BlogServiceInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $blogService;

    public function __construct(BlogServiceInterface $blogService)
    {
        $this->blogService = $blogService;
    }

    public function fetchAllPosts()
    {
        $posts = [];
        $featuredPost = null;

        $featuredPost = $this->blogService->getLatestFeaturedPost();
        $posts = $this->blogService->getAllPosts();

        if(!isset($featuredPost)){
            $featuredPost = head($posts);
        }
        //dd($featuredPost, $posts);
        return view('blog.index', compact('featuredPost', 'posts'));

    }

    public function showPost(string $postSlug)
    {
        $post = null;

        $post = $this->blogService->getPostBySlug($postSlug);
        //dd($post);
        return view('blog.show', compact('post'));

    }
}
