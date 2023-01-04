<?php

namespace App\Http\Requests\Inquiry;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BookingInquiryRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'check_in' => Carbon::parse($this->check_in)->format('Y-m-d'),
            'check_out' => Carbon::parse($this->check_out)->format('Y-m-d'),
            'flexible_dates' => !$this->has('flexible_dates') || $this->flexible_dates === "off" ? 0 : 1,
            'tc_agreed' => $this->has('tc_agreed') && $this->tc_agreed === "on" ? 1 : 0,
        ]);
    }

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
            "full_name"         => "required|string",
            "email"             => "required|email",
            "check_in"          => "required|date",
            "check_out"         => "required|date",
            "flexible_dates"    => "required|boolean",
            "no_adults"         => "required|integer|min:1",
            "no_kids"           => "required|integer",
            "country"           => "required",
            "tc_agreed"         => "required|boolean|in:1",
        ];
    }
}
