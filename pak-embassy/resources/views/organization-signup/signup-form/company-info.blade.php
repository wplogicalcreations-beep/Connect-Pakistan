<div class="step-container d-none" id="step2">
    <div class="row g-3 min-vh-100">
        <!-- Left Panel -->
        <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center">
            <div class="text-center text-white">
                <img src="img/frame-two.png" alt="Business Woman" class="left-image mb-4">
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-7 right-panel d-flex flex-column justify-content-center">
            <div class="form-container">
                <h2 class="form-title mb-4">Business Sign Up</h2>

                <!-- Progress Indicator -->
                @include('organization-signup.signup-form.progress-bar')


                <!-- Form -->
                <form id="companyInfoForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Company Type <span class="text-danger">*</span></label>
                            <select class="form-select text-dark" id="company_type" name="company_type" required>
                                <option value="" disabled selected hidden>Select an option</option>
                                <option value="product">Product</option>
                                <option value="services">Services</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">No. of Years of Experience <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="years_of_experience" name="years_of_experience" placeholder="Enter No. of Years of Experience" min="0" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">No. of Staff <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_of_staff" name="no_of_staff" placeholder="Enter No. of Staff" required>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Company Certificate (if any) <span class="text-danger">*</span></label>
                            <select class="form-select text-dark" id="has_company_certificate" name="has_company_certificate" required>
                                <option value="" disabled selected hidden>Select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Industry Area of Company in KSA <span class="text-danger">*</span></label>
                            <select class="form-select text-dark" id="industry_area" name="industry_area" required>
                                <option value="" disabled selected hidden>Select an option</option>
                                @foreach($industryAreas as $industry)
                                    <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Reference/Existing Clients</label>
                            <input type="text" class="form-control" id="reference" name="reference" placeholder="Enter reference clients">
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">No. of Projects <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="no_of_projects" name="no_of_projects" placeholder="Enter number of projects" min="0" required>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Reference Projects</label>
                            <input type="text" class="form-control" id="reference_project" name="reference_project" placeholder="Enter reference projects">
                        </div>
                    </div>

                    <div id="step2Errors" class="mb-3"></div>
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-secondary btn-lg px-5 me-3"
                                onclick="prevStep(1)">Previous</button>
                        <button type="button" id="nextBtnStep2" class="btn btn-primary btn-lg px-5"
                                onclick="nextStep(3)">Next</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="login-link">Have an Account <span>Login here</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
