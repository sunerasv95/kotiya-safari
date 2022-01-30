@extends('layouts.admin-app')
@section('page-styles')
@endsection

@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">View Inquiry</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> --}}
        </div>
        {{-- <button type="button" class="btn btn-sm btn-success">
            New Inquiry
        </button> --}}
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="card shadow p-3 mb-5 bg-body rounded border-0">
            <div class="card-body">
                <div class="mb-2 row">
                    <div class="col-sm-5">
                        <h4>#{{ $inquiry['inq_reference_no'] }}</h4></span>
                    </div>
                    <div class="col-sm-7">
                        @if ($inquiry['inq_status'] === 0)
                        <h5><span class="badge bg-warning text-dark">Pending Approval</span></h5>
                        @elseif($inquiry['inq_status'] === 1)
                        <h5><span class="badge bg-success">Approved</span></h5>
                        @else
                        <h5><span class="badge bg-danger">Rejected</span></h5>
                        @endif
                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Customer Name</strong></span></div>
                    <div class="col-sm-7"><span>{{ $inquiry['customer_name'] }}</span></div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Customer Email</strong></span></div>
                    <div class="col-sm-7"><span>{{ $inquiry['customer_email'] }}</span></div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Inquiry Created At</strong></span></div>
                    <div class="col-sm-7"><span>{{ $inquiry['created_at'] }}</span></div>
                </div>

                <div class="border-bottom w-100 p-1 mb-3"></div>

                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Check-In </strong></span></div>
                    <div class="col-sm-7"><span>{{ $inquiry['checkin_date'] }}</span></div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Check-Out</strong></span></div>
                    <div class="col-sm-7"><span>{{ $inquiry['checkout_date'] }}</span></div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Boarding Plan</strong></span></div>
                    <div class="col-sm-7"><span>{{ $inquiry['boarding_plan'] }}</span></div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Number of Adults</strong></span></div>
                    <div class="col-sm-7"><span>{{ $inquiry['nof_adults'] }}</span></div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Number of Kids</strong></span></div>
                    <div class="col-sm-7"><span>{{ $inquiry['nof_kids'] }}</span></div>
                </div>

                {{-- <div class="border-bottom w-100 p-1 mb-3"></div>

                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Airport pickup is required</strong></span></div>
                    <div class="col-sm-7">
                        @if ($inquiry['required_airport_pickup'] === 1)
                        <span class="badge bg-success">Yes</span>
                        @else
                        <span class="badge bg-danger">No</span>
                        @endif
                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-5"><span><strong>Safari arrangement is required</strong></span></div>
                    <div class="col-sm-7">
                        @if ($inquiry['required_airport_pickup'] === 1)
                        <span class="badge bg-success">Yes</span>
                        @else
                        <span class="badge bg-danger">No</span>
                        @endif
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div>
            <h4>Quick Actions</h4>
            <div class="d-flex flex-column mb-3">
                <button type="button" class="btn btn-warning mb-1 mt-1">Update</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Generate a Booking</button>
            </div>

            <div class="border-bottom w-100 p-1 mb-3"></div>

            <h4>Status</h4>
            <div class="d-flex flex-column mb-3">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Inquiry Status</option>
                    <option value="1">Pending Approval</option>
                    <option value="2">Approved</option>
                    <option value="3">Canceled</option>
                    <option value="3">Completed</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="pb-3">
                    <small>You're about to generate a reservation for this inquiry. Please add following information to continue</small>
                </span>
                <form class="pt-2">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Location</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select a Camping Site</option>
                            <option value="1">Camp Site A</option>
                            <option value="2">Camp Site B</option>
                            <option value="3">Camp Site C</option>
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tent</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select a Tent</option>
                            <option value="1">T-001</option>
                            <option value="2">T-002</option>
                            <option value="3">T-003</option>
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Remark</label>
                        <textarea class="form-control" id="message-text" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="bookingGenerateBtn">Generate</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script src="{{ asset('dist/admin/js/reservations.js') }}"></script>
@endsection
