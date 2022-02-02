<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(90);
        $content = $this->faker->text(5000);
        $thumbnailText = Str::substr($content, 0, 100);

        return [
            "post_title" => $title,
            "post_slug" => Str::slug($title),
            "post_content" =>  $content,
            "thumbnail_text" => $thumbnailText,
            "thumbnail_url" => "https://via.placeholder.com/600/92c952",
            "admin_id" => 1,
            "is_published" => 1,
            "is_deleted" => 0,
            "published_at" => now(),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
