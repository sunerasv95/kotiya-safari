<form role="form" class="row py-1" id="reservationRequestForm" method="POST"
    action="{{ route('guest.inquiries.request.submit') }}">
    @csrf
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="full-name" class="form-label">
                    Full Name
                </label>
                <input type="text" class=" form-control" id="full-name" name="full_name"
                    placeholder="Enter your full name">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
           <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email"
                placeholder="Enter your email">
           </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
           <div class="form-group">
            <label for="check-in" class="form-label">Date of Arrival</label>
            <input type="date" class="form-control" id="check-in" name="check_in" placeholder="check-in">
           </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="check-out" class="form-label">Date of Departure</label>
            <input type="date" class="form-control" id="check-out" name="check_out" placeholder="check-out">
            </div>
        </div>
        <div class="col-12 pt-2">
            <div class="form-group">
                <input type="checkbox" class="form-check-input" id="flexible-dates" name="flexible_dates">
            <label class="form-check-label" for="flexible-dates" >Also I'm flexible with
                dates</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
           <div class="form-group">
            <label for="no-adults" class="form-label">Number of Adults</label>
            <select id="no-adults" name="no_adults" class="form-select">
                <option value selected>Choose a number</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
           </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="no-kids" class="form-label">Number of Kids</label>
            <select id="no-kids" name="no_kids" class="form-select">
                <option value selected>Choose a number</option>
                @for ($i = 0; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            </div>
        </div>
    </div>
    {{-- <div class="row mb-3">
        <div class="col-md-12">
            <label for="country" class="form-label">Package</label>
            <select id="country" name="country" class="form-select">
                <option selected value>Choose your package</option>
                <option value="1">Package 1</option>
                <option value="2">Package 2</option>
                <option value="3">Package 3</option>
            </select>
        </div>
    </div> --}}
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="country" class="form-label">Country</label>
            <select id="country" name="country" class="form-select">
                <option selected value>Choose your country</option>
                @if (!empty($countries))
                    @foreach ($countries as $country)
                        <option value="{{ $country['abbreviation'] }}">{{ $country['country'] }}</option>
                    @endforeach
                @endif
            </select>
            </div>
        </div>
    </div>
    {{-- <div class="row mb-2">
        <p class="my-2">Please select following additional services if you wish to add in your journey.</p>
        <div class="col-12 d-flex">
            <div class="col">
                <input class="form-check-input" type="checkbox" id="1"
                    name="requiredServices" value="1" aria-describedby="additionalServices">
                <label class="form-check-label" for="1">
                    Wild Life Photograpghy
                </label>
            </div>
            <div class="col">
                <input class="form-check-input" type="checkbox" id="1"
                    name="requiredServices" value="1" aria-describedby="additionalServices">
                <label class="form-check-label" for="1">
                    Wild Life Photograpghy
                </label>
            </div>
            <div class="col">
                <input class="form-check-input" type="checkbox" id="1"
                    name="requiredServices" value="1" aria-describedby="additionalServices">
                <label class="form-check-label" for="1">
                    Wild Life Photograpghy
                </label>
            </div>
        </div>
    </div> --}}
    {{-- <div class="row mb-3">
        <div class="col-12">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">I agreed to
                <a href="{{ route('guest.terms-conditions', ['id' => 1]) }}">Terms & Condtions</a>
            </label>
        </div>
    </div> --}}
    <div class="row mb-2">
        <div class="d-flex mt-4">
           <div class="form-group">
            <input type="checkbox" class="form-check-input" id="tc-agreed" name="tc_agreed">
            <label class="form-check-label px-1" for="tc-agreed">I agreed to
                <a href="{{ route('guest.terms-conditions', ['id' => 1]) }}">Terms & Condtions</a>
            </label>
           </div>
        </div>
        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-cs-baige btn-lg btn-block" form="reservationRequestForm"
                id="inquiry-submit">Submit Inquiry
            </button>
        </div>
    </div>
</form>
