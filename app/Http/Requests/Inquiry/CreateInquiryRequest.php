<?php

namespace App\Http\Requests\Inquiry;

use Illuminate\Foundation\Http\FormRequest;

class CreateInquiryRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        //dd("eee", $this->selectedServicesArr);
        $serviceArr = [];
        if(isset($this->selectedServicesArr)){
            $serviceArr = $this->setServicesAttributes($this->selectedServicesArr);
        }

        $this->merge([
            'selectedServicesArr' => $serviceArr,
        ]);
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
        return [
            "firstName"             => "required|string",
            "lastName"              => "required|string",
            "email"                 => "required|email",
            "checkInDate"           => "required|date",
            "checkOutDate"          => "required|date",
            "noAdults"              => "required|integer|min:1",
            "noKids"                => "required|integer",
            "country"               => "required",
            "serviceRequired"       => "required|boolean",
            "selectedServicesArr"   => "nullable"
        ];
    }

    private function setServicesAttributes($stringifyArr)
    {
        $str = trim($stringifyArr);
        $str = str_replace(["[", "]", "\""], "", $str);
        $str = explode(",", $str);
        //dd($str);
        return $str;
    }
}
