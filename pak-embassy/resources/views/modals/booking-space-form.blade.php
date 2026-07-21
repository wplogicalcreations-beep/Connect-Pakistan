<div class="modal fade" id="stepModal" tabindex="-1" aria-labelledby="stepModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Get Quote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center mb-5 pb-5">
                <!-- Step Indicator -->
                <div class="stepper d-flex justify-content-between align-items-center mb-4 pb-4">
                    <div class="step" data-step="1">01</div>
                    <div class="line"></div>
                    <div class="step" data-step="2">02</div>
                    <div class="line"></div>
                    <div class="step" data-step="3">03</div>
                    <div class="line"></div>
                    <div class="step" data-step="4">04</div>
                </div>

                <!-- Step Contents -->
                <!-- In your modal form -->
                <form id="multiStepForm" method="POST" action="{{ route('user.co-work-space.booking') }}">
                    @csrf
                    <input type="hidden" name="coworking_space_id" value="{{ $space->id }}">

                    <!-- Step 1 -->
                    <div class="step-content active" data-step="1">
                        <h5 class="fw-bold">How many people in your office?</h5>
                        <div class="d-flex gap-2 mb-2 flex-wrap justify-content-center">
                            <input type="radio" class="btn-check" name="people_count" value="1" id="people1" autocomplete="off" required>
                            <label class="btn btn-outline-success" for="people1">1</label>

                            <input type="radio" class="btn-check" name="people_count" value="2" id="people2" autocomplete="off">
                            <label class="btn btn-outline-success" for="people2">2</label>

                            <input type="radio" class="btn-check" name="people_count" value="3-4" id="people3" autocomplete="off">
                            <label class="btn btn-outline-success" for="people3">3–4</label>

                            <input type="radio" class="btn-check" name="people_count" value="5-9" id="people4" autocomplete="off">
                            <label class="btn btn-outline-success" for="people4">5–9</label>
                        </div>

                        <!-- Row 2 -->
                        <div class="d-flex gap-2 flex-wrap justify-content-center">
                            <input type="radio" class="btn-check" name="people_count" value="10-19" id="people5" autocomplete="off">
                            <label class="btn btn-outline-success" for="people5">10–19</label>

                            <input type="radio" class="btn-check" name="people_count" value="20-49" id="people6" autocomplete="off">
                            <label class="btn btn-outline-success" for="people6">20–49</label>

                            <input type="radio" class="btn-check" name="people_count" value="50-99" id="people7" autocomplete="off">
                            <label class="btn btn-outline-success" for="people7">50–99</label>

                            <input type="radio" class="btn-check" name="people_count" value="100+" id="people8" autocomplete="off">
                            <label class="btn btn-outline-success" for="people8">100+</label>
                        </div>
                        <div class="text-danger small mt-2" id="people_count_error"></div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-content" data-step="2">
                        <h5 class="fw-bold">What are you looking for?</h5>
                        <div class="row g-2 justify-content-center">
                            @if($space->space_type == 'Hot Desk')
                            <div class="col-6 col-md-4 col-lg-3 d-flex align-items-start position-relative">
                                <input type="radio" name="space_type" value="hot_desk" id="coworkspace" class="form-check-input me-2 posi-abs" required>
                                <label for="hotdesk" class="selectable-image mb-0">
                                    <img src="{{ asset('user-dash-img/step-image.png')}}" class="img-fluid" alt="Co-WorkSpace">
                                    <div class="caption">Hot Desk</div>
                                </label>
                            </div>
                            @elseif($space->space_type == 'Dedicated Desk')
                            <div class="col-6 col-md-4 col-lg-3 d-flex align-items-start position-relative">
                                <input type="radio" name="space_type" value="dedicated_desk" id="privateoffice" class="form-check-input me-2 posi-abs">
                                <label for="dedicateddesk" class="selectable-image mb-0">
                                    <img src="{{ asset('user-dash-img/step-image.png')}}" class="img-fluid" alt="Private Office">
                                    <div class="caption">Dedicated Desk</div>
                                </label>
                            </div>
                            @elseif($space->space_type == 'Meeting Room')
                            <div class="col-6 col-md-4 col-lg-3 d-flex align-items-start position-relative">
                                <input type="radio" name="space_type" value="meeting_room" id="meetingroom" class="form-check-input me-2 posi-abs">
                                <label for="meetingroom" class="selectable-image mb-0">
                                    <img src="{{ asset('user-dash-img/step-image.png')}}" class="img-fluid" alt="Meeting Room">
                                    <div class="caption">Meeting Room</div>
                                </label>
                            </div>
                            @else
                            <div class="col-6 col-md-4 col-lg-3 d-flex align-items-start position-relative">
                                <input type="radio" name="space_type" value="hot_desk" id="coworkspace" class="form-check-input me-2 posi-abs" required>
                                <label for="hotdesk" class="selectable-image mb-0">
                                    <img src="{{ asset('user-dash-img/step-image.png')}}" class="img-fluid" alt="Co-WorkSpace">
                                    <div class="caption">Hot Desk</div>
                                </label>
                            </div>
                            <div class="col-6 col-md-4 col-lg-3 d-flex align-items-start position-relative">
                                <input type="radio" name="space_type" value="dedicated_desk" id="privateoffice" class="form-check-input me-2 posi-abs">
                                <label for="dedicateddesk" class="selectable-image mb-0">
                                    <img src="{{ asset('user-dash-img/step-image.png')}}" class="img-fluid" alt="Private Office">
                                    <div class="caption">Dedicated Desk</div>
                                </label>
                            </div>
                            <div class="col-6 col-md-4 col-lg-3 d-flex align-items-start position-relative">
                                <input type="radio" name="space_type" value="meeting_room" id="meetingroom" class="form-check-input me-2 posi-abs">
                                <label for="meetingroom" class="selectable-image mb-0">
                                    <img src="{{ asset('user-dash-img/step-image.png')}}" class="img-fluid" alt="Meeting Room">
                                    <div class="caption">Meeting Room</div>
                                </label>
                            </div>
                            @endif

                        </div>
                        <div class="text-danger small mt-2" id="space_type_error"></div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-content" data-step="3">
                        <h5 class="fw-bold">How long do you need it for?</h5>
                        <div class="radio-box-group">
                            <input type="radio" id="duration1" name="duration" value="0-3" required>
                            <label for="duration1" class="radio-box">0–3 months</label>

                            <input type="radio" id="duration2" name="duration" value="3-6">
                            <label for="duration2" class="radio-box">3–6 months</label>

                            <input type="radio" id="duration3" name="duration" value="6-12">
                            <label for="duration3" class="radio-box">6–12 months</label>

                            <input type="radio" id="duration4" name="duration" value="12+">
                            <label for="duration4" class="radio-box">12+ months</label>
                        </div>
                        <div class="text-danger small mt-2" id="duration_error"></div>
                    </div>

                    <!-- Step 4 -->
                    <div class="step-content" data-step="4">
                        <h5 class="fw-bold">Please enter your details so we can reach you:</h5>
                        <div class="row g-3 mx-5">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value ="{{auth()->user()->first_name}}" id="firstName" name="first_name" placeholder="First Name" required>
                                    <label class="ps-1" for="firstName">First Name</label>
                                </div>
                                <div class="text-danger small mt-1 text-start" id="firstName_error"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lastName" value ="{{auth()->user()->last_name}}" name="last_name" placeholder="Last Name" required>
                                    <label class="ps-1" for="lastName">Last Name</label>
                                </div>
                                <div class="text-danger small mt-1 text-start" id="lastName_error"></div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" id="phone_number" name="phone_number" value = "{{auth()->user()->phone}}" class="form-control" placeholder="9665XXXXXXXX" maxlength="12" required>
                                    <label for="phone_number" class="for-phone">Phone Number</label>
                                </div>
                                <div class="text-danger small mt-1 text-start" id="phone_number_error"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" value="{{auth()->user()->email}}" name="email" placeholder="Email" required>
                                    <label class="ps-1" for="email">Email</label>
                                </div>
                                <div class="text-danger small mt-1 text-start" id="email_error"></div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="startDate" name="estimated_start_date" placeholder="Estimated Start Date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                    <label class="ps-1" for="startDate">Estimated Start Date</label>
                                </div>
                                <div class="text-danger small mt-1 text-start" id="startDate_error"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="company" name="company_name" placeholder="Company Name (Optional)">
                                    <label class="ps-1" for="company">Company Name (Optional)</label>
                                </div>
                                <div class="text-danger small mt-1 text-start" id="company_error"></div>
                            </div>
                        </div>

                        <div class="form-check mt-4 mx-5">
                            <input class="form-check-input" type="checkbox" id="termsCheck" name="terms" required>
                            <label class="form-check-label small text-muted" for="termsCheck">
                                By submitting your application and subscribing to our services, you agree to our
                                Terms of Service.
                            </label>
                            <div class="text-danger small mt-1" id="termsCheck_error"></div>
                        </div>
                    </div>

                    <!-- Step 5 (Success message) -->
                    <div class="step-content" data-step="5">
                        <h5 class="fw-bold">Co-WorkSpace Enquiry</h5>
                        <div class="finish-tick-mark mx-auto my-3"></div>
                        <p>Your co-workspace enquiry has been submitted!</p>
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="bg-light px-3 py-3 text-start rounded">
                                    <p><img class="pe-1" src="{{ asset('user-dash-img/uil_calender.svg')}}" alt="Image"> <span id="summaryDate"></span></p>
                                    <p><img class="pe-1" src="{{ asset('user-dash-img/step-icon.svg')}}" alt="image"><span id="summarySpaceType"></span></p>
                                    <p><img class="pe-1" src="{{ asset('user-dash-img/step-icon-2.svg')}}" alt="image"><span id="summaryPeople"></span></p>
                                    <p><img class="pe-1" src="{{ asset('user-dash-img/event-time.svg')}}" alt="Image"><span id="summaryDuration"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-success rounded" id="prevBtn" disabled>Go Back</button>
                <button type="button" class="btn btn-success rounded" id="nextBtn">Continue</button>
            </div>
        </div>
    </div>
</div>