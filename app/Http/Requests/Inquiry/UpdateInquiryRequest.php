<?php

namespace App\Http\Requests\Inquiry;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInquiryRequest extends FormRequest
{
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
        return [
            "updNoAdults"       => "required|integer",
            "updNoKids"         => "required|integer",
            "updRemark"         => "nullable|string",
            "updInquiryId"      => "required"
        ];
    }
}
