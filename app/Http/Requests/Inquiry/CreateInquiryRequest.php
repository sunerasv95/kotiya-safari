<?php

namespace App\Http\Requests\Inquiry;

use Illuminate\Foundation\Http\FormRequest;

class CreateInquiryRequest extends FormRequest
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
            "customer_name"     => "required",
            "customer_email"    => "required",
            "date_from"         => "required",
            "date_to"           => "required",
            "board_plan"        => "required",
            "no_adults"         => "required",
            "no_kids"           => "required",
            "req_airport_pickup"=> "required",
            "req_safari_tour"   => "required",
        ];
    }
}
