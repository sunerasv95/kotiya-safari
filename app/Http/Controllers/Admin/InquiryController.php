<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Types;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inquiry\BookingInquiryRequest;
use App\Http\Requests\Inquiry\CreateInquiryRequest;
use App\Http\Requests\Inquiry\RejectInquiryRequest;
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

    public function filter(Request $request, $status = null)
    {
        if($request->ajax()){
            if(isset($status)){
                $inquiries = $this->inquiryService->getAllInquiries($status);
                return json_encode($inquiries);
            }
        }
    }

    public function createInquiry()
    {
        $countries = $this->commonService->retrieveCountryList();
        //$vas = $this->inquiryService->getAllValueAddedServices();

        $data = compact('countries');
        return view('admin.inquiry.create', $data);
    }

    public function findOne($referenceNumber)
    {
        $inquiry = $this->inquiryService->getInquiryByReferenceNumber($referenceNumber);
        //dd($inquiry);
        if(!isset($inquiry)){
            return redirect()->back()->with("errorMsg", "Inquiry is not found");
        }else{
            $payOptions = $this->commonService->retrievePaymentOptions();
            $boardingPlans = $this->commonService->retrieveBoardingPlans();

            $remarks = $inquiry['remarks'];

            $data = compact('inquiry', 'remarks', 'payOptions', 'boardingPlans');
            //dd($data);
            return view('admin.inquiry.show', $data);
        }
    }

    public function save(BookingInquiryRequest $request)
    {
        $validated = $request->validated();

        $result = $this->inquiryService->createInquiry($validated, Types::ADMIN_REQUESTED);

        if (!$result['error']) {
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
        $validated = $request->validated();
        $result = $this->inquiryService->updateInquiry($validated);

        if($result['error']){
            return redirect()->back()->with("errorMsg", $result['message']);
        }else{
            return redirect()
                ->route('admin.inquiries.view', ['inquiryId' => $validated['inquiry_id']])
                ->with("successMsg", $result['message']);
        }
    }

    public function reject(RejectInquiryRequest $request)
    {
        $validated = $request->validated();

        $result = $this->inquiryService->rejectInquiry($validated);

        if($result['error']){
            return redirect()->back()->with("errorMsg", $result['message']);
        }else{
            return redirect()
                ->route('admin.inquiries.view', ['inquiryId' => $validated['inquiry_id']])
                ->with("successMsg", $result['message']);
        }
    }
}
