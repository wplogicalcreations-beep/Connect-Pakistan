<div class="step-container d-none" id="step5">
    <div class="row min-vh-100">
        <!-- Left Panel -->
        <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center">
            <div class="text-center text-white">
                <img src="img/frame-five.png" alt="Smartphone" class="left-image mb-4">
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-5 right-panel d-flex flex-column justify-content-center">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="form-container form-container-custom">
                        <h2 class="form-title mb-4">Setup Passcode</h2>

                        <!-- Form -->
                        <form id="passcodeForm" class="passcodeForm">
                            <div class="mb-4 d-flex flex-column align-items-start">
                                <label class="form-label ps-0">Enter Passcode</label>
                                <div class="passcode-inputs justify-content-center">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="0">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="1">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="2">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="3">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="4">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="5">
                                </div>
                                <div id="passcode_error" class="text-danger small mt-1"></div>
                                <input type="hidden" id="passcode" name="passcode">
                            </div>

                            <div class="mb-4 d-flex flex-column align-items-start">
                                <label class="form-label ps-0">Re-Enter Passcode</label>
                                <div class="passcode-inputs justify-content-center">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="6">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="7">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="8">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="9">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="10">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="11">
                                </div>
                                <div id="passcode_confirmation_error" class="text-danger small mt-1"></div>
                                <input type="hidden" id="passcode_confirmation" name="passcode_confirmation">
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="termsCheck">
                                    <label class="form-check-label" for="termsCheck">
                                        I agree all Terms & Conditions, Privacy Policy, and Fees.
                                    </label>
                                </div>
                                <div id="termsCheck_error" class="text-danger small mt-1"></div>
                            </div>

                            <div class="text-center mt-4">
                                <!-- <button type="button" class="btn btn-secondary btn-lg px-5 me-3"
                            onclick="prevStep(4)">Previous</button> -->
                                <button type="button" class="btn btn-primary w-100" onclick="showPreview()">Sign
                                    Up
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
    </div>
</div>
