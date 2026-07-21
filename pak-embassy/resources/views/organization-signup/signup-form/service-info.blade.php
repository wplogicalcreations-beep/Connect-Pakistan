<div class="step-container d-none" id="step4">
    <div class="row g-3 min-vh-100">
        <!-- Left Panel -->
        <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center">
            <div class="text-center text-white">
                <img src="img/frame-four.png" alt="Middle Eastern Architecture" class="left-image mb-4">
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-7 right-panel d-flex flex-column justify-content-center">
            <div class="form-container">
                <h2 class="form-title mb-4">Business Sign Up</h2>

                <!-- Progress Indicator -->
                @include('organization-signup.signup-form.progress-bar')


                <!-- Form -->
                <form id="serviceInfoForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <div class="dropdown service-domain-dropdown">
                                <label class="form-label">Service Domain <span class="text-danger">*</span></label>


                                <button type="button" class="dropbtn3 btn form-select w-100 text-start"
                                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"
                                        data-bs-display="static">
                                    Select service domain
                                </button>
                                <div class="dropdown-menu p-3 pb-0 text-nowrap"
                                     aria-labelledby="dropdownMenuLink">
                                    @foreach($serviceDomains as $domain)
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                type="checkbox" 
                                                name="service_domains[]" 
                                                value="{{ $domain->id }}" 
                                                id="serviceDomain{{ $domain->id }}">
                                            <label class="form-check-label" for="serviceDomain{{ $domain->id }}">
                                                {{ $domain->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 mb-4 position-relative">


                            <div class="dropdown service-domain-dropdown">
                                <label class="form-label">Service Skills Involved <span class="text-danger">*</span></label>


                                <button type="button" class="dropbtn3 btn form-select w-100 text-start"
                                        id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false"
                                        data-bs-display="static">
                                    Select skills
                                </button>
                                <div class="dropdown-menu p-3 pb-0 text-nowrap"
                                     aria-labelledby="dropdownMenuLink">
                                    @foreach($skills as $skill)
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                type="checkbox" 
                                                name="skills[]" 
                                                value="{{ $skill->id }}" 
                                                id="serviceDomain{{ $skill->id }}">
                                            <label class="form-check-label" for="skill{{ $skill->id }}">
                                                {{ $skill->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Any Pre-Implement Methodologies <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ip" name="ip" placeholder="Enter methodologies" required>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Certifications of Staff in Various Domains <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="staff_certification" name="staff_certification" placeholder="Enter certifications" required>
                        </div>
                    </div>

                    <div id="step4Errors" class="mb-3"></div>
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-secondary btn-lg px-5 me-3"
                                onclick="prevStep(3)">Previous
                        </button>
                        <button type="button" id="nextBtnStep4" class="btn btn-primary btn-lg px-5"
                                onclick="nextStep(5)">Next
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="login-link">Have an Account <span>Login here</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
