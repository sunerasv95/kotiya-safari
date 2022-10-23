<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inquiry\CreateInquiryRequest;
use App\Http\Requests\Inquiry\UpdateInquiryRequest;
use App\Services\Contracts\CommonServiceInterface;
use App\Services\Contracts\InquiryServiceInterface;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    private $inquiryService;
    private $commonService;

    public function __construct(
        InquiryServiceInterface $inquiryService,
        CommonServiceInterface $commonService
    )
    {
        $this->inquiryService   = $inquiryService;
        $this->commonService    = $commonService;
    }

    public function findAll()
    {
        $inquiries = $this->inquiryService->getAllInquiries();
        $status    = $this->commonService->retriveInquiryStatus();
        //dd($inquiries, $status);
        return view('admin.inquiry.index', compact('inquiries', 'status'));
    }

    public function findAllByStatus(Request $request, $status = null)
    {
        $filteredInquiries = [];
        //dd("test", $status);
        if($request->ajax()){
            if(isset($status)){
                $inquiries = $this->inquiryService->getAllInquiries($status);
                return json_encode($inquiries);
            }
        }
        //dd($inquiries, $status);
        return $filteredInquiries;
    }

    public function createInquiry()
    {
        $countries = $this->commonService->retrieveCountryList();
        $vas = $this->inquiryService->getAllValueAddedServices();

        return view('admin.inquiry.create', compact('countries', 'vas'));
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

    public function save(CreateInquiryRequest $request)
    {
        //dd($request->all());
        $reqData = $request->validated();
        $res = $this->inquiryService->createInquiry($reqData);

        if (!$res['error']) {
            $successMsg = "Inquiry has been created successfully.";
            return redirect()->route('admin.inquiries')->with("successMsg", $successMsg);
        } else {
            $errorMsg = "Please check following errors!";
            return redirect()->back()->with("errorMsg", $errorMsg);
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
                ->route('admin.inquiries.view', ['inquiryId' => $validatedData['updInquiryId']])
                ->with("successMsg", $result['message']);
        }
    }

    public function reject(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            "rejectId"      => "required",
            "rejectReason"  => "required|string"
        ]);

        $result = $this->inquiryService->rejectInquiry($validatedData);

        if($result['error']){
            return redirect()->back()->with("errorMsg", $result['message']);
        }else{
            return redirect()
                ->route('admin.inquiries.view', ['inquiryId' => $validatedData['rejectId']])
                ->with("successMsg", $result['message']);
        }
    }
}
