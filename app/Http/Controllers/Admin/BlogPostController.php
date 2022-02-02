<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreateBlogPostRequest;
use App\Services\Contracts\BlogServiceInterface;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    private $blogService;

    public function __construct(BlogServiceInterface $blogService)
    {
        $this->blogService = $blogService;
    }

    public function findAll()
    {
        $posts = [];
        //$featuredPost = null;

        //$featuredPost = $this->blogService->getLatestFeaturedPost();
        $posts = $this->blogService->getAllPosts();

        // if(!isset($featuredPost)){
        //     $featuredPost = head($posts);
        // }
        //dd($featuredPost, $posts);
        return view('admin.blog-post.index', compact('posts'));

    }

    public function showPost(string $postSlug)
    {
        $post = null;

        $post = $this->blogService->getPostBySlug($postSlug);
        //dd($post);
        return view('blog.show', compact('post'));

    }

    public function createPost()
    {
        return view('admin.blog-post.create-post');
    }

    public function storePost(CreateBlogPostRequest $request)
    {
        $validatedData = $request->validated();

        $result = $this->blogService->createPost($validatedData);
        if($result){
            $successMsg = "Your post has been created successfully!";
            return redirect()->route('list-blog-posts')->with("successMsg", $successMsg);
        }
        return redirect()->back();
    }

}
