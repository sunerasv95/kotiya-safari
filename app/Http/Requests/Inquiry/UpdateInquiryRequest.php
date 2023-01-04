<?php

namespace App\Http\Requests\Inquiry;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInquiryRequest extends FormRequest
{
    
    protected function prepareForValidation()
    {
        $this->merge([
            'up_checkin' => Carbon::parse($this->up_checkin)->format('Y-m-d'),
            'up_checkout' => Carbon::parse($this->up_checkout)->format('Y-m-d'),
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
            "inquiry_id"    => "required|exists:inquiries,inquiry_reference_no",
            "up_checkin"    => "date",
            "up_checkout"   => "date",
            "up_no_adults"  => "numeric",
            "up_no_kids"    => "numeric"
        ];
    }
}
