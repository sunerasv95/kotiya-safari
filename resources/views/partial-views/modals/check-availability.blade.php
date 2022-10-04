<!-- Modal -->
<div class="modal fade" id="checkAvailabilityModal" tabindex="-1" aria-labelledby="checkAvailabilityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h1 class="modal-title fs-5" id="checkAvailabilityModalLabel">Check Availability</h1> --}}
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column align-items-start px-3 py-1">
                        <img class="mb-3" src="{{ asset('dist/images/logo-full.svg') }}" alt="">
    
                        <h2 class="text--dark-green fw--bold fs--large mb-2 my-3">Your booking is on this way!</h2>
    
                        <div class="d-flex flex-column p-2 my-2">
                            <div class="d-flex justify-content-start align-items-start">
                                <img class="pt-2" src="{{ asset('dist/images/icons/note-black-ic.svg') }}" alt="inquiry-request-icon"
                                    width="48">
                                <div class="sec-block px-3">
                                    <h4 class="text-dark fw--800 fs--regular">Booking Request</h4>
                                    <p class="text-dark fw-lighter fs--small">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has
                                        been the industry's standard</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start align-items-start">
                                <img class="pt-2" src="{{ asset('dist/images/icons/calender-black-ic.svg') }}" alt="inquiry-request-icon"
                                    width="48">
                                <div class="sec-block px-3">
                                    <h4 class="text-dark fw--800 fs--regular">Check Avaialablity</h4>
                                    <p class="text-dark fw-lighter fs--small">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has
                                        been the industry's standard</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start align-items-start">
                                <img class="pt-2" src="{{ asset('dist/images/icons/happy-face-black-ic.svg') }}" alt="inquiry-request-icon"
                                    width="48">
                                <div class="sec-block px-3">
                                    <h4 class="text-dark fw--800 fs--regular">Booking Confirmed</h4>
                                    <p class="text-dark fw-lighter fs--small">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has
                                        been the industry's standard</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vr" style="height: 600px;"></div>
                </div>
            </div>
            <div class="col-md-8">
                @include('partial-views.forms.check-availability')
            </div>
          </div>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>