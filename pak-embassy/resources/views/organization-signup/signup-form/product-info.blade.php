<div class="step-container d-none" id="step3">
    <div class="row g-3 min-vh-100">
        <!-- Left Panel -->
        <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center">
            <div class="text-center text-white">
                <img src="img/frame-thre.png" alt="City Skyline" class="left-image mb-4">
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-7 right-panel d-flex flex-column justify-content-center">
            <div class="form-container">
                <h2 class="form-title mb-4">Business Sign Up</h2>

                <!-- Progress Indicator -->
                @include('organization-signup.signup-form.progress-bar')


                <!-- Form -->
                <form id="productInfoForm" enctype="multipart/form-data">
                    <div class="products-container">
                        <div class="row product-row">
                            <div class="col-md-12 d-flex justify-content-end mb-2 remove-btn-container">
            <!-- Remove button will be inserted here dynamically -->
        </div>
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name[]" placeholder="Enter Product Name" required>
                            </div>
                            <div class="col-md-6 mb-4 position-relative">
                                <label class="form-label">Product Capabilities <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="capabilities" name="capabilities[]" placeholder="Enter Product Capabilities" required>
                            </div>
                            
                        </div>
                    </div>

                    <div class="text-end mb-4">
                        <button type="button" class="btn btn-primary add-p-btn">+ Add New Product</button>
                    </div>



                    <div id="step3Errors" class="mb-3"></div>
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-secondary btn-lg px-5 me-3"
                                onclick="prevStep(2)">Previous</button>
                        <button type="button" id="nextBtnStep3" class="btn btn-primary btn-lg px-5"
                                onclick="nextStep(4)">Next</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="login-link">Have an Account <span>Login here</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
