@extends('layouts.admin-app')

@php $pageTitle = "Inquiries" @endphp

@section('page-title', $pageTitle)

@section('page-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('main-content')
<<<<<<< HEAD
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3">
    <h1 class="h2">Inquiries</h1>
        <a href="{{ route('create-inquiry') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New Inquiry
        </a>
</div>
<div class="row">
    <div class="col-md-12">
        @include('partial-views.alerts.alert-danger')
        @include('partial-views.alerts.alert-success')
    </div>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5">
    <div class="row">
        <div class="col-md-12">
            <span class="mr-3"><i class="bi bi-funnel"></i>Filters</span>
        </div>
        <div class="col-md-12 mt-2">
            @if (!empty($status))
        <input
            type="radio"
            class="btn-check mx-1"
            name="status-filter"
            id="ALL-outlined"
            autocomplete="off"
            value="ALL">
        <label
            class="btn btn-outline-secondary btn-sm mx-1"
            for="ALL-outlined">All Inquiries
        </label>
            @foreach ($status as $item)
                <input
                    type="radio"
                    class="btn-check mx-1"
                    name="status-filter"
                    id="{{ $item['status_name'] }}-outlined"
                    autocomplete="off"
                    value="{{ $item['status_name'] }}">
                <label
                    class="btn btn-outline-secondary btn-sm mx-1"
                    for="{{ $item['status_name'] }}-outlined">{{ $item['display_name'] }} Inquiries
                </label>
            @endforeach
        @endif
=======
    <div>
        <x-breadcrumb />
        <x-alerts-bar/>
        <x-action-bar>
            <x-slot name="start">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filter
                    </button>
                    <ul class="dropdown-menu">
                        @if (!empty($status))
                            <li>
                                <input class="dropdown-item inquiry-filter" type="button" name="status-filter"
                                    id="all-btn" value="ALL">
                            </li>
                            @foreach ($status as $item)
                                @php
                                    $status = $item['status_name'];
                                    $statusName = $item['display_name'];
                                @endphp
                                <li>
                                    <input class="dropdown-item inquiry-filter" type="button" name="status-filter"
                                        id="{{ Str::lower($status) }}-btn" value="{{ $status }}">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </x-slot>
            <x-slot name="end">
                <a class="btn btn-success" href="{{ route('admin.inquiries.create') }}" role="button">
                    <i class="bi bi-plus-circle"></i>
                    New Inquiry
                </a>
            </x-slot>
        </x-action-bar>

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
                                <td>{{ $inquiry['inquiry_reference_no'] }}</td>
                                <td>{{ $inquiry['guest']['name'] }}</td>
                                <td>{{ $inquiry['guest']['email'] }}</td>
                                <td>{{ $inquiry['checkin_date'] }} - {{ $inquiry['checkout_date'] }}</td>
                                <td>
                                    @if ($inquiry['status'] === 'PENDING')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($inquiry['status'] === 'RESERVED')
                                        <span class="badge bg-success text-light">Reservation Added</span>
                                    @elseif($inquiry['status'] === 'REJECTED')
                                        <span class="badge bg-danger text-light">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary text-light">N/A</span>
                                    @endif
                                <td>
                                    <a href="{{ route('admin.inquiries.view', ['inquiryId' => $inquiry['inquiry_reference_no']]) }}"
                                        class="btn btn-primary btn-sm">
                                        View
                                        <i class="bi bi-arrow-right-short"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
>>>>>>> c56bc2f339cdd0d73b8d0362c4ec093e75af0a4c
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(function() {
            var inquiryTable = $('#inquiry-table').DataTable({
                ordering: false,
                searching: true,
                paging: true,
                info: true,
                responsive: true
            });

            $(document).on('click', '.inquiry-filter', function() {
                let status = $(this).val();

                filterByStatus(status)
                    .then(function(filteredInquiries) {
                        console.log(filteredInquiries);
                        inquiryTable.clear().draw();

                        filteredInquiries.forEach(inquiry => {
                            let badge, viewBtn = null;
                            if (inquiry.status === "PENDING") {
                                badge =
                                    `<span class='badge bg-warning text-dark'>Pending</span>`;
                            } else if (inquiry.status === "RESERVED") {
                                badge =
                                    `<span class='badge bg-success text-light'>Reservation Added</span>`;
                            } else if (inquiry.status === "REJECTED") {
                                badge =
                                    `<span class='badge bg-danger text-light'>Rejected</span>`;
                            } else {
                                badge =
                                    `<span class='badge bg-secondary text-light'>N/A</span>`;
                            }

                            viewBtn =
                                `<a href='${window.location.pathname}/${inquiry.inquiry_reference_no}' class='btn btn-primary btn-sm'>View <i class="bi bi-arrow-right-short"></i></a>`;

                            let dataRow = [
                                inquiry.inquiry_reference_no,
                                inquiry.guest.name,
                                inquiry.guest.email,
                                inquiry.checkin_date + " - " + inquiry.checkout_date,
                                badge,
                                viewBtn
                            ];

                            inquiryTable.row.add(dataRow).draw(false);
                        });
                    })
                    .catch(function(err) {
                        console.log("Err", err);
                    })
            });
        });

        function filterByStatus(status) {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.inquiries.filter') }}" + "/" + status,
                    dataType: "JSON",
                    type: "GET",
                    success: function(res) {
                        resolve(res);
                    },
                    error: function(err) {
                        reject(err);
                    }
                });
            });
        }
    </script>
@endsection
