@extends('layouts.admin-app')

@php $pageTitle = "New Inquiry" @endphp

@section('page-title', $pageTitle)

@section('page-styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
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
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @include('partial-views.forms.reservation-inquiry', [
                        'submit_route' => route('admin.inquiries.create.submit'),
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        $(function() {
            var checkin = $('#check-in-datepicker');
            var checkout = $('#check-out-datepicker');

            checkin.datepicker({
                format: 'mm/dd/yyyy',
                startDate: "+0d",
            }).on('changeDate', function(e) {

                var newDate = new Date(e.date);
                newDate.setDate(newDate.getDate() + 1)

                checkout.datepicker('setStartDate', newDate);
                checkout.datepicker("update", newDate);

                $('#check-out-datepicker')[0].focus();
            });

            checkout.datepicker({
                format: 'mm/dd/yyyy',
                startDate: "+1d",
            });
        });

        $(document).on('click', '#inquiry-submit', function() {
            $('#inquiry-form').validate({
                rules: {
                    full_name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    check_in: {
                        required: true,
                        date: true
                    },
                    check_out: {
                        required: true,
                        date: true
                    },
                    flexible_dates: {
                        required: false
                    },
                    no_adults: {
                        required: true
                    },
                    no_kids: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    tc_agreed: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
