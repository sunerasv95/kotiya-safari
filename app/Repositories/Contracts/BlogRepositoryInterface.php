<?php

namespace App\Repositories\Contracts;

interface BlogRepositoryInterface
{
    public function findAllPosts();

    public function findAllFeaturedPosts();

    public function findPostBySlug(string $slug);

    public function savePost(array $newPost);
}
