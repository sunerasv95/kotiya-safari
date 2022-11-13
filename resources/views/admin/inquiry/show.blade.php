@extends('layouts.admin-app')

@php $pageTitle = "View Inquiry" @endphp

@section('page-title', $pageTitle)

@section('page-styles')
@endsection

@section('main-content')

    <div>
        <x-admin-page-header>
            <x-slot name="actions"></x-slot>
        </x-admin-page-header>
        <div class="row">
            <div class="col-md-12">
                @include('partial-views.alerts.alert-danger')
                @include('partial-views.alerts.alert-success')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow p-3 rounded border-0">
                    <div class="card-body">
                        <div class="mb-2 row">
                            <div class="h4 pb-2 mb-4 text-black">
                                Details
                            </div>
                            <div class="col-sm-3">
                                <h4>#{{ $inquiry['inquiry_reference_no'] }}</h4></span>
                            </div>
                            <div class="col-sm-9">
                                @if ($inquiry['status'] === config('constants.PENDING_STATUS'))
                                    <h5><span class="badge bg-warning text-dark">Pending</span></h5>
                                @elseif($inquiry['status'] === config('constants.RESERVED_STATUS'))
                                    <h5><span class="badge bg-success">Reservation Added</span></h5>
                                @elseif($inquiry['status'] === config('constants.REJECTED_STATUS'))
                                    <h5><span class="badge bg-danger">Rejected</span></h5>
                                @else
                                    <h5><span class="badge bg-secondary">N/A</span></h5>
                                @endif
                            </div>
                        </div>

                        <dl class="row">
                            <dt class="col-sm-3">Customer Name</dt>
                            <dd class="col-sm-9">{{ $inquiry['guest']['name'] }}</dd>

                            <dt class="col-sm-3">Customer Email</dt>
                            <dd class="col-sm-9">{{ $inquiry['guest']['email'] }}</dd>

                            <dt class="col-sm-3">Check-In </dt>
                            <dd class="col-sm-9">{{ $inquiry['checkin_date'] }}</dd>

                            <dt class="col-sm-3">Check-Out</dt>
                            <dd class="col-sm-9">{{ $inquiry['checkout_date'] }}</dd>

                            <dt class="col-sm-3">Guest Flexible with Dates</dt>
                            <dd class="col-sm-9">
                                @if ($inquiry['dates_flexible'])
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-warning">No</span>
                                @endif
                            </dd>

                            <dt class="col-sm-3">Number of Adults</dt>
                            <dd class="col-sm-9">{{ $inquiry['no_adults'] }}</dd>

                            <dt class="col-sm-3">Number of Kids</dt>
                            <dd class="col-sm-9">{{ $inquiry['no_kids'] }}</dd>

                            <dt class="col-sm-3">Created At</dt>
                            <dd class="col-sm-9">{{ Carbon\Carbon::parse($inquiry['created_at']) }}</dd>

                            <dt class="col-sm-3">Updated At</dt>
                            <dd class="col-sm-9">{{ Carbon\Carbon::parse($inquiry['updated_at']) }}</dd>
                        </dl>

                        <div class="h4 pb-1 mb-4 text-black">
                            Remarks
                        </div>
                        <div class="py-1">
                            @forelse ($remarks as $remark)
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="text-muted fst-italic">
                                            <small>
                                                {{ Carbon\Carbon::parse($remark['updated_at']) }}
                                            </small>
                                        </p>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-muted fst-italic">
                                            <small>{{ $remark['body'] }}
                                                <span>
                                                    | By
                                                    {{ isCurrentUser($remark['remarked_user']['admin_code']) ? 'Me' : $remark['remarked_user']['name'] }}
                                                </span>
                                            </small>
                                        </p>
                                    </div>

                                </div>
                            @empty
                                <p class="text-muted fst-italic"><small>No remarks found</small></p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    <div class="d-flex flex-column mb-3">
                        @if ($inquiry['status'] === config('constants.PENDING_STATUS'))
                            <button type="button" class="btn btn-warning mb-1 mt-1" data-bs-toggle="modal"
                                data-bs-target="#update-inquiry-modal">
                                <i class="bi bi-pencil-square"></i>
                                Update</button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#reservation-generate-modal">
                                <i class="bi bi-file-arrow-up"></i>
                                Generate a Reservation</button>
                            <button type="button" class="btn btn-outline-danger mb-1 mt-1" data-bs-toggle="modal"
                                data-bs-target="#inquiry-reject-modal">
                                <i class="bi bi-x-octagon"></i>
                                Reject Inquiry</button>
                        @endif

                        @if ($inquiry['status'] === config('constants.RESERVED_STATUS') && !empty($inquiry['reservation_order']))
                            <a href="{{ route('admin.reservations.view', ['reference' => $inquiry['reservation_order']['reservation_reference']]) }}"
                                class="btn btn-info">
                                <i class="bi bi-box-arrow-in-up-right"></i>
                                Go-to Reservation
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partial-views.modals.generate-reservation', [
        'inquiryId' => $inquiry['inquiry_reference_no'],
    ])
    @include('partial-views.modals.update-inquiry', ['inquiryId' => $inquiry['inquiry_reference_no']])
    @include('partial-views.modals.reject-inquiry')

@endsection

@section('page-scripts')
    <script>
        $(function() {
            var updateModal = document.getElementById('update-inquiry-modal');
            var reservationModal = document.getElementById('reservation-generate-modal');
            var rejectModal = document.getElementById('inquiry-reject-modal');

            $("#inquiry-reject-form").validate({
                rules: {
                    msg_body: {
                        required: true,
                        minlength: 3
                    }
                }
            });

            $("#update-inquiry-form").validate({
                rules: {
                    up_checkin: {
                        required: true
                    },
                    up_checkout: {
                        required: true
                    },
                    up_no_adults: {
                        required: true,
                        min: 1
                    },
                    up_no_kids: {
                        required: true
                    }
                }
            });

            $('#inquiry-reject-form textarea').on('blur keyup', function() {
                if ($("#inquiry-reject-form").valid()) {
                    $('#reject-inquiry').prop('disabled', false);
                } else {
                    $('#reject-inquiry').prop('disabled', true);
                }
            });

            $('#update-inquiry-form input').on('change', function() {
                if ($("#update-inquiry-form").valid()) {
                    $('#update-inquiry').prop('disabled', false);
                } else {
                    $('#update-inquiry').prop('disabled', true);
                }
            })

            updateModal.addEventListener('hidden.bs.modal', function(e) {
                resetUpdateForm();
            });

            reservationModal.addEventListener('hidden.bs.modal', function(e) {
                resetReservationForm();
            });

            rejectModal.addEventListener('hidden.bs.modal', function(e) {
                resetRejectForm();
            });
        });

        function resetUpdateForm() {
            $('#update-inquiry').prop('disabled', true);

            var checkin = $('#update-checkin-date');
            var checkout = $('#update-checkout-date');
            var noadults = $('#update-no-adults');
            var nokids = $('#update-no-kids');

            checkin.val(checkin.data('prev'));
            checkout.val(checkout.data('prev'));
            noadults.val(noadults.data('prev'));
            nokids.val(nokids.data('prev'));
        }

        function resetReservationForm() {
            $('#reservation-note').val('');
        }

        function resetRejectForm() {
            $('#reject-inquiry').prop('disabled', true);
            $('#msg-body').val('');
        }
    </script>
    <script>
        var nowTemp = new Date();
        var now = new Date(
            nowTemp.getFullYear(),
            nowTemp.getMonth(),
            nowTemp.getDate(),
            0, 0, 0, 0
        );

        var checkin = $('#update-checkin-date').datepicker({
            beforeShowDay: function(date) {
                return date.valueOf() >= now.valueOf()
            },
            autoClose: true
        }).on('changeDate', function(e) {
            if (e.date.valueOf() >
                checkout.datepicker('getDate').valueOf() ||
                !checkout.datepicker('getDate').valueOf()
            ) {
                var newDate = new Date(e.date);
                newDate.setDate(newDate.getDate() + 1);
                checkout.datepicker("update", newDate);
            }
            $('#update-checkout-date')[0].focus();
        });

        var checkout = $('#update-checkout-date').datepicker({
            beforeShowDay: function(date) {
                if (!checkin.datepicker("getDate").valueOf()) {
                    return date.valueOf() >= new Date().valueOf();
                } else {
                    return date.valueOf() > checkin.datepicker("getDate").valueOf();
                }
            },
            autoclose: true

        }).on('changeDate', function(e) {});
    </script>
    <script>
        $(document).on("click", "#update-inquiry", function() {
            $("#update-inquiry-form").validate({
                rules: {
                    up_checkin: {
                        required: true,

                    },
                    up_checkout: {
                        required: true
                    },
                    up_no_adults: {
                        required: true,
                        min: 1
                    },
                    up_no_kids: {
                        required: true,
                        min: 0
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $(document).on("click", "#confirm-reservation", function() {
            $("#reservation-confirm-form").validate({
                rules: {
                    payment_option: {
                        required: true
                    },
                    payable_amount: {
                        required: true,
                        digits: true
                    },
                    reservation_note: {
                        required: false
                    }
                },
                submitHandler: function(form) {
                    console.log(form);
                    form.submit();
                }
            });
        });

        $(document).on("click", "#reject-inquiry", function() {
            $("#inquiry-reject-form").validate({
                rules: {
                    msg_body: {
                        required: true,
                        minlength: 2
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
