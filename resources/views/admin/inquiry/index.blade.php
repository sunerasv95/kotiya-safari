@extends('layouts.admin-app')
@section('page-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Inquiries</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> --}}
        </div>
        <button type="button" class="btn btn-sm btn-success">
            New Inquiry
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
    <table id="inquiry-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Requested Dates</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($inquiries))
            @foreach ($inquiries as $inquiry)
            <tr>
                <td>{{ $inquiry['inq_reference_no'] }}</td>
                <td>{{ $inquiry['customer_name'] }}</td>
                <td>{{ $inquiry['customer_email'] }}</td>
                <td>{{ $inquiry['checkin_date'] }} - {{ $inquiry['checkout_date'] }}</td>
                <td>
                    @if ($inquiry['inq_status'] === 0)
                    <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($inquiry['inq_status'] === 1)
                    <span class="badge bg-success text-dark">Booking approved</span>
                    @else
                    <span class="badge bg-danger text-dark">Rejected</span>
                    @endif
                <td>
                    <a href="{{ route('view-inquiry', ['inquiryId'=> $inquiry['inq_reference_no']]) }}"
                        class="btn btn-primary btn-sm">
                        View
                        </button>
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
    $('#inquiry-table').DataTable();
} );
</script>
@endsection

