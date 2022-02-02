<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostImagesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_images', function (Blueprint $table) {
            $table->id();
            $table->string('img_name', 150);
            $table->string('img_url')->nullable();
            $table->integer('blog_post_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post_images');
    }
}
