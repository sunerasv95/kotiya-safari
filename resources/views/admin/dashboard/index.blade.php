@extends('layouts.admin-app')

@section('page-title', "Dashboard")

@section('page-styles')
@endsection

@section('main-content')
<<<<<<< HEAD
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3">
    <h1 class="h2">Dashboard</h1>
</div>
<section>
        <div class="row py-3">
            <div class="col-md-12 d-flex justify-content-between flex-wrap">
                <div class="card text-light bg-primary bg-gradient mb-3 mx-1 shadow p-1 rounded" style="min-width: 16rem;">
                    <div class="card-body d-flex justify-content-between">
                      <div class="flex-column align-items-center">
                        <h4 class="card-title pb-2">Inquiries</i></h4>
                        <h4>{{ $cardCounts['data']['inquiryCount'] }}</h4>
                      </div>
                      <i class="bi-lg bi-arrow-down-circle-fill align-self-center"></i>
=======
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
>>>>>>> c56bc2f339cdd0d73b8d0362c4ec093e75af0a4c
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
