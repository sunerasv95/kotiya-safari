@extends('layouts.admin-app')

@php $pageTitle = "View Reservation" @endphp

@section('page-title', $pageTitle)

@section('page-styles')
@endsection

@php
    $chin = \Carbon\Carbon::parse($inquiry['checkin_date']);
    $chout = \Carbon\Carbon::parse($inquiry['checkout_date']);

    $nights = $chin->diff($chout)->format('%a');
@endphp

@section('main-content')
    <div class="mt-3">
        <x-admin-page-header :page-title="$pageTitle" />

<div class="row">
    <div class="col-md-12">
        @include('partial-views.alerts.alert-danger')
        @include('partial-views.alerts.alert-success')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow p-3 mb-3 rounded border-0">
            <div class="card-body">
                <div class="mb-2 row">
                    <div class="h4 pb-2 mb-4 text-black">
                        Reservation Details
                    </div>
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-6"><h4>#{{ $reservation['reservation_reference'] }}</h4></dt>
                            <dd class="col-sm-6">
                                @if ($reservation['status'] === config('constants.PENDING_STATUS'))
                                    <h5><span class="badge bg-warning text-dark">Payment Pending</span></h5>
                                @elseif($reservation['status'] === config('constants.DEPOSIT_PAID_STATUS'))
                                    <h5><span class="badge bg-secondary text-light">Deposit Paid</span></h5>
                                @elseif($reservation['status'] === config('constants.COMPLETED_STATUS'))
                                    <h5><span class="badge bg-success text-light">Completed</span></h5>
                                @elseif($reservation['status'] === config('constants.RESCHEDULED_STATUS'))
                                    <h5><span class="badge bg-dark text-light">Re-Scheduled</span></h5>
                                @elseif($reservation['status'] === config('constants.CANCELLED_STATUS'))
                                    <h5><span class="badge bg-danger text-light">Cancelled</span></h5>
                                @else
                                    <h5><span class="badge bg-light text-dark">N/A</span></h5>
                                @endif
                            </dd>

                            <dt class="col-sm-6">Guest Name</dt>
                            <dd class="col-sm-6">{{ $guest['name'] }}</dd>
        
                            <dt class="col-sm-6">Guest Email</dt>
                            <dd class="col-sm-6">{{ $guest['email'] }}</dd>
        
                            <dt class="col-sm-6">Country</dt>
                            <dd class="col-sm-6">{{ $country['country'] }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-6">Check-in</dt>
                            <dd class="col-sm-6">{{ $inquiry['checkin_date'] }}</dd>
        
                            <dt class="col-sm-6">Check-out</dt>
                            <dd class="col-sm-6">{{ $inquiry['checkout_date'] }}</dd>
        
                            <dt class="col-sm-6">Nights</dt>
                            <dd class="col-sm-6">{{ $nights }}</dd>

                            <dt class="col-sm-6">No. of Adults</dt>
                            <dd class="col-sm-6">{{ $inquiry['no_adults'] }}</dd>

                            <dt class="col-sm-6">No. of Kids</dt>
                            <dd class="col-sm-6">{{ $inquiry['no_kids'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-3 mb-3 rounded border-0">
            <div class="card-body">
                <div class="mb-2 row">
                    <div class="h4 pb-2 mb-4 text-black">
                        Billing Details
                        <button type="button" class="btn btn-success btn-sm float-end">
                            <i class="bi bi-plus-circle"></i>
                            Add Service
                        </button>
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Service</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Reservation (Deposit)</td>
                            <td>{{ $inquiry['no_adults']+$inquiry['no_kids'] }} Pack(s) Tent | FB Basis</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                          </tr>
                          <tr>
                            <th scope="row">1</th>
                            <td>Reservation</td>
                            <td>{{ $inquiry['no_adults']+$inquiry['no_kids'] }} Pack(s) Tent | FB Basis</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection

@section('page-scripts')
@endsection
