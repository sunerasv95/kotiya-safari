<?php

namespace App\Http\Controllers\Guest;

use App\Constants\Types;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inquiry\BookingInquiryRequest;
use App\Services\Contracts\CommonServiceInterface;
use App\Services\Contracts\InquiryServiceInterface;

class InquiryController extends Controller
{
    private $commonService;
    private $inquiryService;

    public function __construct(
        CommonServiceInterface $commonService,
        InquiryServiceInterface $inquiryService
    ) {
        $this->commonService = $commonService;
        $this->inquiryService = $inquiryService;
    }

    public function inquiry()
    {
        $countries = $this->commonService->retrieveCountryList();
        $vas = $this->inquiryService->getAllValueAddedServices();
        //dd($countries);
        return view('inquiry.index', compact('countries', 'vas'));
    }

    public function storeInquiry(BookingInquiryRequest $request)
    {
        try {
            $validated = $request->validated();
            $result = $this->inquiryService->createInquiry($validated, Types::WEB_REQUESTED);

            if($request->ajax()){
                return response()->json($result);
                // if($result['error'] == false){

                // }else{
                //     return response()->json($result, 500);
                // }
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        // if ($result['error'] === false) {
        //     $successMsg = $result['message'];
        //     return redirect()->route('guest.inquiries.request')->with("successMsg", $successMsg);
        // } else {
        //     $errorMsg = "Something went wrong!";
        //     return redirect()->back('guest.inquiries.request')->with("errorMsg", $errorMsg);
        // }
    }
}
