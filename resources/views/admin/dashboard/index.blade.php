@extends('layouts.admin-app')

@section('page-title', "Dashboard")

@section('page-styles')
@endsection

@section('main-content')
    <div>
        <x-admin-page-header>
            <x-slot name="actions"></x-slot>
        </x-admin-page-header>
        
        <div class="row">
            <div class="col-md-3">
                <div class="card text-light bg-gradient mb-3 mx-1 shadow rounded border-0" style="min-width: 16rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="card-title text-black pb-2 fs--regular fw--700">Inquiries</i></p>
                            <i class="bi bi-file-arrow-down text-black fs--large"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-start pt-2">
                            <p class="text-black">Pending</p>
                            <span class="text-black">100</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-light bg-gradient mb-3 mx-1 shadow rounded border-0" style="min-width: 16rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="card-title text-black pb-2 fs--regular fw--700">Reservations</i></p>
                            <i class="bi bi-bookmark-heart text-black fs--large"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-start pt-2">
                            <p class="text-black">In-progress</p>
                            <span class="text-black">02</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-light bg-gradient mb-3 mx-1 shadow rounded border-0" style="min-width: 16rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="card-title text-black pb-2 fs--regular fw--700">Payments</i></p>
                            <i class="bi bi-cash-coin text-black fs--large"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-start pt-2">
                            <p class="text-black">Received</p>
                            <span class="text-black">02</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
              <div class="card text-light bg-gradient mb-3 mx-1 shadow rounded border-0" style="min-width: 16rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="card-title text-black pb-2 fs--regular fw--700">Feedback & Reports</i></p>
                        <i class="bi bi-megaphone text-black fs--large"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-start pt-2">
                        <p class="text-black">Pending</p>
                        <span class="text-black">100</span>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
  
@endsection
