<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title', 100);
            $table->string('post_slug', 100);
            $table->text('post_content');
            $table->string('thumbnail_url', 200)->nullable(true);
            $table->string('thumbnail_text', 150);
            $table->integer('admin_id')->unsigned();
            $table->tinyInteger('is_published')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**,
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
