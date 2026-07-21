<div class="step-container" id="step1">
    <div class="row g-3 min-vh-100">
        <!-- Left Panel -->
        <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center">
            <div class="text-center text-white">
                <img src="{{asset('img/Frame11.png')}}" alt="Business Meeting" class="img-fluid mb-4">
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-7 right-panel d-flex flex-column justify-content-center">
            <div class="form-container">

                <!-- Progress Indicator -->
                @include('diaspora-signup.signup-form.progress-bar')
                <!-- Form -->
                <form id="form-step1">
                     @csrf
                    <div class="row g-3">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                            <div id="name_error" class="text-danger small"></div>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Passport no. <span class="text-danger">*</span></label>
                            <input type="text" name="passport_no" class="form-control" placeholder="AB1234567" pattern="[A-Z]{2}\d{7}" maxlength="9" style="text-transform: uppercase;" required>
                            <div id="passport_no_error" class="text-danger small"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Iqama ID <span class="text-danger">*</span></label>
                            <input type="text" name="iqama_id" class="form-control" placeholder="Iqama Id" required>
                            <div id="iqama_id_error" class="text-danger small"></div>

                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control" placeholder="Mobile No" required>
                            <div id="phone_error" class="text-danger small"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">Email ID <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                            <div id="email_error" class="text-danger small"></div>
                        </div>
                        <div class="col-md-6 mb-4 position-relative">
                            <label class="form-label">LinkedIn Profile <span class="text-danger">*</span></label>
                            <input type="text" name="linkedin_url" class="form-control" placeholder="Profile Link" required>
                            <div id="linkedin_url_error" class="text-danger small"></div>
                        </div>


                        <div class="col-md-6 mb-4 position-relative">
                            <div class="chose-inputs">
                                <label class="form-label">Profile Photo</label>
                                <div class="input-group custom-file-group">
                                    <button class="btn" type="button"
                                            onclick="document.getElementById('formFile').click()">Browse...</button>
                                    <input type="file" id="formFile" name="image" class="file-input"
                                        onchange="updateFileName()">
                                    <input type="text" id="fileName" class="form-control"
                                        placeholder="Select Photo" readonly>
                                </div>
                                <div id="image_error" class="text-danger small"></div>
                            </div>
                        </div>

                    </div>

                    <div class="text-center mt-4">
                        <button type="button" id="step1NextBtn" class="btn btn-secondary-2 w-100"
                                disabled
                                 onclick="nextStep(1)"
 >Next</button> 
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{'/login'}}" class="login-link">Have an Account <span>Login here</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
