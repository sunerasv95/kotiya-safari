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

    public function savePost(array $newBlogPost)
    {
        $blogPost = new RepoModel();

        $blogPost->post_title        = $newBlogPost['title'];
        $blogPost->post_slug         = Str::slug($newBlogPost['title']);
        $blogPost->post_content      = $newBlogPost['content'];
        $blogPost->thumbnail_url     = $newBlogPost['coverImgUrl'];
        $blogPost->thumbnail_text    = Str::substr($newBlogPost['content'], 1, 100);
        $blogPost->admin_id          = 1;//Auth::user()->id;
        $blogPost->is_published      = $newBlogPost['hasPublished'];
        $blogPost->is_deleted        = 0;
        $blogPost->published_at      = now();
        $blogPost->deleted_at        = null;
        $blogPost->created_at        = now();
        $blogPost->updated_at        = now();

        return $blogPost->save();

    }

}
