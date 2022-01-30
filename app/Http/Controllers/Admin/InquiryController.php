<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inquiry\CreateInquiryRequest;
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
        return view('admin.inquiry.index', compact('inquiries'));
    }

    public function findByReferenceNumber($referenceNumber)
    {
        $inquiry = $this->inquiryService->getInquiryByReferenceNumber($referenceNumber);
        if(!isset($inquiry)){
            return redirect()->back()->withErrors("Inquiry is not found");
        }else{
            return view('admin.inquiry.show', compact('inquiry'));
        }
    }

    public function saveInquiry(CreateInquiryRequest $request)
    {
        $reqData = $request->validated();
        return $this->inquiryService->createInquiry($reqData);
    }
}
