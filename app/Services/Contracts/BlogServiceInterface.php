<?php

namespace App\Services\Contracts;

interface BlogServiceInterface
{
    public function getAllPosts();

    public function getLatestFeaturedPost();

    public function getPostBySlug(string $slug);

    public function createPost(array $newPost);
}
