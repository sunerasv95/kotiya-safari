@extends('layouts.admin-app')
@section('page-styles')

@endsection

@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Add New Role</h1>
</div>
<div class="row">
    <div class="col-md-12">
        @include('partial-views.alerts.alert-danger')
        @include('partial-views.alerts.alert-success')
    </div>
</div>
<div class="container m-0 p-0">
    <div class="row">
        <div class="col-md-4">
            <form class="row g-3" id="roleCreateForm" method="POST"
                action="{{ route('admin.roles.create.submit') }}">
                @csrf
               
                <div class="col-md-12">
                    <label for="fname" class="form-label">Role Name</label>
                    <input type="text" class=" form-control" id="role-name" name="role_name"
                        placeholder="Ex: Super Administrator">
                </div>
                <div class="col-md-6">
                    <label for="active" class="form-label">Select Role Status</label>
                    <select id="active" name="active" class="form-select">
                        <option selected value>Select Role Status</option>
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="country" class="form-label">Country</label>
                    <select id="country" name="country" class="form-select">
                        <option selected value>Choose your country</option>
                        @if (!empty($countries))
                        @foreach ($countries as $country)
                        <option value="{{ $country['abbreviation'] }}">{{ $country['country']}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-12" id="role-permisssions">
                    <p class="h6"><strong>Permissions</strong></p>
                    @if (!empty($vas))
                    @foreach ($vas as $k => $item)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="{{ $item['service_code']." _".$k }}"
                            name="requiredServices" value="{{ $item['service_code'] }}"
                            aria-describedby="additionalServices">
                        <label class="form-check-label" for="{{ $item['service_code']." _".$k }}">
                            {{ $item['service_name'] }}
                        </label>
                    </div>
                    @endforeach
                    @endif
                </div>
                <input type="hidden" name="serviceRequired" value="0">
                <input type="hidden" name="selectedServicesArr" value="">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg mt-3" form="inquiryCreateForm"
                        id="inquiryCreateBtn">Create Inquiry
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    // $(function(){
    //     const today = moment();
    //     const tomorrow = moment().add(1, "days");

    //     let todayDate = today.format('YYYY-MM-DD');
    //     let tomorrowDate  = tomorrow.format('YYYY-MM-DD');

    //     $("#checkinDate").val(todayDate);
    //     $("#checkoutDate").val(tomorrowDate);

    //     $(document).on("change", "input[name=requiredServices]", function(){
    //         let selectedServicesArr = [];
    //         let checkedLength = $("input[name='requiredServices']:checked").length;
    //         console.log("l", checkedLength);
    //         if(checkedLength > 0){
    //             $("input[name=serviceRequired]").val(1);
    //         }else{
    //             $("input[name=serviceRequired]").val(0);
    //         }

    //         $("input[name=requiredServices]:checked").each(function(){
    //             console.log("itm", $(this));
    //             selectedServicesArr.push($(this).val());
    //             $("input[name=selectedServicesArr]").val(JSON.stringify(selectedServicesArr));
    //             console.log("arr", selectedServicesArr);
    //         });
    //     });
    // });
</script>
<script>
    // $(document).on("click", "#inquiryCreateBtn", function(){
    //     $("#inquiryCreateForm").validate({
    //         rules: {
    //             firstName: {
    //                 required: true,
    //                 minlength: 2
    //             },
    //             lastName:{
    //                 required: true,
    //                 minlength: 2
    //             },
    //             email: {
    //                 required: true,
    //                 email: true
    //             },
    //             checkInDate: {
    //                 required: true,
    //                 date: true
    //             },
    //             checkOutDate: {
    //                 required: true,
    //                 date: true
    //             },
    //             noAdults: {
    //                 required: true,
    //                 min: 1,
    //                 max: 5
    //             },
    //             noKids: {
    //                 required: true,
    //                 min: 0,
    //                 max: 5
    //             },
    //             country: {
    //                 required: true
    //             }
    //         }
    //     });
    // });
</script>
@endsection
