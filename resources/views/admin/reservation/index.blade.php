@extends('layouts.admin-app')

@php $pageTitle = "Reservations" @endphp

@section('page-title', $pageTitle)

@section('page-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('main-content')
    <div class="mt-3">
        <x-admin-page-header :page-title="$pageTitle" />
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
                            @endphp
                            <input type="radio" class="btn-check mx-1" name="status-filter"
                                id="{{ Str::lower($status) }}-outlined" autocomplete="off" value="{{ $status }}">
                            <label @class([
                                'btn',
                                'btn-sm',
                                'mx-1',
                                'btn-outline-primary' =>
                                    $status === config('constants.DEPOSIT_PAID_STATUS'),
                                'btn-outline-warning' => $status === config('constants.PENDING_STATUS'),
                                'btn-outline-success' => $status === config('constants.COMPLETED_STATUS'),
                                'btn-outline-danger' => $status === config('constants.CANCELLED_STATUS'),
                                'btn-outline-secondary' =>
                                    $status === config('constants.RESCHEDULED_STATUS'),
                            ]) for="{{ Str::lower($status) }}-outlined">
                                {{ Str::ucfirst($status) }}
                            </label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="reservation-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Booking Reference</th>
                        <th scope="col">Inquiry ID</th>
                        <th scope="col">Guest Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation['reservation_reference'] }}</td>
                            <td>
                                <a
                                    href="{{ route('admin.inquiries.view', ['inquiryId' => $reservation['inquiry']['inquiry_reference_no']]) }}">
                                    {{ $reservation['inquiry']['inquiry_reference_no'] }}
                                    <i class="bi-sm bi-box-arrow-up-right mb-2"></i>
                                </a>
                            </td>
                            <td>{{ $reservation['guest']['name'] }}</td>
                            <td>
                                @if ($reservation['status'] === config('constants.PENDING_STATUS'))
                                    <span class="badge bg-warning text-dark">Payment Pending</span>
                                @elseif($reservation['status'] === config('constants.DEPOSIT_PAID_STATUS'))
                                    <span class="badge bg-secondary text-light">Deposit Paid</span>
                                @elseif($reservation['status'] === config('constants.COMPLETED_STATUS'))
                                    <span class="badge bg-success text-light">Completed</span>
                                @elseif($reservation['status'] === config('constants.RESCHEDULED_STATUS'))
                                    <span class="badge bg-dark text-light">Re-Scheduled</span>
                                @elseif($reservation['status'] === config('constants.CANCELLED_STATUS'))
                                    <span class="badge bg-danger text-light">Cancelled</span>
                                @else
                                    <span class="badge bg-light text-dark">N/A</span>
                                @endif
                            <td>
                                <a href="{{ route('admin.reservations.view', ['reference' => $reservation['reservation_reference']]) }}"
                                    class="btn btn-primary btn-sm">
                                    View
                                    <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {

            var reservationTable = $('#reservation-table').DataTable({
                ordering: false,
                searching: true,
                paging: true,
                info: true,
                responsive: true
            });

            $("input[name=status-filter]").change(function() {
                let status = $(this).val();

                filterByStatus(status)
                    .then(function(filteredReservations) {
                        reservationTable.clear().draw();

                        filteredReservations.forEach(reservation => {
                            console.log('re', reservation);
                            let statusBadge, viewBtn = null;

                            if (reservation.status === "PENDING") {
                                statusBadge =
                                    `<span class='badge bg-warning text-dark'>Payment Pending</span>`;
                            } else if (reservation.status === "DEPOSIT_PAID") {
                                statusBadge =
                                    `<span class='badge bg-primary text-light'>Deposit Paid</span>`;
                            } else if (reservation.status === "COMPLETED") {
                                statusBadge =
                                    `<span class='badge bg-success text-light'>Completed</span>`;
                            } else if (reservation.status === "RESCHEDULED") {
                                statusBadge =
                                    `<span class='badge bg-secondary text-light'>Rescheduled</span>`;
                            } else if (reservation.status === "CANCELLED") {
                                statusBadge =
                                    `<span class='badge bg-danger text-light'>Cancelled</span>`;
                            } else {
                                statusBadge =
                                    `<span class='badge bg-secondary text-light'>N/A</span>`;
                            }

                            viewBtn =
                                `<a href='${window.location.pathname}/${reservation.reservation_reference}' class='btn btn-primary btn-sm'>View<i class="bi bi-arrow-right-short"></i></a>`;

                            let dataRow = [
                                reservation.reservation_reference,
                                reservation.inquiry.inquiry_reference_no,
                                reservation.guest.name,
                                statusBadge,
                                viewBtn
                            ];
                            reservationTable.row.add(dataRow).draw(false);
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
                    url: "{{ route('admin.reservations.filter') }}" + "/" + status,
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
