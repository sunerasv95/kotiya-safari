<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogPostRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        return [
            "title" => htmlspecialchars($this->title),
            "content" => htmlspecialchars($this->content),
            "coverImgUrl" => htmlspecialchars($this->coverImgUrl),
            "hasPublished" => htmlspecialchars($this->hasPublished)
        ];
    }

    public function attributes()
    {
        return [
            "title" => "Title",
            "content" => "Post content",
            "coverImgUrl" => "Cover Image",
            "hasPublished" => "Published Status"
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this->all());
        return [
            "title"         => "required|unique:blog_posts,post_title",
            "content"       => "required",
            "coverImgUrl"   => "required",
            "hasPublished"  => "required"
        ];
    }
}
