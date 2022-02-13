@extends('layouts.admin-app')
@section('page-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection
{{-- dd($reservations) --}}
@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Reservations</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> --}}
        </div>
        <button type="button" class="btn btn-sm btn-success">
            Create New Reservation
        </button>
    </div>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5">
    <div class="btn-toolbar">
        <select class="form-select" aria-label="Default select example">
            <option selected>Filter by Status</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
</div>
<div class="table-responsive">
    <table id="reservation-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Booking Reference</th>
                <th scope="col">Inquiry ID</th>
                <th scope="col">Guest Name</th>
                <th scope="col">Guest Email</th>
                <th scope="col">Verification Status</th>
                <th scope="col">Reservation Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($reservations))
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation['order_reference_no'] }}</td>
                <td>
                    <a href="{{ route('view-inquiry', ['inquiryId'=> $reservation['inquiry']['inquiry_reference_no'] ])}}">
                        {{ $reservation['inquiry']['inquiry_reference_no'] }}
                        <i class="bi-sm bi-box-arrow-up-right mb-2"></i>
                    </a>
                </td>
                <td>{{ $reservation['inquiry']['guest']['full_name'] }}</td>
                <td>{{ $reservation['inquiry']['guest']['email'] }}</td>
                <td>
                    @if ($reservation['is_verified'] === 1)
                        <span class="badge bg-success text-kight">Booking Verified</span>
                    @else
                        <span class="badge bg-warning text-dark">Verification Pending</span>
                    @endif
                </td>
                <td>
                    @if ($reservation['status'] === "PENDING")
                    <span class="badge bg-warning text-dark">Payment Pending</span>
                    @elseif($reservation['status'] === "PAR_PAID")
                    <span class="badge bg-secondary text-light">Partial Payment Received</span>
                    @elseif($reservation['status'] === "COMPLETED")
                    <span class="badge bg-success text-light">Completed</span>
                    @elseif($reservation['status'] === "RE_SCHE")
                    <span class="badge bg-dark text-light">Re-Scheduled</span>
                    @elseif($reservation['status'] === "CANCELLED")
                    <span class="badge bg-danger text-light">Cancelled</span>
                    @else
                    <span class="badge bg-light text-dark">N/A</span>
                    @endif
                <td>
                    <a href="{{ route('view-reservation', ['bkRefId'=> $reservation['order_reference_no']]) }}"
                        class="btn btn-primary btn-sm">
                        View
                    </a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection

@section('page-scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
    $('#reservation-table').DataTable();
} );
</script>
@endsection

