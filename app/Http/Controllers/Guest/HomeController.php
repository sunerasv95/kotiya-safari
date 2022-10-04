<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\Contracts\BlogServiceInterface;
use App\Services\Contracts\NotificationServiceInterface;


class HomeController extends Controller
{
    private $blogService;
    private $notificationService;

    public function __construct(
        NotificationServiceInterface $notificationService,
        BlogServiceInterface $blogService
    )
    {
        $this->notificationService = $notificationService;
        $this->blogService = $blogService;
    }

    public function homePage()
    {
        return view('home');
    }

    public function galleryPage()
    {
        return view('gallery');
    }

    public function packagesPage()
    {
        return view('packages-rates');
    }

    public function contactUsPage()
    {
        return view('contact');
    }

    public function blogsPage()
    {
        $posts = [];

        $posts = $this->blogService->getAllPosts();
        //dd($posts);
        return view('blog.index', compact('posts'));

    }

    public function showPost(string $postSlug)
    {
        // $post = null;

        // $post = $this->blogService->getPostBySlug($postSlug);
        //dd($post);
        // return view('blog.show', compact('post'));
        return view('blog.show');
    }
}
