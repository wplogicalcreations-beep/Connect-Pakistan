<div class="step-container" id="step1">
    <div class="row g-3 min-vh-100">
        <!-- Left Panel -->
        <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center">
            <div class="text-center text-white">
                <img src="img/frame-onea.png" alt="Business Meeting" class="img-fluid mb-4">
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-7 right-panel d-flex flex-column justify-content-center">
            <div class="form-container">
                <h2 class="form-title mb-4">Business Sign Up</h2>

                <!-- Progress Indicator -->
                @include('organization-signup.signup-form.progress-bar')

                <!-- Form -->
                <form id="companyIdentityForm" enctype="multipart/form-data">
                    <input type="hidden" id="organization_id" name="organization_id" value="">
                    <input type="hidden" id="organization_type" name="organization_type" value="PAK">
                    <div class="row">
                        <!-- Organization Type -->
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Organization Type <span class="text-danger">*</span></label>
                            <select class="form-select text-dark" id="organization_type_select" required>
                                <option value="PAK" selected>Pakistani Company</option>
                                <option value="KSA">Saudi (KSA) Company</option>
                            </select>
                        </div>
                        <!-- Company Logo -->
                        <div class="col-md-6 mb-4 position-relative">
                            <div class="chose-inputs">
                                <label class="form-label">Company Logo <span class="text-danger company-logo-required">*</span> <span class="text-muted company-logo-optional d-none">(Optional)</span></label>
                                <div class="input-group custom-file-group">
                                    <button class="btn" type="button"
                                            onclick="document.getElementById('formFile').click()">Browse File</button>
                                    <input type="file" id="formFile" class="file-input" id="company_logo" name="company_logo"
                                            onchange="updateFileName()" required>
                                    <input type="text" id="fileName" class="form-control"
                                            placeholder="Select Logo" readonly>
                                </div>
                                <div id="company_logo_error" class="text-danger small mt-1"></div>
                            </div>
                        </div>
                        <!-- Organization Name -->
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Organization Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Organization Name" required>
                            <div id="name_error" class="text-danger small mt-1" style="display: none;"></div>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Website URL <span class="text-danger website-required">*</span> <span class="text-muted website-optional d-none">(Optional)</span></label>
                            <input type="text" class="form-control" id="website_url" name="website_url" placeholder="Enter Website URL" required>
                            <div id="website_url_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- SECP Registeration No. -->
                        <div class="col-md-6 mb-4 position-relative org-pak-only">
                            <label class="form-label">SECP Registeration No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="secp_registration_number" name="secp_registration_number" placeholder="Enter SECP Registeration No." required>
                            <div id="secp_registration_number_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- PSEB Registeration No. -->
                        <div class="col-md-6 mb-4 position-relative org-pak-only">
                            <label class="form-label">PSEB Registeration No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="pseb_registration_number" name="pseb_registration_number" placeholder="Enter PSEB Registeration No." required>
                            <div id="pseb_registration_number_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- PASHA Registeration No. -->
                        <div class="col-md-6 mb-4 position-relative org-pak-only">
                            <label class="form-label">PASHA Registeration No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="pasha_registration_number" name="pasha_registration_number" placeholder="Enter PASHA Registeration No." required>
                            <div id="pasha_registration_number_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- Name of CEO -->
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Name of CEO <span class="text-danger ceo-name-required">*</span> <span class="text-muted ceo-name-optional d-none">(Optional)</span></label>
                            <input type="text" class="form-control" id="ceo_name" name="ceo_name" placeholder="Enter Name of CEO" required>
                            <div id="ceo_name_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- Contact of CEO -->
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Contact of CEO <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ceo_contact" name="ceo_contact" placeholder="Enter Contact of CEO (e.g., 966512345678)" required>
                            <div id="ceo_contact_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- Email of CEO -->
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Email of CEO <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="ceo_email" name="ceo_email" placeholder="Enter Email of CEO" required>
                            <div id="ceo_email_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- Do you have a registered company in KSA? -->
                        <div class="col-md-6 mb-4 position-relative org-pak-only">
                            <label class="form-label">Do you have a registered company in KSA? <span class="text-danger">*</span></label>
                            <select class="form-select text-dark" id="has_ksa_registered_company" name="has_ksa_registered_company" required>
                                <option value="" disabled selected hidden>Select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <div id="has_ksa_registered_company_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- Name of Saudi Entity -->
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Name of Saudi Entity <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="saudi_entity_name" name="saudi_entity_name" placeholder="Enter Name of Saudi Entity" required>
                            <div id="saudi_entity_name_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- Company Representative Name -->
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Company Representative Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="representative_name" name="representative_name" placeholder="Enter Company Representative Name" required>
                            <div id="representative_name_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- Representative Contact No. -->
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Representative Contact No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="representative_contact" name="representative_contact" placeholder="Enter Representative Contact No. (e.g., 966512345678)" required>
                            <div id="representative_contact_error" class="text-danger small mt-1"></div>
                        </div>
                        <!-- Email of Representative -->
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Email of Representative <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="representative_email" name="representative_email" placeholder="Enter Email of Representative" required>
                            <div id="representative_email_error" class="text-danger small mt-1"></div>
                        </div>
                    </div>
                    <div id="step1Errors" class="mb-3"></div>
                    <div class="text-center mt-4">
                        <button type="button" id="nextBtnStep1" class="btn btn-secondary-2 w-100"
                                onclick="nextStep(2)">Next</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="login-link">Have an Account <span>Login here</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
