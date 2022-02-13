<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inquiry\UpdateInquiryRequest;
use App\Services\Contracts\InquiryServiceInterface;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    private $inquiryService;

    public function __construct(InquiryServiceInterface $inquiryService)
    {
        $this->inquiryService = $inquiryService;
    }

    public function findAll()
    {
        $inquiries = $this->inquiryService->getAllInquiries();
        //dd($inquiries);
        return view('admin.inquiry.index', compact('inquiries'));
    }

    public function findByReferenceNumber($referenceNumber)
    {
        $inquiry = $this->inquiryService->getInquiryByReferenceNumber($referenceNumber);
        //dd($inquiry);
        if(!isset($inquiry)){
            return redirect()->back()->withErrors("Inquiry is not found");
        }else{
            return view('admin.inquiry.show', compact('inquiry'));
        }
    }

    public function update(UpdateInquiryRequest $request)
    {
        //dd($request->all());
        $validatedData = $request->validated();
        $result = $this->inquiryService->updateInquiry($validatedData);

        if($result['error']){
            return redirect()->back()->with("errorMsg", $result['message']);
        }else{
            return redirect()
                ->route('view-inquiry', ['inquiryId' => $validatedData['updInquiryId']])
                ->with("successMsg", $result['message']);
        }
    }

    // public function saveInquiry(CreateInquiryRequest $request)
    // {
    //     $reqData = $request->validated();
    //     return $this->inquiryService->createInquiry($reqData);
    // }
}
