<?php

namespace App\Services;

use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Services\Contracts\BlogServiceInterface;

class BlogService implements BlogServiceInterface
{
    private $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function getAllPosts()
    {
        try {
            return $this->blogRepository->findAllPosts()->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getLatestFeaturedPost()
    {
        try {
            $featuredPost = null;
            $allFaturedPosts = $this->blogRepository->findAllFeaturedPosts()->toArray();
            if(!empty($allFaturedPosts)){
                $featuredPost = head($allFaturedPosts);
            }
            return $featuredPost;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getPostBySlug(string $slug)
    {
        try {
            return $this->blogRepository
                ->findPostBySlug($slug)
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function createPost(array $newPost)
    {
        try {
            $savedInquiry = $this->blogRepository->savePost($newPost);
            return $savedInquiry;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
