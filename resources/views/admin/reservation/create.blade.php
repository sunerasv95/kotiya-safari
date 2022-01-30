@extends('layouts.admin-app')
@section('page-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection
{{-- dd($reservations) --}}
@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">New Reservation</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> --}}
        </div>
        {{-- <button type="button" class="btn btn-sm btn-success">
            Create New Reservation
        </button> --}}
    </div>
</div>


@endsection

@section('page-scripts')

@endsection

