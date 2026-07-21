<!-- Authentication Modal -->
<div class="modal fade" id="authModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="d-flex align-items-center">
                    <img src="img/verify-account.svg" alt="">

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title">Authenticate Your Account</h5>
                <p class="text-muted">To authorise Sign Up, please enter the verification code shared via email at <strong id="authModalEmail" class="text-dark"></strong>.</p>

                <div class="mb-4">
                    <label class="form-label fw-bold mb-0">Enter Verification Code <span
                            class="text-danger h1 pb-4"><sup>.</sup></span></label>
                    <div class="passcode-inputs">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="12">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="13">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="14">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="15">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="16">
                        <input type="text" class="passcode-digit" maxlength="1" data-index="17">
                    </div>
                </div>

                <div class="text-start mb-3">
                    <a href="#" class="text-dark text-decoration-none">Do not received code? <span class="text-success">Resend</span></a>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-secondary-2" onclick="showVerifiedModal()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Account Verified Modal -->
<div class="modal fade" id="verifiedModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="img/verified-icon.svg" alt="">
                <h5 class="modal-title my-3">Account Verified!</h5>
                <p class="text-muted">Your account has been verified. You’ll be directed to Login Page automatically. If
                    not, Click “Go to Login”</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('login') }}">
                    <button type="button" class="btn btn-primary">Go to Login</button>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCompanyIdentityModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit Company Identity Details</h5>
            </div>
            <div class="modal-body">
                <form id="companyIdentityForm-modal" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Organization Name</label>
                            <input type="text" class="form-control" id="name-modal" name="name" placeholder="Enter Organization Name" required>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Website URL</label>
                            <input type="text" class="form-control" id="website_url-modal" name="website_url" placeholder="Enter Website URL" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">SECP Registeration No.</label>
                            <input type="text" class="form-control" id="secp_registration_number-modal" name="secp_registration_number" placeholder="Enter SECP Registeration No." required>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">PSEB Registeration No.</label>
                            <input type="text" class="form-control" id="pseb_registration_number-modal" name="pseb_registration_number" placeholder="Enter PSEB Registeration No." required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">PASHA Registeration No.</label>
                            <input type="text" class="form-control" id="pasha_registration_number-modal" name="pasha_registration_number" placeholder="Enter PASHA Registeration No." required>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Name of CEO</label>
                            <input type="text" class="form-control" id="ceo_name-modal" name="ceo_name" placeholder="Enter Name of CEO" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Contact of CEO</label>
                            <input type="text" class="form-control" id="ceo_contact-modal" name="ceo_contact" placeholder="Enter Contact of CEO" required>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Email of CEO</label>
                            <input type="email" class="form-control" id="ceo_email-modal" name="ceo_email" placeholder="Enter Email of CEO" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Do you have a registered company in KSA?</label>
                            <select class="form-select text-dark" id="has_ksa_registered_company-modal" name="has_ksa_registered_company" required>
                                <option value="" disabled selected hidden>Select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Name of Saudi Entity</label>
                            <input type="text" class="form-control" id="saudi_entity_name-modal" name="saudi_entity_name" placeholder="Enter Name of Saudi Entity" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Company Representative Name</label>
                            <input type="text" class="form-control" id="representative_name-modal" name="representative_name" placeholder="Enter Company Representative Name" required>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Representative Contact No.</label>
                            <input type="text" class="form-control" id="representative_contact-modal" name="representative_contact" placeholder="Enter Representative Contact No." required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Email of Representative</label>
                            <input type="email" class="form-control" id="representative_email-modal" name="representative_email" placeholder="Enter Email of Representative" required>
                        </div>
                        {{-- <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Comapny Logo</label>
                            <div class="input-group custom-file-group">
                                <button class="btn btn-secondary" type="button" onclick="document.getElementById('formFile-Modal').click()">
                                    Browse...
                                </button>
                                <input type="file" id="formFile-Modal" class="file-input d-none" name="company_logo"
                                    onchange="updateFileNameModal()">
                                <input type="text" id="fileName-Modal" class="form-control"
                                    placeholder="Select Logo" readonly>
                            </div>
                        </div> --}}
                    </div>

                    <div id="step1ErrorsModal" class="mb-3"></div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="updateButtonStep1" class="btn btn-secondary-2" onclick="submitCompanyIdentityModal()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCompanyInformationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit Company Information Details</h5>
            </div>
            <div class="modal-body">
                <form id="companyInformationForm-modal" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">Company Type</label>
                                <select class="form-select text-dark" id="company_type-modal" name="company_type" required>
                                    <option value="" disabled selected hidden>Select an option</option>
                                    <option value="product">Product</option>
                                    <option value="services">Services</option>
                                    <option value="both">Both</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">No. of Years of Experience</label>
                                <input type="number" class="form-control" id="years_of_experience-modal" name="years_of_experience" placeholder="Enter No. of Years of Experience" min="0" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">No. of Staff</label>
                                <input type="text" class="form-control" id="no_of_staff-modal" name="no_of_staff" placeholder="Enter No. of Staff" required>
                            </div>
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">Company Certificate (if any)</label>
                                <select class="form-select text-dark" id="has_company_certificate-modal" name="has_company_certificate" required>
                                    <option value="" disabled selected hidden>Select an option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">Industry Area of Company in KSA</label>
                                <select class="form-select text-dark" id="industry_area-modal" name="industry_area" required>
                                    <option value="" disabled selected hidden>Select an option</option>
                                    @foreach($industryAreas as $industry)
                                        <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">Reference/Existing Clients</label>
                                <input type="text" class="form-control" id="reference-modal" name="reference" placeholder="Enter reference clients">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">No. of Projects</label>
                                <input type="number" class="form-control" id="no_of_projects-modal" name="no_of_projects" placeholder="Enter number of projects" min="0" required>
                            </div>
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">Reference Projects</label>
                                <input type="text" class="form-control" id="reference_project-modal" name="reference_project" placeholder="Enter reference projects">
                            </div>
                        </div>
                    <div id="step2ErrorsModal" class="mb-3"></div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="updateButtonStep2" class="btn btn-secondary-2" onclick="submitCompanyInformationModal()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProductInformationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit Product Information Details</h5>
            </div>
            <div class="modal-body">
                <form id="productInformationForm-modal" enctype="multipart/form-data">
                    <div id="product-fields-container">
                        <div class="row">
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product-name-modal" name="name[]" placeholder="Enter Product Name" required>
                            </div>
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">Product Capabilities</label>
                                <input type="text" class="form-control" id="capabilities-modal" name="capabilities[]" placeholder="Enter Product Capabilities" required>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="text-end mb-4">
                        <button type="button" class="btn btn-primary add-p-btn">+ Add New Product</button>
                    </div> --}}
                    <div id="step3ErrorsModal" class="mb-3"></div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="updateButtonStep3" class="btn btn-secondary-2" onclick="submitProductInformationModal()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editServiceInformationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit Service Information Details</h5>
            </div>
            <div class="modal-body">
                <form id="serviceInformationForm-modal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <div class="dropdown service-domain-dropdown">
                                <label class="form-label">Service Domain</label>
                                <button type="button" class="dropbtn3 btn form-select w-100 text-start"
                                        id="dropdownMenuLink-modal" data-bs-toggle="dropdown" aria-expanded="false"
                                        data-bs-display="static">
                                    Select service domain
                                </button>
                                <div class="dropdown-menu p-3 pb-0 text-nowrap"
                                    aria-labelledby="dropdownMenuLink-modal">
                                    @foreach($serviceDomains as $domain)
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                type="checkbox" 
                                                name="service_domains[]" 
                                                value="{{ $domain->id }}" 
                                                id="service-domains-modal{{ $domain->id }}">
                                            <label class="form-check-label" for="service-domains-modal{{ $domain->id }}">
                                                {{ $domain->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4 position-relative">
                            <div class="dropdown service-domain-dropdown">
                                <label class="form-label">Service Skills Involved</label>
                                <button type="button" class="dropbtn3 btn form-select w-100 text-start"
                                        id="dropdownMenuLink2-modal" data-bs-toggle="dropdown" aria-expanded="false"
                                        data-bs-display="static">
                                    Select skills
                                </button>
                                <div class="dropdown-menu p-3 pb-0 text-nowrap"
                                    aria-labelledby="dropdownMenuLink2-modal">
                                    @foreach($skills as $skill)
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                type="checkbox" 
                                                name="skills[]" 
                                                value="{{ $skill->id }}" 
                                                id="skills-modal{{ $skill->id }}">
                                            <label class="form-check-label" for="skills-modal{{ $skill->id }}">
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
                            <label class="form-label">Any Pre-Implement Methodologies</label>
                            <input type="text" class="form-control" id="ip-implement-modal" name="ip" placeholder="Enter methodologies" required>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Certifications of Staff in Various Domains</label>
                            <input type="text" class="form-control" id="staff-certificate-modal" name="staff_certification" placeholder="Enter certifications" required>
                        </div>
                    </div>
                    <div id="step4ErrorsModal" class="mb-3"></div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="updateButtonStep4" class="btn btn-secondary-2" onclick="submitServiceInformationModal()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>