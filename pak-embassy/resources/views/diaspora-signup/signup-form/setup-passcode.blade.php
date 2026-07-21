<div class="step-container d-none" id="step5">
    <div class="row min-vh-100 g-0">
        <!-- Left Panel -->
        <div class="col-lg-5 left-panel d-flex flex-column justify-content-center align-items-center h-50">
            <div class="text-center text-white w-100">
                <img src="{{asset('img/Frame14.png')}}" alt="Smartphone" class="left-image mb-4" style="object-fit: fill; height: 72%;">
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-5 right-panel d-flex justify-content-center">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="form-container form-container-custom">
                        <h2 class="form-title mb-4">Setup Passcode</h2>

                        <!-- Form -->
                        <form id="form-step5" class="passcodeForm">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Enter Passcode</label>
                                <div class="passcode-inputs">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="0">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="1">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="2">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="3">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="4">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="5">
                                </div>
                                <div id="passcode_error" class="text-danger small mt-1"></div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Re-Enter Passcode</label>
                                <div class="passcode-inputs">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="6">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="7">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="8">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="9">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="10">
                                    <input type="text" class="passcode-digit" maxlength="1" data-index="11">
                                </div>
                                <div id="passcode_confirmation_error" class="text-danger small mt-1"></div>
                            </div>
                             <!-- Hidden inputs to store combined passcodes -->
                            <input type="hidden" name="passcode" id="passcode-hidden">
                            <input type="hidden" name="passcode_confirmation" id="passcode-confirmation-hidden">

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="termsCheck" name="termsCheck">
                                    <label class="form-check-label" for="termsCheck">
                                        I agree to all Terms, Privacy Policy and Fees
                                    </label>
                                </div>
                                <div id="termsCheck_error" class="text-danger small mt-1"></div>
                            </div>

                            <div class="text-center mt-4">
                                <!-- <button type="button" class="btn btn-secondary btn-lg px-5 me-3"
                            onclick="prevStep(4)">Previous</button> -->
                                <button type="button" class="btn btn-primary w-100" onclick="nextStep(5)">Sign
                                    Up</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
