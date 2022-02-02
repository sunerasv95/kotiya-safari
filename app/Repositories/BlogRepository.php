<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\BlogPost as RepoModel;
use App\Repositories\Contracts\BlogRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BlogRepository implements BlogRepositoryInterface
{

    public function findAllPosts()
    {
        return RepoModel::orderBy('created_at', 'desc')->get();
    }

    public function findAllFeaturedPosts()
    {
        return RepoModel::where('is_featured', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findPostBySlug(string $slug)
    {
        return RepoModel::where('post_slug', $slug)->first();
    }

    public function savePost(array $blogPost)
    {
        $newBlogPost = new RepoModel();

        $newBlogPost->post_title        = $blogPost['title'];
        $newBlogPost->post_slug         = Str::slug($blogPost['title']);
        $newBlogPost->post_content      = $blogPost['content'];
        $newBlogPost->thumbnail_url     = $blogPost['coverImgUrl'];
        $newBlogPost->thumbnail_text    = Str::substr($blogPost['content'], 1, 100);
        $newBlogPost->admin_id          = 1;//Auth::user()->id;
        $newBlogPost->is_published      = $blogPost['hasPublished'];
        $newBlogPost->is_deleted        = 0;
        $newBlogPost->published_at      = now();
        $newBlogPost->deleted_at        = null;
        $newBlogPost->created_at         = now();
        $newBlogPost->updated_at        = now();

        return $newBlogPost->save();

    }

}
