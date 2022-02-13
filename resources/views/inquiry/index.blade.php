@extends('layouts.app')

@section('page-styles')

@endsection

@section('page-content')
<div class="container pt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-5 mt-5">Reservation Request</h1>
            <p class="text-muted">Please fill the following form. We'll get back to you ASAP! </p>
        </div>
    </div>
    <div class="row py-3">
        <div class="col-md-6 offset-md-3">
            @include('partial-views.alerts.alert-danger')
            @include('partial-views.alerts.alert-success')
            <div class="card border-0 shadow round p-2">
                <div class="card-body">
                    <form
                        class="row g-3"
                        id="reservationRequestForm"
                        method="POST"
                        action="{{ route('submit-verify-email') }}"
                    >
                        @csrf
                        <div class="col-md-6">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class=" form-control form-control-lg" id="fname" name="firstName"
                                placeholder="John">
                        </div>
                        <div class="col-md-6">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control form-control-lg" id="lname" name="lastName"
                                placeholder="Doe">
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email"
                                placeholder="example@app.com">
                        </div>
                        <div class="col-6">
                            <label for="checkin" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control form-control-lg" id="checkinDate" name="checkInDate"
                                placeholder="check-in">
                        </div>
                        <div class="col-6">
                            <label for="checkout" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control form-control-lg" id="checkoutDate"
                                name="checkOutDate" placeholder="check-out">
                        </div>
                        <div class="col-md-6">
                            <label for="noAdults" class="form-label">Number of Adults</label>
                            <select id="noAdults" name="noAdults" class="form-select form-select-lg">
                                <option selected value>Choose Number</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="noKids" class="form-label">Number of Kids</label>
                            <select id="noKids" name="noKids" class="form-select form-select-lg">
                                <option selected value>Choose Number</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="country" class="form-label">Country</label>
                            <select id="country" name="country" class="form-select form-select-lg">
                                <option selected value>Choose your country</option>
                                @if (!empty($countries))
                                @foreach ($countries as $country)
                                <option value="{{ $country['abbreviation'] }}">{{ $country['country']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-12">
                            <div id="additionalServices" class="form-text pb-1">We provide some other additional
                                services for
                                reasonable rates.
                                Please select following services if you wish to add in your journey.
                            </div>
                        </div>
                        <div class="col-12" id="valueAddedServiceContainer">
                            <p class="h6"><strong>Value added Services</strong></p>
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
                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" form="reservationRequestForm"
                                id="requestSubmitBtn">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $(function(){
        const today = moment();
        const tomorrow = moment().add(1, "days");

        let todayDate = today.format('YYYY-MM-DD');
        let tomorrowDate  = tomorrow.format('YYYY-MM-DD');

        $("#checkinDate").val(todayDate);
        $("#checkoutDate").val(tomorrowDate);

        $(document).on("change", "input[name=requiredServices]", function(){
            let selectedServicesArr = [];
            let checkedLength = $("input[name='requiredServices']:checked").length;
            console.log("l", checkedLength);
            if(checkedLength > 0){
                $("input[name=serviceRequired]").val(1);
            }else{
                $("input[name=serviceRequired]").val(0);
            }

            $("input[name=requiredServices]:checked").each(function(){
                console.log("itm", $(this));
                selectedServicesArr.push($(this).val());
                $("input[name=selectedServicesArr]").val(JSON.stringify(selectedServicesArr));
                console.log("arr", selectedServicesArr);
            });
        });
    });
</script>
<script>
    $(document).on("click", "#requestSubmitBtn", function(){
        $("#reservationRequestForm").validate({
            rules: {
                firstName: {
                    required: true,
                    minlength: 2
                },
                lastName:{
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                checkInDate: {
                    required: true,
                    date: true
                },
                checkOutDate: {
                    required: true,
                    date: true
                },
                noAdults: {
                    required: true,
                    min: 1,
                    max: 5
                },
                noKids: {
                    required: true,
                    min: 0,
                    max: 5
                },
                country: {
                    required: true
                }
            }
        });
    });
</script>

@endsection
