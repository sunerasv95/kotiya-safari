<form
                        class="row g-3"
                        id="reservationRequestForm"
                        method="POST"
                        action="{{ route('guest.inquiries.request.submit') }}"
                    >
                        @csrf
                        <div class="col-md-6">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class=" form-control" id="fname" name="firstName"
                                placeholder="John">
                        </div>
                        <div class="col-md-6">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lastName"
                                placeholder="Doe">
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="example@app.com">
                        </div>
                        <div class="col-6">
                            <label for="checkin" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control" id="checkinDate" name="checkInDate"
                                placeholder="check-in">
                        </div>
                        <div class="col-6">
                            <label for="checkout" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control" id="checkoutDate"
                                name="checkOutDate" placeholder="check-out">
                        </div>
                        <div class="col-md-6">
                            <label for="noAdults" class="form-label">Number of Adults</label>
                            <select id="noAdults" name="noAdults" class="form-select">
                                <option selected value>Choose Number</option>
                                @for ($i=1;$i <= 10; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="noKids" class="form-label">Number of Kids</label>
                            <select id="noKids" name="noKids" class="form-select">
                                <option selected value>Choose Number</option>
                                @for ($i=1;$i <= 10; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
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
                        <div class="col-12">
                            <div id="additionalServices" class="form-text pb-1">
                                <small>We provide some other additional services for reasonable rates.
                                    Please select following services if you wish to add in your journey.
                                </small>
                            </div>
                        </div>
                        <div class="col-12" id="valueAddedServiceContainer">
                            <p class="h6"><strong>Value added Services</strong></p>
                            <div class="d-flex justify-content-start">
                                @if (!empty($vas))
                                @foreach ($vas as $k => $item)
                                <div class="form-check me-3">
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
                        </div>
                        <input type="hidden" name="serviceRequired" value="0">
                        <input type="hidden" name="selectedServicesArr" value="">
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn bg--baige text-white btn-lg btn-block" form="reservationRequestForm"
                                id="requestSubmitBtn">Submit Inquiry</button>
                        </div>
                    </form>