<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inquiry\BookingInquiryRequest;
use App\Models\Guest;
use App\Notifications\Guest\InquiryPlaced;
use App\Services\Contracts\CommonServiceInterface;
use App\Services\Contracts\InquiryServiceInterface;
use Illuminate\Http\Request;

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
        $countries = $this->commonService->retriveCountryList();
        $vas = $this->inquiryService->getAllValueAddedServices();
        //dd($countries);
        return view('inquiry.index', compact('countries', 'vas'));
    }

    public function storeInquiry(BookingInquiryRequest $request)
    {
        $validatedData = $request->validated();

        $result = $this->inquiryService->createInquiry($validatedData);

        if ($result['error'] === false) {
            $successMsg = $result['message'];
            return redirect()->route('guest.inquiries.request')->with("successMsg", $successMsg);
        } else {
            $errorMsg = "Something went wrong!";
            return redirect()->back('guest.inquiries.request')->with("errorMsg", $errorMsg);
        }
    }
}
