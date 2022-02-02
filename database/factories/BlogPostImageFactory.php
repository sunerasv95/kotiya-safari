<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            "https://via.placeholder.com/600/92c952",
            "https://via.placeholder.com/600/771796",
            "https://via.placeholder.com/600/24f355",
            "https://via.placeholder.com/600/d32776",
            "https://via.placeholder.com/600/f66b97",
            "https://via.placeholder.com/600/56a8c2",
            "https://via.placeholder.com/150/56acb2"
        ];

        return [
            "img_name" => strval(rand(1000000, 9999999)),
            "img_url" => array_rand($images, 1),
            "blog_post_id" => 1,
            "status" => 1,
            "is_deleted" => 0,
            "deleted_at" => null,
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
