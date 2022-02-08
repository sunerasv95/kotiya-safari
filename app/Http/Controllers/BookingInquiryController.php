<?php

namespace App\Http\Controllers;

use App\Http\Requests\Inquiry\BookingInquiryRequest;
use App\Services\Contracts\CommonServiceInterface;
use App\Services\Contracts\InquiryServiceInterface;
use Illuminate\Http\Request;

class BookingInquiryController extends Controller
{
    private $commonService;
    private $inquiryService;

    public function __construct(
        CommonServiceInterface $commonService,
        InquiryServiceInterface $inquiryService
    )
    {
        $this->commonService = $commonService;
        $this->inquiryService = $inquiryService;
    }

    public function makeRequest()
    {
        $countries = $this->commonService->retrieveDataFromJsonFile("countries");
        $vas = $this->inquiryService->getAllValueAddedServices();
        //dd($vas);
        return view('inquiry.index', compact('countries', 'vas'));
    }

    public function storeReservationRequest(BookingInquiryRequest $request)
    {
        //dd($request->all());
       $validatedData = $request->validated();
       //dd($validatedData);
       $result = $this->inquiryService->createInquiry($validatedData);

       if($result){
            $successMsg = "Your request has been submited successfully. Please check your email to verify your email.";
            return redirect()->route('reservation-request')->with("successMsg", $successMsg);
       }else{
            $errorMsg = "Please check following errors!";
            return redirect()->back('reservation-request')->with("successMsg", $errorMsg);
       }
    }
}
