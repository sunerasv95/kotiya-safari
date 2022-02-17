@extends('layouts.admin-app')
@section('page-styles')
@endsection

@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">View Inquiry</h1>
</div>
<div class="row my-2">
    <div class="col-md-12">
        <a href="{{ route('list-inquiries') }}" class="btn  btn-light">
            <i class="bi bi-arrow-left-circle"></i>
            Back to List
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @include('partial-views.alerts.alert-danger')
        @include('partial-views.alerts.alert-success')
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card shadow p-3 mb-5 bg-body rounded border-0">
            <div class="card-body">
                <div class="mb-2 row">
                    <div class="col-sm-3">
                        <h4>#{{ $inquiry['inquiry_reference_no'] }}</h4></span>
                    </div>
                    <div class="col-sm-9">
                        @if ($inquiry['status'] === "PENDING")
                        <h5><span class="badge bg-warning text-dark">Pending</span></h5>
                        @elseif($inquiry['status'] === "RES_ADDED")
                        <h5><span class="badge bg-success">Reservation Added</span></h5>
                        @elseif($inquiry['status'] === "REJECTED")
                        <h5><span class="badge bg-danger">Rejected</span></h5>
                        @else
                        <h5><span class="badge bg-secondary">N/A</span></h5>
                        @endif
                    </div>
                </div>

                <dl class="row">
                    <dt class="col-sm-3">Customer Name</dt>
                    <dd class="col-sm-9">{{ $inquiry['guest']['full_name'] }}</dd>

                    <dt class="col-sm-3">Customer Email</dt>
                    <dd class="col-sm-9">{{ $inquiry['guest']['email'] }}</dd>

                    <dt class="col-sm-3">Check-In </dt>
                    <dd class="col-sm-9">{{ $inquiry['checkin_date'] }}</dd>

                    <dt class="col-sm-3">Check-Out</dt>
                    <dd class="col-sm-9">{{ $inquiry['checkout_date'] }}</dd>

                    <dt class="col-sm-3">Number of Adults</dt>
                    <dd class="col-sm-9">{{ $inquiry['no_adults'] }}</dd>

                    <dt class="col-sm-3">Number of Kids</dt>
                    <dd class="col-sm-9">{{ $inquiry['no_kids'] }}</dd>

                    <dt class="col-sm-3">Inquiry Created At</dt>
                    <dd class="col-sm-9">{{ $inquiry['created_at'] }}</dd>

                    @if ($inquiry['remark'] != null)
                    <dt class="col-sm-3">Remark</dt>
                    <dd class="col-sm-9">{{ $inquiry['remark'] }}</dd>
                    @endif

                    @if ($inquiry['remark'] != null)
                    <dt class="col-sm-3">Remark</dt>
                    <dd class="col-sm-9">{{ $inquiry['remark'] }}</dd>
                    @endif

                    @if ($inquiry['remark'] != null)
                    <dt class="col-sm-3">Remark</dt>
                    <dd class="col-sm-9">{{ $inquiry['remark'] }}</dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div>
            @if ($inquiry['status'] === "PENDING" || $inquiry['status'] === "RES_ADDED")
            <h5>Actions</h5>
            @endif
            <div class="d-flex flex-column mb-3">
                @if ($inquiry['status'] === "PENDING")
                <button type="button" class="btn btn-warning mb-1 mt-1" data-bs-toggle="modal"
                    data-bs-target="#updateInquiryModal">
                    <i class="bi bi-pencil-square"></i>
                    Update</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#reservationGenModal">
                    <i class="bi bi-file-arrow-up"></i>
                    Generate a Reservation</button>
                <button type="button" class="btn btn-outline-danger mb-1 mt-1" data-bs-toggle="modal"
                    data-bs-target="#rejectedConfirmation">
                    <i class="bi bi-x-octagon"></i>
                    Reject Inquiry</button>
                @endif

                @if ($inquiry['status'] === "RES_ADDED" && !empty($inquiry['reservation_order']))
                    <a href="{{ route('view-reservation', ['bkRefId'=> $inquiry['reservation_order']['order_reference_no']]) }}"
                        class="btn btn-info">
                        <i class="bi bi-box-arrow-in-up-right"></i>
                        Go-to Reservation
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Reservation Generate Modal -->
<div class="modal fade" id="reservationGenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reservation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="pb-3">
                    Reservation will be genarated according to following details
                </span>
                <fieldset disabled>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <label for="checkInDatePreview" class="form-label">Check-In</label>
                            <input class="form-control" type="date" id="checkInDatePreview" value={{
                                $inquiry['checkin_date']}}>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="checkOutDatePreview" class="form-label">Check-Out</label>
                            <input class="form-control" type="date" id="checkOutDatePreview" value={{
                                $inquiry['checkout_date']}}>
                        </div>
                    </div>
                </fieldset>
                <form class="pt-1" id="reservationOrderForm" method="POST"
                    action="{{ route('store-reservation-order-request') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="campSite" class="form-label">Location</label>
                        <select class="form-select" id="campSite" name="campSiteId"
                            aria-label="Reserved Camp site location">
                            <option selected value>Select a Camping Site</option>
                            <option value="CAMPS-A">Camp Site A</option>
                            <option value="CAMPS-B">Camp Site B</option>
                            <option value="CAMPS-C">Camp Site C</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tent" class="form-label">Tent</label>
                            <select class="form-select" id="tent" name="tentId" aria-label="Reserved Tent">
                                <option selected value>Select a Tent</option>
                                <option value="TNT-01">T-001</option>
                                <option value="TNT-02">T-002</option>
                                <option value="TNT-03">T-003</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="totalNights" class="form-label">Total Nights</label>
                            <input type="text" class="form-control" value="{{ $inquiry['total_nights']}}"
                                id="totalNights" name="nightsCount" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="form-label">Remark</label>
                        <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="inquiryId" value="{{ $inquiry['inquiry_reference_no'] }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" id="bookingGenerateBtn"
                    form="reservationOrderForm">Generate Reservation</button>
            </div>
        </div>
    </div>
</div>


<!-- Inquiry Update Modal -->
<div class="modal fade" tabindex="-1" id="updateInquiryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Inquiry #{{ $inquiry['inquiry_reference_no'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="inquiryUpdateForm" action="{{ route('update-inquiry-submit') }}" method="POST">
                    @csrf
                    <div class=" row mb-3">
                        <div class="col">
                            <label for="updNoAdults" class="col-form-label">No of Adults</label>
                            <input type="number" class="form-control" id="updNoAdults" name="updNoAdults"
                                value="{{ $inquiry['no_adults'] }}">
                        </div>
                        <div class="col">
                            <label for="updNoKids" class="col-form-label">No of Kids</label>
                            <input type="number" class="form-control" id="updNoKids" name="updNoKids"
                                value="{{ $inquiry['no_kids'] }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="updRemark" class="col-form-label">Remark</label>
                        <textarea class="form-control" id="updRemark" name="updRemark"
                            rows="3">{{ $inquiry['remark'] ?? "" }}</textarea>
                    </div>
                    <input type="hidden" name="updInquiryId" value="{{ $inquiry['inquiry_reference_no'] }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning" id="updateInquiryBtn" form="inquiryUpdateForm">Save
                    Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Reject inquiry modal -->
<div class="modal fade" tabindex="-1" id="rejectedConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Confirmation</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>This action can not be un-done. Are you sure to reject this inquiry?</p>
                <form
                    id="inquiryRejectForm"
                    method="POST"
                    action="{{ route('reject-inquiry-submit') }}"
                >
                    @csrf
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Reject Reason</label>
                        <textarea class="form-control" id="rejectReason" name="rejectReason"></textarea>
                    </div>
                    <input type="hidden" name="rejectId" value="{{ $inquiry['inquiry_reference_no'] }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button
                    type="submit"
                    class="btn btn-danger"
                    id="confirmRejectInquiryBtn"
                    form="inquiryRejectForm"
                >Yes, Reject this Inquiry</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
$(document).on("click", "#bookingGenerateBtn", function(){
    $("#reservationOrderForm").validate({
            rules: {
                campSiteId: {
                    required: true
                },
                tentId:{
                    required: true
                },
                remark: {
                    required: false
                }
            }
    });
});

$(document).on("click", "#updateInquiryBtn", function(){
    $("#inquiryUpdateForm").validate({
        rules: {
            updNoAdults: {
                required: true,
                digits: true,
                min:1,
                max: 5
            },
            updNoKids:{
                required: true,
                digits: true,
                min: 0,
                max: 5
            },
            updRemark: {
                required: false
            }
        }
    });
});

$(document).on("click", "#confirmRejectInquiryBtn", function(){
    $("#inquiryRejectForm").validate({
        rules: {
            rejectReason: {
                required: true,
                minlength: 2,
                maxlength: 100
            }
        }
    });
});

</script>
@endsection
