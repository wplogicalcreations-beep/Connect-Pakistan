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
                <p class="text-muted">To authorize Sign Up, please enter the verification code shared via email at <strong id="authModalEmail" class="text-dark"></strong>.</p>

                <div class="mb-4">
                    <label class="form-label fw-bold mb-0">Enter Verification Code <span class="text-danger h1 pb-4"><sup>.</sup></span></label>
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
                <p class="text-muted">Your account has been verified. You’ll be directed to Login Page automatically. If not, Click “Go to Login”</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Go to Login</button>
            </div>
        </div>
    </div>
</div>
