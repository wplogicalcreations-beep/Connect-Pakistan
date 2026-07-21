<div class="step-container d-none" id="step4">
    <div class="preview-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Company Identity Section -->
                    <div class="preview-section mb-4">
                        <h2 class="form-title text-center">Preview Business Details</h2>

                        <!-- Personal Info -->
                        <div class="section-header">
                            <h5 class="section-title">1. Personal Information</h5>
                            <div class="section-actions">
                                <i class="fas fa-edit text-success" onclick="showPersonalInfoModal()"></i>
                            </div>
                        </div>
                        <div class="section-content">
                            <div class="row g-lg-4 row g-3">
                                <div class="col-md-6 mb-2">
                                    <div class="preview-common-design">
                                        <span>Full Name</span>
                                        <strong data-field="name"></strong>
                                    </div>
                                    <div class="preview-common-design">
                                        <span>Iqama ID</span>
                                        <strong data-field="iqama_id"></strong>
                                    </div>
                                    <div class="preview-common-design">
                                        <span>Email</span>
                                        <strong data-field="email"></strong>
                                    </div>
                                    <div class="preview-common-design">
                                        <span>CEO’s Contact No.</span>
                                        <strong data-field="phone"></strong>
                                    </div>
                                    <div class="preview-common-design">
                                        <span>Profile Photo</span>
                                        <img data-field="profile_photo" src="img/placeholder.png" alt="">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <div class="preview-common-design">
                                        <span>Passport No.</span>
                                        <strong data-field="passport_no"></strong>
                                    </div>
                                    <div class="preview-common-design">
                                        <span>Mobile No.</span>
                                        <strong data-field="mobile_no"></strong>
                                    </div>
                                    <div class="preview-common-design">
                                        <span>LinkedIn Profile</span>
                                        <strong data-field="linkedin_url"></strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Employment Info -->
                            <div class="section-header">
                                <h5 class="section-title">2. Employment Information</h5>
                                <div class="section-actions">
                                    <i class="fas fa-edit text-success" onclick="showEmploymentInfoModal()"></i>
                                </div>
                            </div>
                            <div class="row g-lg-4 row g-3">
                                <div class="col-md-6 mb-2">
                                    <div class="preview-common-design">
                                        <span>Level</span>
                                        <strong data-field="level"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="preview-common-design">
                                        <span>Influence Ability</span>
                                        <strong data-field="influence"></strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Employment Area -->
                            <div class="section-header">
                                <h5 class="section-title">3. Employment Area</h5>
                                <div class="section-actions">
                                    <i class="fas fa-edit text-success" onclick="showEmploymentAreaInfoModal()"></i>
                                </div>
                            </div>
                            <div class="row g-lg-4 row g-3">
                                <div class="col-md-6 mb-2">
                                    <div class="preview-common-design">
                                        <span>Employment Industry</span>
                                        <strong data-field="industry"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="preview-common-design">
                                        <span>Work Domain</span>
                                        <strong data-field="work_domain"></strong>
                                    </div>
                                </div>
                            </div>

                            {{-- Dynamic Skills Section --}}
                            <div class="row g-lg-4 row g-3" id="skills-preview">
                                {{-- Skills will be appended here dynamically --}}
                            </div>

                            <!-- Actions -->
                            <div class="text-center mt-5">
                                <button type="button" class="btn btn-primary w-100" onclick="goToNextStep(4)">
                                    Proceed
                                </button>
                            </div>
                            <div class="text-center mt-4">
                                <a href="{{'/login'}}" class="login-link">Have an Account <span>Login here</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
