@extends('layouts.admin-app')

@php $pageTitle = "Inquiries" @endphp

@section('page-title', $pageTitle)

@section('page-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('main-content')
    <div class="mt-3">
        <x-admin-page-header 
            :page-title="$pageTitle"
            :has-button="true"
            :button-url="route('admin.inquiries.create')"
            button-icon="bi bi-plus-circle"
        />
        <div class="row">
            <div class="col-md-12">
                @include('partial-views.alerts.alert-danger')
                @include('partial-views.alerts.alert-success')
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <span class="mr-3"></i>Filters by Status</span>
                </div>
                <div class="col-md-12 mt-2">
                    @if (!empty($status))
                        <input type="radio" class="btn-check mr-1" name="status-filter" id="ALL-outlined"
                            autocomplete="off" value="ALL">
                        <label class="btn btn-outline-secondary btn-sm ml-0" for="ALL-outlined">All
                        </label>
                        @foreach ($status as $item)
                            @php
                                $status = $item['status_name'];
                                $statusName = $item['display_name'];
                            @endphp
                            <input type="radio" class="btn-check mx-1" name="status-filter"
                                id="{{ Str::lower($status) }}-outlined" autocomplete="off" value="{{ $status }}">
                            <label @class([
                                'btn',
                                'btn-sm',
                                'mx-1',
                                'btn-outline-warning' => $status === 'PENDING',
                                'btn-outline-success' => $status === 'RESERVED',
                                'btn-outline-danger' => $status === 'REJECTED',
                            ]) for="{{ Str::lower($status) }}-outlined">
                                {{ Str::ucfirst($statusName) }}
                            </label>
                        @endforeach
                    @endif
                </div>
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

            $("input[name=status-filter]").change(function() {
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
